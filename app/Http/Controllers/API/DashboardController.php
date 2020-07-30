<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaksi;
use App\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(){
        if (\Gate::allows('isOwner')) {
            $phari = Transaksi::where('tanggal', 'like' ,substr(now(), 0,10))
                ->where([
                    'owner_id' => \Auth::user()->id,
                    'status' => 'lunas'
                ])->sum('dibayar');
            
            $thari = Transaksi::where('tanggal', 'like' ,substr(now(), 0,10))
                ->where([
                    'owner_id' => \Auth::user()->id,
                    'status' => 'menunggak'
                ])->sum('sisa');

            $lokasi = \Auth::user()->location()->whereHas('tenant')->get();
            
            $tenant = 0;
            $tot = 0;
            $user= 0;
            
            foreach ($lokasi as $data) {
                $df = User::where([
                    "lokasi_id" => $data->id,
                    "type" => 'collector',
                    "status" => true
                ])->count();
                $s = $data->tenant;
                $sd = $data->tenant->count();
                foreach ($s as $data) {
                    $d = $data->disewa ? 1 : 0;
                    $tenant += $d;
                }
                $tot += $sd;
                $user += $df;
            }

            return [
                'phari' => $phari,
                'thari' => $thari,
                'tenant' => $tenant.' dari '.$tot,
                'kolektor' => $user
            ];
        }
    }
}
