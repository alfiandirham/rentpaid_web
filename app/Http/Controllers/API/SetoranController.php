<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Setoran as SetoranCollection;
use App\Setoran;
use App\User;

class SetoranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(){
        if (\Gate::allows('isAdmin')) {
            return SetoranCollection::collection(Setoran::where('staff_id', \Auth::user()->id)->latest()->paginate(20));
        }

        if (\Gate::allows('isOwner')) {
            return SetoranCollection::collection(Setoran::where('user_id', \Auth::user()->id)->latest()->paginate(20));
        }
        return SetoranCollection::collection(Setoran::latest()->paginate(20));
    }

    public function store(Request $req){
        $staff = auth('api')->user();

        $this->validate($req, [
            'collector_id' => 'required',
            'tanggal' => 'required|date',
            'jumlah' => 'required',
        ]);

        if (\Gate::allows('isAdmin')) {
            $id = \Auth::user();
            $user = User::findOrFail($id->user_id);
            $req->merge(['user_id' => $user->id, 'lokasi_id' => $id->lokasi_id]);
        }

        if (\Gate::allows('isOwner')) {
            $req->merge(['user_id' => \Auth::user()->id]);
        }

        $req->merge(['staff_id' => $staff->id]);

        return Setoran::create($req->all());
    }

    public function update(Request $req, $id){
        $setoran = Setoran::findOrFail($id);
        $staff = auth('api')->user();
        
        $this->validate($req, [
            'collector_id' => 'required',
            'tanggal' => 'required|date',
            'jumlah' => 'required',
        ]);
        $setoran->update($req->all());
        
        return ["message" => 'sukses'];
    }

    public function destroy($id)
    {
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor')) {
            $setoran = Setoran::findOrFail($id);

            return ['message' => 'disabled'];
        }
    }

    public function show($id)
    {
        return new SetoranCollection(Setoran::findOrFail($id));
    }

    public function search(){
        if ($search = \Request::get('q')) {
            $setoran = SetoranCollection::collection(Setoran::where(function($query) use ($search){
                $query->where('tanggal','LIKE', "%$search%");
            })->paginate(20));
        }else{
            $setoran = SetoranCollection::collection(Setoran::latest()->paginate(20));
        }

        return $setoran;
    }
}