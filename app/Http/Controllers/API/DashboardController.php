<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaksi;
use App\User;
use App\Lokasi;

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
                    // 'status' => 'lunas'
                ])->sum('dibayar');
            
            $bini = Transaksi::whereMonth('tanggal',now()->month)
                ->where([
                    'owner_id' => \Auth::user()->id,
                    //'status' => 'lunas'
                ]);
            
            $row = Transaksi::whereMonth('tanggal',now()->month)
                ->where([
                    'owner_id' => \Auth::user()->id,
                    'status' => 'lunas'
                ])->where('tanggal', 'like', '%-01')->sum('dibayar');
            
            $row1 = Transaksi::whereMonth('tanggal', now()->month)
                ->where([
                    'owner_id' => \Auth::user()->id,
                    'status' => 'lunas'
                ])->where('tanggal', 'like', '%-05')->sum('dibayar');
            
            $row2 = Transaksi::whereMonth('tanggal', now()->month)
                ->where([
                    'owner_id' => \Auth::user()->id,
                    'status' => 'lunas'
                ])->where('tanggal', 'like', '%-09')->sum('dibayar');
            
            $row3 = Transaksi::whereMonth('tanggal', now()->month)
                ->where([
                    'owner_id' => \Auth::user()->id,
                    'status' => 'lunas'
                ])->where('tanggal', 'like', '%-13')->sum('dibayar');
            
            $row4 = Transaksi::whereMonth('tanggal', now()->month)
                ->where([
                    'owner_id' => \Auth::user()->id,
                    'status' => 'lunas'
                ])->where('tanggal', 'like', '%-17')->sum('dibayar');
            
            $row5 = Transaksi::whereMonth('tanggal', now()->month)
                ->where([
                    'owner_id' => \Auth::user()->id,
                    'status' => 'lunas'
                ])->where('tanggal', 'like', '%-21')->sum('dibayar');
            
            $row6 = Transaksi::whereMonth('tanggal', now()->month)
                ->where([
                    'owner_id' => \Auth::user()->id,
                    'status' => 'lunas'
                ])->where('tanggal', 'like', '%-26')->sum('dibayar');
            
            $row7 = Transaksi::whereMonth('tanggal',now()->month)
                ->where([
                    'owner_id' => \Auth::user()->id,
                    'status' => 'lunas'
                ])->where('tanggal', 'like', '%-30')->sum('dibayar');
            
            $blalu = Transaksi::whereMonth('tanggal' ,now()->month - 1)
                ->where([
                    'owner_id' => \Auth::user()->id,
                    'status' => 'lunas'
                ]);
            
            $riw = Transaksi::whereMonth('tanggal', now()->month - 1)
                ->where([
                    'owner_id' => \Auth::user()->id,
                    'status' => 'lunas'
                ])->where('tanggal', 'like', '%-01')->sum('dibayar');
            
            $riw1 = Transaksi::whereMonth('tanggal', now()->month- 1)
                ->where([
                    'owner_id' => \Auth::user()->id,
                    'status' => 'lunas'
                ])->where('tanggal', 'like', '%-05')->sum('dibayar');
            
            $riw2 = Transaksi::whereMonth('tanggal', now()->month - 1)
                ->where([
                    'owner_id' => \Auth::user()->id,
                    'status' => 'lunas'
                ])->where('tanggal', 'like', '%-09')->sum('dibayar');
            
            $riw3 = Transaksi::whereMonth('tanggal', now()->month - 1)
                ->where([
                    'owner_id' => \Auth::user()->id,
                    'status' => 'lunas'
                ])->where('tanggal', 'like', '%-13')->sum('dibayar');
            
            $riw4 = Transaksi::whereMonth('tanggal', now()->month - 1)
                ->where([
                    'owner_id' => \Auth::user()->id,
                    'status' => 'lunas'
                ])->where('tanggal', 'like', '%-17')->sum('dibayar');
            
            $riw5 = Transaksi::whereMonth('tanggal', now()->month - 1)
                ->where([
                    'owner_id' => \Auth::user()->id,
                    'status' => 'lunas'
                ])->where('tanggal', 'like', '%-21')->sum('dibayar');
            
            $riw6 = Transaksi::whereMonth('tanggal', now()->month - 1)
                ->where([
                    'owner_id' => \Auth::user()->id,
                    'status' => 'lunas'
                ])->where('tanggal', 'like', '%-26')->sum('dibayar');

            $riw7 = Transaksi::whereMonth('tanggal', now()->month - 1)
                ->where([
                    'owner_id' => \Auth::user()->id,
                    'status' => 'lunas'
                ])->where('tanggal', 'like', '%-30')->sum('dibayar');
            
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
                'kolektor' => $user,
                'bini' => $bini->sum('dibayar'),
                'blalu' => $blalu->sum('dibayar'),
                'pbini' => [$row, $row1, $row2, $row3, $row4, $row5, $row6, $row7],
                'pblalu' => [$riw, $riw1, $riw2, $riw3, $riw4, $riw5, $riw6, $riw7],
            ];
        }
        if (\Gate::allows('isAdmin')) {
            $phari = Transaksi::where('tanggal', 'like' ,substr(now(), 0,10))
                ->where([
                    'lokasi_id' => \Auth::user()->lokasi_id,
                    //'status' => 'lunas'
                ])->sum('dibayar');
            
            $bini = Transaksi::whereMonth('tanggal', now()->month)
                ->where([
                    'lokasi_id' => \Auth::user()->lokasi_id,
                    //'status' => 'lunas'
                ]);
            
            $row = Transaksi::whereMonth('tanggal', now()->month)
                ->where([
                    'lokasi_id' => \Auth::user()->lokasi_id,
                    //'status' => 'lunas'
                ])->where('tanggal', 'like', '%-01')->sum('dibayar');
            
            $row1 = Transaksi::whereMonth('tanggal', now()->month)
                ->where([
                    'lokasi_id' => \Auth::user()->lokasi_id,
                    //'status' => 'lunas'
                ])->where('tanggal', 'like', '%-05')->sum('dibayar');
            
            $row2 = Transaksi::whereMonth('tanggal', now()->month)
                ->where([
                    'lokasi_id' => \Auth::user()->lokasi_id,
                    //'status' => 'lunas'
                ])->where('tanggal', 'like', '%-09')->sum('dibayar');
            
            $row3 = Transaksi::whereMonth('tanggal', now()->month)
                ->where([
                    'lokasi_id' => \Auth::user()->lokasi_id,
                    //'status' => 'lunas'
                ])->where('tanggal', 'like', '%-13')->sum('dibayar');
            
            $row4 = Transaksi::whereMonth('tanggal', now()->month)
                ->where([
                    'lokasi_id' => \Auth::user()->lokasi_id,
                    //'status' => 'lunas'
                ])->where('tanggal', 'like', '%-17')->sum('dibayar');
            
            $row5 = Transaksi::whereMonth('tanggal',now()->month)
                ->where([
                    'lokasi_id' => \Auth::user()->lokasi_id,
                    //'status' => 'lunas'
                ])->where('tanggal', 'like', '%-21')->sum('dibayar');
            
            $row6 = Transaksi::whereMonth('tanggal', now()->month)
                ->where([
                    'lokasi_id' => \Auth::user()->lokasi_id,
                    //'status' => 'lunas'
                ])->where('tanggal', 'like', '%-26')->sum('dibayar');
            
            $row7 = Transaksi::whereMonth('tanggal', now()->month)
                ->where([
                    'lokasi_id' => \Auth::user()->lokasi_id,
                    //'status' => 'lunas'
                ])->where('tanggal', 'like', '%-30')->sum('dibayar');
            
            $blalu = Transaksi::whereMonth('tanggal', now()->month - 1)
                ->where([
                    'lokasi_id' => \Auth::user()->lokasi_id,
                    //'status' => 'lunas'
                ]);
            
            $riw = Transaksi::whereMonth('tanggal', now()->month - 1)
                ->where([
                    'lokasi_id' => \Auth::user()->lokasi_id,
                    //'status' => 'lunas'
                ])->where('tanggal', 'like', '%-01')->sum('dibayar');
            
            $riw1 = Transaksi::whereMonth('tanggal', now()->month - 1)
                ->where([
                    'lokasi_id' => \Auth::user()->lokasi_id,
                    //'status' => 'lunas'
                ])->where('tanggal', 'like', '%-05')->sum('dibayar');
            
            $riw2 = Transaksi::whereMonth('tanggal', now()->month - 1)
                ->where([
                    'lokasi_id' => \Auth::user()->lokasi_id,
                    //'status' => 'lunas'
                ])->where('tanggal', 'like', '%-09')->sum('dibayar');
            
            $riw3 = Transaksi::whereMonth('tanggal', now()->month - 1)
                ->where([
                    'lokasi_id' => \Auth::user()->lokasi_id,
                    //'status' => 'lunas'
                ])->where('tanggal', 'like', '%-13')->sum('dibayar');
            
            $riw4 = Transaksi::whereMonth('tanggal', now()->month - 1)
                ->where([
                    'lokasi_id' => \Auth::user()->lokasi_id,
                    //'status' => 'lunas'
                ])->where('tanggal', 'like', '%-17')->sum('dibayar');
            
            $riw5 = Transaksi::whereMonth('tanggal', now()->month - 1)
                ->where([
                    'lokasi_id' => \Auth::user()->lokasi_id,
                    //'status' => 'lunas'
                ])->where('tanggal', 'like', '%-21')->sum('dibayar');
            
            $riw6 = Transaksi::whereMonth('tanggal', now()->month - 1)
                ->where([
                    'lokasi_id' => \Auth::user()->lokasi_id,
                    //'status' => 'lunas'
                ])->where('tanggal', 'like', '%-26')->sum('dibayar');

            $riw7 = Transaksi::whereMonth('tanggal', now()->month - 1)
                ->where([
                    'lokasi_id' => \Auth::user()->lokasi_id,
                    //'status' => 'lunas'
                ])->where('tanggal', 'like', '%-30')->sum('dibayar');
            
            $thari = Transaksi::where('tanggal', 'like' ,substr(now(), 0,10))
                ->where([
                    'lokasi_id' => \Auth::user()->lokasi_id,
                    'status' => 'menunggak'
                ])->sum('sisa');

            $lokasi = Lokasi::where('id', \Auth::user()->lokasi_id)->whereHas('tenant')->get();
            
            $tenant = 0;
            $tot = 0;
            $user= User::where([
                'user_id' => \Auth::user()->id,
                'type' => 'collector',
                'status' => true
                ])->count();
            
            foreach ($lokasi as $data) {
                $s = $data->tenant;
                $sd = $data->tenant->count();
                foreach ($s as $data) {
                    $d = $data->disewa ? 1 : 0;
                    $tenant += $d;
                }
                $tot += $sd;
            }

            return [
                'phari' => $phari,
                'thari' => $thari,
                'tenant' => $tenant.' dari '.$tot,
                'kolektor' => $user,
                'bini' => $bini->sum('dibayar'),
                'blalu' => $blalu->sum('dibayar'),
                'pbini' => [$row, $row1, $row2, $row3, $row4, $row5, $row6, $row7],
                'pblalu' => [$riw, $riw1, $riw2, $riw3, $riw4, $riw5, $riw6, $riw7],
            ];
        }
    }
}
