<?php

namespace App\Http\Controllers;

use App\ContactUs;
use App\LandingpageSetting;
use App\Lokasi;
use App\Tenant;
use App\Transaksi;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){
        $data = [];
        $settings = [
            'link_button_login',
            'link_dapatkan_penawaran',
            'link_pelajari_selengkapnya',
            'address_head_office_makassar',
            'address_head_office_makassar2',
            'facebook',
            'whatsapp',
            'instagram',
            'link_tentang_kami',
            'link_karir',
            'link_syarat_ketentuan',
        ];
        foreach ($settings AS $setting){
            $data[$setting] = optional(LandingpageSetting::where('setting',$setting)->first())->value;
        }
        return view('landing',compact('data'));
    }

    public function contactUs(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'perusahaan' => 'required',
            'pesan' => 'required',
        ]);
        if (ContactUs::create($data)){
            return redirect()->back()->with('message','Berhasil Mengirim Pesan');
        }
        return redirect()->back()->with('message','Gagal Mengirim Pesan');
    }

    static function cekTunggakan()
    {
        /*akses by cron only*/
        Log::info('Cek Tenant Belum Ditagih');
        DB::beginTransaction();
        $tenants = Tenant::with('kategori')
            //            ->whereDate('created_at',Carbon::today())
            ->where('status', 1)
            ->where('disewa', 1)
            ->where('status_tagih', 'Belum ditagih')
            ->get();
        foreach ($tenants as $tenant) {
            try {
                $tarif = $tenant->kategori->tarif()->select('bop', 'air', 'barang', 'listrik', 'sampah')->first();
                $tenant->status_tagih = 'menunggak';
                $sisa = 0;
                foreach ($tarif->toArray() as $key => $value) {
                    $sisa += $value;
                }
                Transaksi::create([
                    'tenant_id' => $tenant->id,
                    'user_id' => optional(User::where('lokasi_id', $tenant->lokasi_id)->where('type', 'collector')->first())->id,
                    'status' => 'menunggak',
                    'dibayar' => 0,
                    'sisa' => $sisa,
                    'tanggal' => Carbon::now(),
                    'shift' => 'shift_1',
                    'detail' => json_encode($tarif),
                    'owner_id' => Lokasi::find($tenant->lokasi_id)->user_id,
                    'lokasi_id' => $tenant->lokasi_id,
                    'penyewa_id' =>optional($tenant->penyewa)->id,
                ]);
                $tenant->save();
            } catch (\Exception $exception) {
                DB::rollBack();
                Log::error('ID Tenant gagal insert : '.$tenant->id);
                Log::error("Update transaksi menunggak gagal!!");
                Log::error('Line Error : '.$exception->getLine());
                Log::error('Pesan Error : '.$exception->getMessage());
//                throw new \Exception($exception->getMessage());
            }
        }
        Log::info("Tambah row tunggakan");
        DB::commit();
    }

    static function updateStatusTenantBelumDitagih()
    {
        Log::info("eksekusi update status tenant");
        try {
            Tenant::whereNotNull('id')
                ->update([
                    'status_tagih' => 'Belum ditagih'
                ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("Update Tenant gagal");
            throw new \Exception($exception->getMessage());
        }
        Log::info('update status tenant berhasil');
    }
}
