<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tarif;
use App\User;

class TarifController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        // $this->authorize('isAdmin');
        if (\Gate::allows('isAuthor')) {
            return Tarif::latest()->paginate(20);
        }

        if (\Gate::allows('isAdmin')) {
            $id = \Auth::user()->user_id;
            $user = User::findOrFail($id);
            return $user->tarif()->latest()->paginate(20);
        }

        if (\Gate::allows('isOwner')) {
            return \Auth::user()->tarif()->latest()->paginate(20);
        }
    }

    public function show($id)
    {
        // $this->authorize('isAdmin');
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor') || \Gate::allows('isOwner')) {
            return Tarif::findOrfail($id);
        }
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'nama' => 'required', 
            'air' => 'required', 
            'bop' => 'required', 
            'permeter' => 'required', 
            'barang' => 'required', 
            'listrik' => 'required', 
            'sampah' => 'required'
        ]);

        if (\Gate::allows('isAdmin')) {
            $id = \Auth::user()->user_id;
            $user = User::findOrFail($id);
            $request->merge(['user_id' => $user->id]);
        }

        if (\Gate::allows('isOwner')) {
            $request->merge(['user_id' => \Auth::user()->id]);
        }

        return Tarif::create($request->all());
    }

    public function update(Request $request, $id)
    {

        $user = Tarif::findOrFail($id);

        $this->validate($request,[
            'nama' => 'required', 
            'bop' => 'required', 
            'permeter' => 'required', 
            'air' => 'required', 
            'barang' => 'required', 
            'listrik' => 'required', 
            'sampah' => 'required'
        ]);

        $user->update($request->all());
        return ['message' => 'Updated data', 'data' => $user];
    }

    public function destroy($id)
    {
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor') || \Gate::allows('isOwner')) {
            $user = Tarif::findOrFail($id);

            $user->status = 0;
            $user->save();

            return ['message' => 'Tarif Deleted'];
        }
    }

    public function search(){

        if ($search = \Request::get('q')) {
            $users = Tarif::where(function($query) use ($search){
                $query->where('nama','LIKE', "%$search%");
            })->paginate(20);
        }else{
            $users = Tarif::latest()->paginate(20);
        }

        return $users;
    }
}
