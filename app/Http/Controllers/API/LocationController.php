<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Lokasi;

class LocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        // $this->authorize('isAdmin');
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor')) {
            return Lokasi::latest()->paginate(20);
        }

    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'lokasi' => 'required', 
            'lat' => 'required', 
            'long' => 'required', 
            'provinsi' => 'required', 
            'kab' => 'required',
            'kec' => 'required', 
            'kel' => 'required', 
            'user_id' => 'required'
        ]);

        ($request['status'] == 'false') ? $request->merge(['status' => 0]) : $request->merge(['status' => 1]);

        return Lokasi::create($request->all());
    }

    public function update(Request $request, $id)
    {

        $user = Lokasi::findOrFail($id);

        $this->validate($request,[
            'lokasi' => 'required', 
            'lat' => 'required', 
            'long' => 'required', 
            'provinsi' => 'required', 
            'kab' => 'required',
            'kec' => 'required', 
            'kel' => 'required', 
            'user_id' => 'required'
        ]);

        ($request['status'] == 'false') ? $request->merge(['status' => 0]) : $request->merge(['status' => 1]);

        $user->update($request->all());
        return ['message' => 'Updated the user info'];
    }

    public function destroy($id)
    {

        $this->authorize('isAdmin');

        $user = Lokasi::findOrFail($id);

        $user->delete();

        return ['message' => 'Lokasi Deleted'];
    }

    public function search(){

        if ($search = \Request::get('q')) {
            $users = Lokasi::where(function($query) use ($search){
                $query->where('lokasi','LIKE',"%$search%")
                        ->orWhere('user_id','LIKE',"%$search%");
            })->paginate(20);
        }else{
            $users = Lokasi::latest()->paginate(20);
        }

        return $users;

    }
}
