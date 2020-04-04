<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tenant;
use App\User;
use App\Lokasi;
use App\Http\Resources\TenantCollections;
use App\Http\Resources\TenantCollection;
use App\Http\Resources\Tenant as TenantResource;

class TenantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        // $this->authorize('isAdmin');
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor')) {
            return TenantResource::collection(Tenant::latest()->paginate(20));
        }
    }

    public function show($id)
    {
        // $this->authorize('isAdmin');
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor')) {
            return new TenantResource(Tenant::findOrfail($id));
        }
    }

    public function lokasiTenant()
    {
        // $this->authorize('isAdmin');
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor')) {
            return TenantCollections::collection(Lokasi::latest()->paginate(20));
        }
    }

    public function lokasiTenantId($id)
    {
        // $this->authorize('isAdmin');
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor')) {
            return TenantResource::collection(Lokasi::findOrFail($id)->tenant()->paginate(20));
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
            'status' => 'required', 
            'penyewa_id' => 'required|integer', 
        ]);

        $user->update($request->all());
        return ['message' => 'Updated data', 'data' => $user];
    }

    public function destroy($id)
    {

        $this->authorize('isAdmin');

        $user = Tenant::findOrFail($id);

        $user->delete();

        return ['message' => 'Tenant Deleted'];
    }

    public function search($id){

        if ($search = \Request::get('q')) {
            $users = TenantResource::collection(Lokasi::findOrFail($id)->tenant()->where(function($query) use ($search){
                $query->where('status', $search)
                        ->orWhere('nomor', $search)
                        ->orWhere('kategori', $search);
            })->paginate(20));
        }else{
            $users = TenantResource::collection(Lokasi::findOrFail($id)->tenant()->latest()->paginate(20));
        }

        return $users;
    }
}