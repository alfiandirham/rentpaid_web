<?php

namespace App\Http\Controllers;

use App\Lokasi;
use App\Tenant;
use App\Transaksi;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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
        try {
            foreach ($tenants as $tenant) {
                $tarif = $tenant->kategori->tarif()->select('bop', 'air', 'barang', 'listrik', 'sampah')->first();
                $tenant->status_tagih = 'menunggak';
                $sisa = 0;
                foreach ($tarif->toArray() as $key => $value) {
                    $sisa += $value;
                }
                Transaksi::create([
                    'tenant_id' => $tenant->id,
                    'user_id' => User::where('lokasi_id', $tenant->lokasi_id)->where('type', 'collector')->first()->id,
                    'status' => 'menunggak',
                    'dibayar' => 0,
                    'sisa' => $sisa,
                    'tanggal' => Carbon::now(),
                    'shift' => 'shift_1',
                    'detail' => json_encode($tarif),
                    'owner_id' => Lokasi::find($tenant->lokasi_id)->user_id,
                    'lokasi_id' => $tenant->lokasi_id,
                ]);
                $tenant->save();
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("Update transaksi menunggak gagal!!");
            throw new \Exception($exception->getMessage());
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
