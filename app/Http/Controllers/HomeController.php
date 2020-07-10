<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Perusahaan;
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
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor')) {
            return view('qr')->with([
                "pr" => $pr
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
