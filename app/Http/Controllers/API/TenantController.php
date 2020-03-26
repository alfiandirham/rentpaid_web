<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tenant;
use App\User;
use App\Lokasi;
use App\Http\Resources\TenantCollections;
use App\Http\Resources\TenantCollection;

class TenantController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api');
    }

    public function index()
    {
        // $this->authorize('isAdmin');
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor')) {
        }
        return TenantCollection::collection(Lokasi::latest()->paginate(20));
    }

    public function lokasiTenant()
    {
        // $this->authorize('isAdmin');
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor')) {
            return TenantCollections::collection(Lokasi::latest()->paginate(20));
        }
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'kategori' => 'required', 
            'jumlah' => 'required', 
            'harga' => 'required', 
            'lokasi_id' => 'required'
        ]);

        $lokasi = Lokasi::findOrFail($request->lokasi_id);

        for($i=1; $i<= $request->jumlah; $i++){
            $lokasi->tenant()->create([
                'kategori' => $request->kategori,
                'harga' => $request->harga,
                'nomor' => $i
            ]);
        }

        return ['message' => 'success created data'];
    }

    public function update(Request $request, $id)
    {

        $user = Tenant::findOrFail($id);

        $this->validate($request,[
            'kategori' => 'required', 
            'nomor' => 'required', 
            'harga' => 'required', 
            'status' => 'required', 
            'lokasi_id' => 'required'
        ]);

        $user->update($request->all());
        return ['message' => 'Updated the user info'];
    }

    public function destroy($id)
    {

        $this->authorize('isAdmin');

        $user = Tenant::findOrFail($id);

        $user->delete();

        return ['message' => 'Tenant Deleted'];
    }

    public function search(){

        if ($search = \Request::get('q')) {
            $users = Tenant::where(function($query) use ($search){
                $query->where('status','LIKE',"%$search%")
                        ->orWhere('nomor','LIKE',"%$search%");
            })->paginate(20);
        }else{
            $users = Tenant::latest()->paginate(20);
        }

        return $users;
    }
}