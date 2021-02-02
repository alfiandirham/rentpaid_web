<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Pendapatan as PendapatanCollection;
use App\Transaksi;
use App\User;

class PendapatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(){
        if(\Gate::allows('isAdmin')){
            return PendapatanCollection::collection(Transaksi::where('lokasi_id',\Auth::user()->lokasi_id)->where('dibayar', '>=', 0)
                ->select(
                    'tanggal', \DB::raw('sum(dibayar) as pendapatan'), \DB::raw('sum(sisa) as tunggakan'),
                    \DB::raw('sum(case WHEN status="lunas" then 1 end) as t_bayar'),
                    \DB::raw("sum(case WHEN status<>'lunas' then 1 end) as t_tunggak"),
                )
                ->groupBy('tanggal')
                ->orderBy('tanggal', 'desc')->paginate(20));
        }
        if(\Gate::allows('isOwner')){
            return PendapatanCollection::collection(Transaksi::where('owner_id',\Auth::user()->id)->where('dibayar', '>=', 0)
                ->select(
                    'tanggal', \DB::raw('sum(dibayar) as pendapatan'), \DB::raw('sum(sisa) as tunggakan'),
                    \DB::raw('sum(case WHEN status="lunas" then 1 end) as t_bayar'),
                    \DB::raw("sum(case WHEN status<>'lunas' then 1 end) as t_tunggak"),
                )
                ->groupBy('tanggal')
                ->orderBy('tanggal', 'desc')->paginate(20));
        }
        return PendapatanCollection::collection(Transaksi::where('dibayar', '>=', 0)
            ->select(
                'tanggal', \DB::raw('sum(dibayar) as pendapatan'), \DB::raw('sum(sisa) as tunggakan'),
                \DB::raw('sum(case WHEN status="lunas" then 1 end) as t_bayar'),
                \DB::raw("sum(case WHEN status<>'lunas' then 1 end) as t_tunggak"),
            )
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'desc')->paginate(20));
    }
}
