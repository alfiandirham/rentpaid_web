<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Kategori as KategoriCollection;
use App\Kategori;
use App\User;

class KategoriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        // $this->authorize('isAdmin');
        if (\Gate::allows('isAuthor')) {
            return KategoriCollection::collection(Kategori::latest()->paginate(20));
        }

        if (\Gate::allows('isAdmin')) {
            $id = \Auth::user();
            $user = User::findOrFail($id->user_id);
            return KategoriCollection::collection($user->kategori()->where('lokasi_id', $id->lokasi_id)->latest()->paginate(20));
        }

        if (\Gate::allows('isOwner')) {
            return KategoriCollection::collection(\Auth::user()->kategori()->latest()->paginate(20));
        }
    }

    public function show($id)
    {
        // $this->authorize('isAdmin');
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor') || \Gate::allows('isOwner')) {
            return new KategoriCollection(Kategori::findOrfail($id));
        }
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'nama' => 'required', 
            'kode' => 'required', 
            'tarif_id' => 'required'
        ]);

        if (\Gate::allows('isAdmin')) {
            $id = \Auth::user();
            $user = User::findOrFail($id->user_id);
            $request->merge(['user_id' => $user->id, 'lokasi_id' => $id->lokasi_id]);
        }

        if (\Gate::allows('isOwner')) {
            $request->merge(['user_id' => \Auth::user()->id]);
        }

        return new KategoriCollection(Kategori::create($request->all()));
    }

    public function update(Request $request, $id)
    {

        $user = Kategori::findOrFail($id);

        $this->validate($request,[
            'nama' => 'required', 
            'kode' => 'required', 
            'tarif_id' => 'required'
        ]);

        $user->update($request->all());
        return ['message' => 'Updated data', 'data' => $user];
    }

    public function destroy($id)
    {
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor') || \Gate::allows('isOwner')) {
            $user = Kategori::findOrFail($id);

            $user->status = 0;
            $user->save();

            return ['message' => 'Kategori Deleted'];
        }
    }

    public function search(){

        if ($search = \Request::get('q')) {
            $users = KategoriCollection::collection(Kategori::where('user_id', \Auth::user()->id)->orWhere('lokasi_id', \Auth::user()->lokasi_id)->where(function($query) use ($search){
                $query->where('nama','LIKE', "%$search%");
            })->paginate(20));
        }else{
            if (\Gate::allows('isAuthor')) {
                $users = KategoriCollection::collection(Kategori::latest()->paginate(20));
            }
            if (\Gate::allows('isAdmin')) {
                $id = \Auth::user();
                $user = User::findOrFail($id->user_id);
                $users = KategoriCollection::collection($user->kategori()->where('lokasi_id', $id->lokasi_id)->latest()->paginate(20));
            }
            if (\Gate::allows('isOwner')) {
                $users = KategoriCollection::collection(\Auth::user()->kategori()->latest()->paginate(20));
            }
        }

        return $users;
    }
}

