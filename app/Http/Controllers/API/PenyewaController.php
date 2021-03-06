<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Penyewa as User;
use App\Lokasi;
use App\User as User2;

class PenyewaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        // $this->authorize('isAdmin');
        // if (\Gate::allows('isAdmin')) {
        // }
        if (\Gate::allows('isAuthor')) {
            return User::orderBy('nama')->paginate(20);
        }
        if (\Gate::allows('isAdmin')) {
            $id = \Auth::user();
            $user = User2::findOrFail($id->user_id);
            return $user->penyewa()->where(['status' => true, 'lokasi_id' => $id->lokasi->id])->orderBy('nama')->paginate(20);
        }
        return \Auth::user()->penyewa()->where('status', true)->orderBy('nama')->paginate(20);
    }

    public function index2()
    {
        // $this->authorize('isAdmin');
        // if (\Gate::allows('isAdmin')) {
        // }
        if (\Gate::allows('isAuthor')) {
            return User::all()->orderBy('nama')->take(100)->get();
        }
        if (\Gate::allows('isAdmin')) {
            $id = \Auth::user();
            $user = User2::findOrFail($id->user_id);
            return $user->penyewa()->where(['status' => true, 'lokasi_id' => $id->lokasi->id])->orderBy('nama')->get();
        }
        return \Auth::user()->penyewa()->where('status', true)->orderBy('nama')->get();
    }

    public function collector()
    {
        // $this->authorize('isAdmin');
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor')) {
            return User::where('type', 'collector')->where("status", true)->orderBy('nama')->paginate(20);
        }

    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'nama' => 'required', 
            'hp' => 'required', 
            'ktp' => 'required', 
            'alamat' => 'required', 
            'status' => 'required'
        ]);

        ($request['status'] == 'false') ? $request->merge(['status' => 0]) : $request->merge(['status' => 1]);
        if (\Gate::allows('isAdmin')) {
            $id = \Auth::user();
            $user = User2::findOrFail($id->user_id);
            $request->merge(['user_id' => $user->id, 'lokasi_id' => $id->lokasi_id]);
        }

        if (\Gate::allows('isOwner')) {
            $request->merge(['user_id' => \Auth::user()->id]);
        }

        return User::create($request->all());
    }

    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);

        $this->validate($request,[
            'nama' => 'required', 
            'hp' => 'required', 
            'ktp' => 'required', 
            'alamat' => 'required', 
            'status' => 'required'
        ]);

        ($request['status'] == 'false') ? $request->merge(['status' => 0]) : $request->merge(['status' => 1]);

        $user->update($request->all());
        return ['message' => 'Updated the user info'];
    }

    public function destroy($id)
    {
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor')) {
            $user = User::findOrFail($id);
            // delete the user

            $user->status = 0;
            $user->save();

            return ['message' => 'User Deleted'];
        }
    }

    public function destroy2($id)
    {
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor')) {
            $user = User::findOrFail($id);
            // delete the user

            $user->status = 1;
            $user->save();

            return ['message' => 'User Deleted'];
        }
    }

    public function search(){

        if ($search = \Request::get('q')) {
            if($search == "uvuvwe"  && \Gate::allows('isAuthor')){
               $users = User::where('status', false)->orderBy('nama')->paginate(20); 
            }else if($search == "uvuvwu"){
                $users = User::where('status', true)->orderBy('nama')->paginate(20);
                if(\Gate::allows('isAuthor')){
                    $users = User::orderBy('nama')->paginate(20);
                }
            }else{
                $users = User::where('user_id', \Auth::user()->id)->orWhere('lokasi_id', \Auth::user()->lokasi_id)->where('status', true)->where(function($query) use ($search){
                    $query->where('nama','LIKE',"%$search%")
                            ->orWhere('ktp','LIKE',"%$search%")
                            ->orWhere('status',$search);
                })->paginate(20);
            }
        }else{
            $users = \Auth::user()->penyewa()->where('status', true)->orderBy('nama')->paginate(20);
            if (\Gate::allows('isAuthor')) {
                $users = User::orderBy('nama')->paginate(20);
            }
            if (\Gate::allows('isAdmin')) {
                $id = \Auth::user();
                $user = User2::findOrFail($id->user_id);
                $users = $user->penyewa()->where(['status' => true, 'lokasi_id' => $id->lokasi->id])->orderBy('nama')->paginate(20);
            }
        }
        return $users;
    }
}

