<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Perusahaan;
use App\Tenant;
use App\Exports\TransaksiExport;
use App\Exports\TunggakanExport;
use App\Exports\SetoranExport;

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

    public function qrcode()
    {
        $pr = Perusahaan::first();
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
        $pr = Perusahaan::first();
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor') || \Gate::allows('isOwner')) {
            $tenan = Tenant::findOrfail($id);
            return view('qr2')->with([
                "pr" => $pr,
                "tenan" => $tenan
            ]);
        }
        return abort(404);
    }

    public function transaksi(){
        return \Excel::download(new TransaksiExport, now().'.xlsx');
    }

    public function tunggakan(){
        return \Excel::download(new TunggakanExport, now().'.xlsx');
    }

    public function setoran(){
        return \Excel::download(new SetoranExport, now().'.xlsx');
    }
}
