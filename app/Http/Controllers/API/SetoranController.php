<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Setoran as SetoranCollection;
use App\Setoran;

class SetoranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(){
        return SetoranCollection::collection(Setoran::latest()->paginate(20));
    }

    public function store(Request $req){
        $staff = auth('api')->user();

        $this->validate($req, [
            'collector_id' => 'required',
            'tanggal' => 'required|date',
            'jumlah' => 'required',
        ]);

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

        $req->merge(['staff_id' => $staff->id]);

        return $setoran->update($req->all());
    }

    public function destroy($id)
    {
        $this->authorize('isAdmin');

        $setoran = Setoran::findOrFail($id);

        return ['message' => 'disabled'];
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