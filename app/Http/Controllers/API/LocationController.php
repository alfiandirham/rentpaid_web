<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Location;
use App\Http\Resources\TenantCollections;
use App\Lokasi;
use App\User;

class LocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        // $this->authorize('isAdmin');
        if (\Gate::allows('isAdmin')) {
            $id = \Auth::user()->lokasi_id;
            return Location::collection(Lokasi::where(['status' => true, 'id' => $id])->latest()->paginate(20));
        }
        if(\Gate::allows('isOwner')){
            return Location::collection(\Auth::user()->location()->where('status', true)->latest()->paginate(20));
        }
        if (\Gate::allows('isAuthor')) {
            return Location::collection(Lokasi::latest()->paginate(20));
        }
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'lokasi' => 'required', 
            'kode' => 'required|unique:lokasis', 
            'luas' => 'required', 
            'kecamatan' => 'required', 
            'desa' => 'required', 
            'alamat' => 'required', 
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
            'kode' => 'required|unique:lokasis,lokasi,'.$user->id, 
            'luas' => 'required', 
            'kecamatan' => 'required', 
            'desa' => 'required', 
            'alamat' => 'required', 
            'user_id' => 'required'
        ]);

        ($request['status'] == 'false') ? $request->merge(['status' => 0]) : $request->merge(['status' => 1]);

        $user->update($request->all());
        return ['message' => 'Updated the user info'];
    }

    public function destroy($id)
    {
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor') || \Gate::allows('isOwner')) {
            $user = Lokasi::findOrFail($id);

            $user->status = 0;
            $user->save();

            return ['message' => 'Lokasi Deleted'];
        }
    }

    public function destroy2($id)
    {
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor') || \Gate::allows('isOwner')) {
            $user = Lokasi::findOrFail($id);

            $user->status = 1;
            $user->save();

            return ['message' => 'Lokasi Deleted'];
        }
    }

    public function search(){

        if ($search = \Request::get('q')) {
            if ($search == "uvuvwe" && \Gate::allows('isAuthor')) {
                $users = Location::collection(Lokasi::where('status', false)->latest()->paginate(20));
            }else if($search == "uvuvwu"){
                $users = Location::collection(Lokasi::where('status', true)->latest()->paginate(20));
                if(\Gate::allows('isAuthor')){
                    $users = Location::collection(Lokasi::latest()->paginate(20));
                }
            }else {
                $users = Location::collection(Lokasi::where('status', true)->where(function($query) use ($search){
                        $query->where('lokasi','LIKE',"%$search%")
                                ->orWhere('status','LIKE',"%$search%")
                                ->orWhere('user_id','LIKE',"%$search%");
                        })->paginate(20));
                if(\Gate::allows('isAuthor')){
                    $users = Location::collection(Lokasi::where(function($query) use ($search){
                        $query->where('lokasi','LIKE',"%$search%")
                                ->orWhere('status','LIKE',"%$search%")
                                ->orWhere('user_id','LIKE',"%$search%");
                        })->paginate(20));
                }
                if(\Gate::allows('isOwner')){
                    $users = Location::collection(Lokasi::where('status', true)->where('user_id', \Auth::user()->id)->where(function($query) use ($search){
                        $query->where('lokasi','LIKE',"%$search%")
                                ->orWhere('status','LIKE',"%$search%")
                                ->orWhere('user_id','LIKE',"%$search%");
                        })->paginate(20));
                }
            }
        }else{
            $users = Location::collection(Lokasi::where('status', true)->latest()->paginate(20));
            if(\Gate::allows('isOwner')){
                $users = Location::collection(Lokasi::where('status', true)->where('user_id', \Auth::user()->id)->latest()->paginate(20));
            }
        }

        return $users;
    }

    public function search2(){
        if ($search = \Request::get('q')) {
            if($search == "uvuvwe" && \Gate::allows('isAuthor')){
                $users = TenantCollections::collection(Lokasi::where('status', false)->latest()->paginate(20));
            }else if($search == "uvuvwu"){
                $users = TenantCollections::collection(Lokasi::where('status', true)->latest()->paginate(20));
                if(\Gate::allows('isAuthor')){
                    $users = TenantCollections::collection(Lokasi::latest()->paginate(20));
                }
            }else{
                $users = TenantCollections::collection(Lokasi::where('status', true)->where(function($query) use ($search){
                    $query->where('lokasi','LIKE',"%$search%")
                            ->orWhere('status','LIKE',"%$search%")
                            ->orWhere('user_id','LIKE',"%$search%");
                })->paginate(20));
                if(\Gate::allows('isAuthor')){
                    $users = TenantCollections::collection(Lokasi::where(function($query) use ($search){
                        $query->where('lokasi','LIKE',"%$search%")
                                ->orWhere('status','LIKE',"%$search%")
                                ->orWhere('user_id','LIKE',"%$search%");
                    })->paginate(20));
                }
                if(\Gate::allows('isOwner')){
                    $users = TenantCollections::collection(Lokasi::where('status', true)->where('user_id', \Auth::user()->id)->where(function($query) use ($search){
                        $query->where('lokasi','LIKE',"%$search%")
                                ->orWhere('status','LIKE',"%$search%")
                                ->orWhere('user_id','LIKE',"%$search%");
                    })->paginate(20));
                }
            }
        }else{
            $users = TenantCollections::collection(Lokasi::where('status', true)->latest()->paginate(20));
            if(\Gate::allows('isOwner')){
                $users = TenantCollections::collection(Lokasi::where('status', true)->where('user_id', \Auth::user()->id)->latest()->paginate(20));
            }
        }
        return $users;
    }
}
