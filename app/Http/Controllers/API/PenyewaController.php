<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Penyewa as User;
use App\Lokasi;

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
            return User::latest()->paginate(20);
        }
        return \Auth::user()->penyewa()->where('status', true)->latest()->paginate(20);
    }

    public function collector()
    {
        // $this->authorize('isAdmin');
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor')) {
            return User::where('type', 'collector')->where("status", true)->latest()->paginate(20);
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
        $request->merge(['user_id' => \Auth::user()->id]);

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
               $users = User::where('status', false)->latest()->paginate(20); 
            }else if($search == "uvuvwu"){
                $users = User::where('status', true)->latest()->paginate(20);
                if(\Gate::allows('isAuthor')){
                    $users = User::latest()->paginate(20);
                }
            }else{
                $users = User::where('status', true)->where(function($query) use ($search){
                    $query->where('nama','LIKE',"%$search%")
                            ->orWhere('ktp','LIKE',"%$search%")
                            ->orWhere('status',$search);
                })->paginate(20);
            }
        }else{
            $users = User::where('status', true)->latest()->paginate(20);
        }
        return $users;
    }
}

