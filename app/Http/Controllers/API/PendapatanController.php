<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Pendapatan as PendapatanCollection;
use App\Pendapatan as Transaksi;
use App\User;

class PendapatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        if (\Gate::allows('isAdmin')) {
            return PendapatanCollection::collection(Transaksi::where('lokasi_id', \Auth::user()->lokasi_id)->where('dibayar', '>=', 0)
                ->select(
                    'modif',
                    \DB::raw('sum(dibayar) as pendapatan'),
                    \DB::raw('sum(sisa) as tunggakan'),
                    \DB::raw('sum(case WHEN status="lunas" then 1 end) as t_bayar'),
                    \DB::raw("sum(case WHEN status<>'lunas' then 1 end) as t_tunggak"),
                    \DB::raw("sum(case WHEN status then 1 end) as total"),
                )
                ->groupBy('modif')
                ->orderBy('modif', 'desc')->paginate(20));
        }
        if (\Gate::allows('isOwner')) {
            return PendapatanCollection::collection(Transaksi::where('owner_id', \Auth::user()->id)->where('dibayar', '>=', 0)
                ->select(
                    'modif',
                    \DB::raw('sum(dibayar) as pendapatan'),
                    \DB::raw('sum(sisa) as tunggakan'),
                    \DB::raw('sum(case WHEN status="lunas" then 1 end) as t_bayar'),
                    \DB::raw("sum(case WHEN status<>'lunas' then 1 end) as t_tunggak"),
                    \DB::raw("sum(case WHEN status then 1 end) as total"),
                )
                ->groupBy('modif')
                ->orderBy('modif', 'desc')->paginate(20));
        }
        return PendapatanCollection::collection(Transaksi::where('dibayar', '>=', 0)
            ->select(
                'modif',
                \DB::raw('sum(dibayar) as pendapatan'),
                \DB::raw('sum(sisa) as tunggakan'),
                \DB::raw('sum(case WHEN status="lunas" then 1 end) as t_bayar'),
                \DB::raw("sum(case WHEN status<>'lunas' then 1 end) as t_tunggak"),
                \DB::raw("sum(case WHEN status then 1 end) as total"),
            )
            ->groupBy('modif')
            ->orderBy('modif', 'desc')->paginate(20));
    }

    public function search()
    {
        if (\Request::get('a')) {
            if (\Gate::allows('isAdmin')) {
                return PendapatanCollection::collection(Transaksi::where('lokasi_id', \Auth::user()->lokasi_id)->where('dibayar', '>=', 0)->whereBetween('modif', [\Request::get('a'), \Request::get('l')])->select(
                    'modif',
                    \DB::raw('sum(dibayar) as pendapatan'),
                    \DB::raw('sum(sisa) as tunggakan'),
                    \DB::raw('sum(case WHEN status="lunas" then 1 end) as t_bayar'),
                    \DB::raw("sum(case WHEN status<>'lunas' then 1 end) as t_tunggak"),
                )
                    ->groupBy('modif')
                    ->orderBy('modif', 'desc')->paginate(20));
            }
            if (\Gate::allows('isOwner')) {
                return PendapatanCollection::collection(Transaksi::where('owner_id', \Auth::user()->id)->where('dibayar', '>=', 0)->whereBetween('modif', [\Request::get('a'), \Request::get('l')])->select(
                    'modif',
                    \DB::raw('sum(dibayar) as pendapatan'),
                    \DB::raw('sum(sisa) as tunggakan'),
                    \DB::raw('sum(case WHEN status="lunas" then 1 end) as t_bayar'),
                    \DB::raw("sum(case WHEN status<>'lunas' then 1 end) as t_tunggak"),
                )
                    ->groupBy('modif')
                    ->orderBy('modif', 'desc')->paginate(20));
            }
        } else {
            if ($search = \Request::get('q')) {
                if (\Gate::allows('isAdmin')) {
                    return PendapatanCollection::collection(Transaksi::where('lokasi_id', \Auth::user()->lokasi_id)->where('dibayar', '>=', 0)->where('modif', 'like', "%$search%")->select(
                        'modif',
                        \DB::raw('sum(dibayar) as pendapatan'),
                        \DB::raw('sum(sisa) as tunggakan'),
                        \DB::raw('sum(case WHEN status="lunas" then 1 end) as t_bayar'),
                        \DB::raw("sum(case WHEN status<>'lunas' then 1 end) as t_tunggak"),
                    )
                        ->groupBy('modif')
                        ->orderBy('modif', 'desc')->paginate(20));
                }
                if (\Gate::allows('isOwner')) {
                    return PendapatanCollection::collection(Transaksi::where('owner_id', \Auth::user()->id)->where('dibayar', '>=', 0)->where('modif', 'like', "%$search%")->select(
                        'modif',
                        \DB::raw('sum(dibayar) as pendapatan'),
                        \DB::raw('sum(sisa) as tunggakan'),
                        \DB::raw('sum(case WHEN status="lunas" then 1 end) as t_bayar'),
                        \DB::raw("sum(case WHEN status<>'lunas' then 1 end) as t_tunggak"),
                    )
                        ->groupBy('modif')
                        ->orderBy('modif', 'desc')->paginate(20));
                }
            } else {
                if (\Gate::allows('isAdmin')) {
                    $transaksi = PendapatanCollection::collection(Transaksi::where('lokasi_id', \Auth::user()->lokasi_id)->where('dibayar', '>=', 0)->select(
                        'modif',
                        \DB::raw('sum(dibayar) as pendapatan'),
                        \DB::raw('sum(sisa) as tunggakan'),
                        \DB::raw('sum(case WHEN status="lunas" then 1 end) as t_bayar'),
                        \DB::raw("sum(case WHEN status<>'lunas' then 1 end) as t_tunggak"),
                    )
                        ->groupBy('modif')
                        ->orderBy('modif', 'desc')->paginate(20));
                }
                if (\Gate::allows('isOwner')) {
                    $transaksi = PendapatanCollection::collection(Transaksi::where('owner_id', \Auth::user()->id)->where('dibayar', '>=', 0)->select(
                        'modif',
                        \DB::raw('sum(dibayar) as pendapatan'),
                        \DB::raw('sum(sisa) as tunggakan'),
                        \DB::raw('sum(case WHEN status="lunas" then 1 end) as t_bayar'),
                        \DB::raw("sum(case WHEN status<>'lunas' then 1 end) as t_tunggak"),
                    )
                        ->groupBy('modif')
                        ->orderBy('modif', 'desc')->paginate(20));
                }
            }
            return $transaksi;
        }
    }
}
