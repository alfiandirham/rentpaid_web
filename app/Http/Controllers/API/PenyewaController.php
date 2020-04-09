<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Penyewa as User;

class PenyewaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        // $this->authorize('isAdmin');
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor')) {
            return User::where('status', true)->latest()->paginate(20);
        }

    }

    public function collector()
    {
        // $this->authorize('isAdmin');
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor')) {
            return User::where('type', 'collector')->latest()->paginate(20);
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

        $this->authorize('isAdmin');

        $user = User::findOrFail($id);
        // delete the user

        $user->status = 0;
        $user->save();

        return ['message' => 'User Deleted'];
    }

    public function search(){

        if ($search = \Request::get('q')) {
            $users = User::where(function($query) use ($search){
                $query->where('nama','LIKE',"%$search%")
                        ->orWhere('ktp','LIKE',"%$search%")
                        ->orWhere('status',$search);
            })->paginate(20);
        }else{
            $users = User::latest()->paginate(20);
        }

        return $users;

    }
}

