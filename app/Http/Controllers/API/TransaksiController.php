<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Transaksi as TransaksiCollection;
use App\Transaksi;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(){
        return TransaksiCollection::collection(Transaksi::where('status', '<>', 'menunggak')->latest()->paginate(20));
    }

    public function store(Request $req){
        $staff = auth('api')->user();

        $this->validate($req, [
            'collector_id' => 'required',
            'tanggal' => 'required|date',
            'jumlah' => 'required',
        ]);

        $req->merge(['staff_id' => $staff->id]);

        return Transaksi::create($req->all());
    }

    public function update(Request $req, $id){
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

    public function search(){
        if ($search = \Request::get('q')) {
            $transaksi = TransaksiCollection::collection(Transaksi::where('status', '<>', 'menunggak')->where(function($query) use ($search){
                $query->where('tanggal','LIKE', "%$search%");
            })->paginate(20));
        }else{
            $transaksi = TransaksiCollection::collection(Transaksi::where('status', '<>', 'menunggak')->latest()->paginate(20));
        }

        return $transaksi;
    }
}