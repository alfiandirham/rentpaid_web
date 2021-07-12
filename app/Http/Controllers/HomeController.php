<?php

namespace App\Http\Controllers;

use App\Exports\LokasiTenantExport;
use App\Exports\PenYearExport;
use App\Exports\PesewaExport;
use App\Perusahaan;
use App\Tenant;
use App\Exports\TransaksiExport;
use App\Exports\TunggakanExport;
use App\Exports\SetoranExport;
use App\Tenant as Penyewa;
use App\Penyewa as Pesewa;
use App\Lokasi;
use Barryvdh\DomPDF\Facade as PDF;
use App\User;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function pesewa($id)
    {
        $sewa = Penyewa::where([
            'status' => true,
            'lokasi_id' => $id
        ])->where('penyewa_id', "<>", NULL)->get();

        return view('pesewa')->with([
            'sewa' => $sewa,
            'pesewa' => new Pesewa(),
            'lokasi' => Lokasi::findOrFail($id)
        ]);
    }

    public function qrcode()
    {
        if (\Gate::allows('isAuthor')) {
            $pr = Perusahaan::first();
        }

        if (\Gate::allows('isOwner')) {
            $pr = \Auth::user()->perusahaan;
        }

        if (\Gate::allows('isAdmin')) {
            $pr = User::findOrFail(\Auth::user()->user_id)->perusahaan;
        }
        $data = explode(",", \Request::get('data'));
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor') || \Gate::allows('isOwner')) {
            $tenan = [];

            foreach ($data as $id) {
                $set = Tenant::findOrfail($id);
                array_push($tenan, $set);
            }
            return view('qr')->with([
                "pr" => $pr,
                "tenan" => $tenan
            ]);
        }
        return abort(404);
    }

    public function qrcode2($id)
    {
        if (\Gate::allows('isAuthor')) {
            $pr = Perusahaan::first();
        }

        if (\Gate::allows('isOwner')) {
            $pr = \Auth::user()->perusahaan;
        }

        if (\Gate::allows('isAdmin')) {
            $pr = User::findOrFail(\Auth::user()->user_id)->perusahaan;
        }

        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor') || \Gate::allows('isOwner')) {
            $tenan = Tenant::findOrfail($id);
            return view('qr2')->with([
                "pr" => $pr,
                "tenan" => $tenan
            ]);
        }
        return abort(404);
    }

    public function transaksi()
    {
        return \Excel::download(new TransaksiExport, now() . '.xlsx');
    }

    public function pesewa2()
    {
        return \Excel::download(new PesewaExport, now() . '.xlsx');
    }

    public function penyear()
    {
        return \Excel::download(new PenYearExport, now() . '.xlsx');
    }

    public function tunggakan()
    {
        return \Excel::download(new TunggakanExport, now() . '.xlsx');
    }

    public function setoran()
    {
        return \Excel::download(new SetoranExport, now() . '.xlsx');
    }

    public function lokasiTenant($id)
    {
        $tenant = Tenant::with('penyewa')->where('lokasi_id', $id)->get();
        $lokasi = Lokasi::find($id);
        $pdf = PDF::loadView('daftar-penyewa', compact('tenant', 'lokasi'));
        return $pdf->stream('daftar-penyewa-' . $lokasi->lokasi . '.pdf');
        //        return \Excel::download(new LokasiTenantExport($id), now().'.xlsx');
    }
}
