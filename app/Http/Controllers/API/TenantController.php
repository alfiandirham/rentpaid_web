<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tenant;
use App\User;
use App\Lokasi;
use App\Kategori;
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
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor') || \Gate::allows('isOwner')) {
            return TenantResource::collection(Tenant::latest()->paginate(20));
        }
    }

    public function show($id)
    {
        // $this->authorize('isAdmin');
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor') || \Gate::allows('isOwner')) {
            return new TenantResource(Tenant::findOrfail($id));
        }
    }

    public function lokasiTenant()
    {
        // $this->authorize('isAdmin');
        if (\Gate::allows('isAdmin')) {
            return TenantCollections::collection(Lokasi::where('status', true)->latest()->paginate(20));
        }
        if (\Gate::allows('isOwner')) {
            return TenantCollections::collection(\Auth::user()->location()->where('status', true)->latest()->paginate(20));
        }
        if (\Gate::allows('isAuthor')) {
            return TenantCollections::collection(Lokasi::latest()->paginate(20));
        }
    }

    public function lokasiTenantId($id)
    {
        // $this->authorize('isAdmin');
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor') || \Gate::allows('isOwner') ) {
            return TenantResource::collection(Lokasi::findOrFail($id)->tenant()->latest()->paginate(20));
        }
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'kategori_id' => 'required', 
            'jumlah' => 'required', 
            'lokasi_id' => 'required'
        ]);

        $lokasi = Lokasi::findOrFail($request->lokasi_id);
        $kategori = Kategori::findOrFail($request->kategori_id);
        
        for($i=1; $i<= $request->jumlah; $i++){
            $inc = $lokasi->tenant()->orderBy('id', 'desc')->first();
            $inc = $inc ? $inc->id + 1 : 1;
            $kode = $lokasi->kode.$kategori->kode.$inc;
            $lokasi->tenant()->create([
                'kategori_id' => $request->kategori_id,
                'kode' => $kode
            ]);
        }

        return ['message' => 'success created data'];
    }

    public function update(Request $request, $id)
    {

        $user = Tenant::findOrFail($id);

        ($request['status'] == 'false') ? $request->merge(['status' => 0]) : $request->merge(['status' => 1]);

        $user->update($request->all());
        return ['message' => 'Updated data', 'data' => $user];
    }

    public function destroy($id)
    {

        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor') || \Gate::allows('isOwner')) {
            $user = Tenant::findOrFail($id);

            $user->status = 0;
            $user->save();

            return ['message' => 'Tenant Deleted'];
        }
    }

    public function destroy2($id)
    {

        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor') || \Gate::allows('isOwner')) {
            $user = Tenant::findOrFail($id);

            $user->status = 1;
            $user->save();

            return ['message' => 'Tenant Deleted'];
        }
    }

    public function search($id){

        if ($search = \Request::get('q')) {
            if($search == "uvuvwe"){
                $users = TenantResource::collection(Lokasi::findOrFail($id)->tenant()->where('disewa', true)->latest()->paginate(20));
            }else if($search == "uvuvwi"){
                $users = TenantResource::collection(Lokasi::findOrFail($id)->tenant()->where('disewa', false)->latest()->paginate(20));
            }else if($search == "uvuvwu"){
                $users = TenantResource::collection(Lokasi::findOrFail($id)->tenant()->latest()->paginate(20));
            }else{
                $users = TenantResource::collection(Lokasi::findOrFail($id)->tenant()->where(function($query) use ($search){
                    $query->where('kode', 'LIKE',"%$search%");
                })->paginate(20));
            }
        }else{
            $users = TenantResource::collection(Lokasi::findOrFail($id)->tenant()->latest()->paginate(20));
        }
        return $users;
    }
}