<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Transaksi as TransaksiCollection;
use App\Transaksi;
use App\TransactionYear;
use App\User;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function years()
    {
        return Transaksi::where('dibayar', '>=', 0)->select(\DB::raw('YEAR(created_at) year'))
            ->groupby('year')
            ->get();
    }

    public function indexByYear()
    {
        if (\Gate::allows('isAdmin')) {
            if ($q = \Request::get('q')) {
                return TransactionYear::where('lokasi_id', \Auth::user()->lokasi_id)->where('year', $q)->paginate(20);
            }
            return TransactionYear::where('lokasi_id', \Auth::user()->lokasi_id)->paginate(20);
        }
        if (\Gate::allows('isOwner')) {
            if ($q = \Request::get('q')) {
                return TransactionYear::where('owner_id', \Auth::user()->id)->where('year', $q)->paginate(20);
            }
            return TransactionYear::where('owner_id', \Auth::user()->id)->paginate(20);
        }
        return TransactionYear::paginate(20);
    }

    public function index()
    {
        if (\Gate::allows('isAdmin')) {
            return TransaksiCollection::collection(Transaksi::where('lokasi_id', \Auth::user()->lokasi_id)->where('dibayar', '>=', 0)->latest()->paginate(20));
        }
        if (\Gate::allows('isOwner')) {
            return TransaksiCollection::collection(Transaksi::where('owner_id', \Auth::user()->id)->where('dibayar', '>=', 0)->latest()->paginate(20));
        }
        return TransaksiCollection::collection(Transaksi::where('dibayar', '>=', 0)->latest()->paginate(20));
    }

    public function info()
    {
        if (\Gate::allows('isOwner')) {
            if ($q = \Request::get('q')) {
                if ($q == "bulan") {
                    $thari = Transaksi::where('tanggal', 'like', substr(now(), 0, 7))
                        ->where([
                            'owner_id' => \Auth::user()->id,
                            'status' => 'menunggak'
                        ])->sum('sisa');
                    $phari = Transaksi::where('tanggal', 'like', substr(now(), 0, 7))
                        ->where([
                            'owner_id' => \Auth::user()->id,
                            // 'status' => 'lunas'
                        ])->sum('dibayar');
                }
            } else {
                $thari = Transaksi::where('tanggal', 'like', substr(now(), 0, 10))
                    ->where([
                        'owner_id' => \Auth::user()->id,
                        'status' => 'menunggak'
                    ])->sum('sisa');
                $phari = Transaksi::where('tanggal', 'like', substr(now(), 0, 10))
                    ->where([
                        'owner_id' => \Auth::user()->id,
                        // 'status' => 'lunas'
                    ])->sum('dibayar');
            }

            $totalp = Transaksi::where([
                'owner_id' => \Auth::user()->id,
                // 'status' => 'lunas'
            ])->sum('dibayar');

            $totalt = Transaksi::where([
                'owner_id' => \Auth::user()->id,
                'status' => 'menunggak'
            ])->sum('sisa');

            return [
                "phari" => $phari,
                "thari" => $thari,
                "totalp" => $totalp,
                "totalt" => $totalt
            ];
        }
        if (\Gate::allows('isAdmin')) {
            if ($q = \Request::get('q')) {
                if ($q == "bulan") {
                    $thari = Transaksi::where('tanggal', 'like', substr(now(), 0, 7))
                        ->where([
                            'lokasi_id' => \Auth::user()->lokasi_id,
                            'status' => 'menunggak'
                        ])->sum('sisa');
                    $phari = Transaksi::where('tanggal', 'like', substr(now(), 0, 7))
                        ->where([
                            'lokasi_id' => \Auth::user()->lokasi_id,
                            // 'status' => 'lunas'
                        ])->sum('dibayar');
                }
            } else {
                $thari = Transaksi::where('tanggal', 'like', substr(now(), 0, 10))
                    ->where([
                        'lokasi_id' => \Auth::user()->lokasi_id,
                        'status' => 'menunggak'
                    ])->sum('sisa');
                $phari = Transaksi::where('tanggal', 'like', substr(now(), 0, 10))
                    ->where([
                        'lokasi_id' => \Auth::user()->lokasi_id,
                        // 'status' => 'lunas'
                    ])->sum('dibayar');
            }

            $totalp = Transaksi::where([
                'lokasi_id' => \Auth::user()->lokasi_id,
                // 'status' => 'lunas'
            ])->sum('dibayar');

            $totalt = Transaksi::where([
                'lokasi_id' => \Auth::user()->lokasi_id,
                'status' => 'menunggak'
            ])->sum('sisa');

            return [
                "phari" => $phari,
                "thari" => $thari,
                "totalp" => $totalp,
                "totalt" => $totalt
            ];
        }
    }

    public function store(Request $req)
    {
        $staff = auth('api')->user();

        $this->validate($req, [
            'collector_id' => 'required',
            'tanggal' => 'required|date',
            'jumlah' => 'required',
        ]);

        $req->merge(['staff_id' => $staff->id]);

        return Transaksi::create($req->all());
    }

    public function update(Request $req, $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $staff = auth('api')->user();

        $this->validate($req, [
            'collector_id' => 'required',
            'tanggal' => 'required|date',
            'jumlah' => 'required',
        ]);
        $transaksi->update($req->all());

        return ["message" => 'sukses'];
    }

    public function destroy($id)
    {
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor')) {
            $transaksi = Transaksi::findOrFail($id);

            return ['message' => 'disabled'];
        }
    }

    public function show($id)
    {
        return new TransaksiCollection(Transaksi::findOrFail($id));
    }

    public function search()
    {
        if (\Request::get('a')) {
            if (\Gate::allows('isAdmin')) {
                return TransaksiCollection::collection(Transaksi::where('lokasi_id', \Auth::user()->lokasi_id)->where('dibayar', '>=', 0)->whereBetween('tanggal', [\Request::get('a'), \Request::get('l')])->latest()->paginate(20));
            }
            if (\Gate::allows('isOwner')) {
                return TransaksiCollection::collection(Transaksi::where('owner_id', \Auth::user()->id)->where('dibayar', '>=', 0)->whereBetween('tanggal', [\Request::get('a'), \Request::get('l')])->latest()->paginate(20));
            }
        } else {
            if ($search = \Request::get('q')) {
                $preTransaksi = Transaksi::leftJoin('penyewas', 'transaksis.penyewa_id', '=', 'penyewas.id')->leftJoin('lokasis', 'transaksis.lokasi_id', '=', 'lokasis.id')->join('users', 'transaksis.user_id', '=', 'users.id');

                if (\Gate::allows('isAdmin')) {
                    $preTransaksi->where('transaksis.lokasi_id', \Auth::user()->lokasi_id);
                }
                if (\Gate::allows('isOwner')) {
                    $preTransaksi->where('transaksis.owner_id', \Auth::user()->id);
                }

                if (\Request::get('t') == 'penyewa') {
                    $transaksi = TransaksiCollection::collection($preTransaksi->where('penyewas.nama', 'like', "%$search%")->select('transaksis.*', 'penyewas.nama', 'lokasis.lokasi', 'users.name')->paginate(20));
                }
                if (\Request::get('t') == 'lokasi') {
                    $transaksi = TransaksiCollection::collection($preTransaksi->where('lokasis.lokasi', 'like', "%$search%")->select('transaksis.*', 'penyewas.nama', 'lokasis.lokasi', 'users.name')->paginate(20));
                }
                if (\Request::get('t') == 'collector') {
                    $transaksi = TransaksiCollection::collection($preTransaksi->where('users.name', 'like', "%$search%")->select('transaksis.*', 'penyewas.nama', 'lokasis.lokasi', 'users.name')->paginate(20));
                }
            } else {
                if (\Gate::allows('isAdmin')) {
                    $transaksi = TransaksiCollection::collection(Transaksi::where('lokasi_id', \Auth::user()->lokasi_id)->where('dibayar', '>=', 0)->latest()->paginate(20));
                }
                if (\Gate::allows('isOwner')) {
                    $transaksi = TransaksiCollection::collection(Transaksi::where('owner_id', \Auth::user()->id)->where('dibayar', '>=', 0)->latest()->paginate(20));
                }
            }
            return $transaksi;
        }
    }
}
