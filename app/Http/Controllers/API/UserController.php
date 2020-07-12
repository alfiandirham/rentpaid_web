<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        // $this->authorize('isAdmin');
        if (\Gate::allows('isAdmin')) {
            $user = auth('api')->user();
            return User::where("status", true)->where("id", '!=', $user->id)->latest()->paginate(20);
        }
        if (\Gate::allows('isAuthor')) {
            $user = auth('api')->user();
            return User::where("id", '!=', $user->id)->latest()->paginate(20);
        }
    }

    public function kolektor($id)
    {
        return User::where("id", $id)->where("status", true)->where("type", "collector")->first();
    }

    public function owner()
    {
        // $this->authorize('isAdmin');
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor')) {
            return User::where("status", true)->where('type', 'owner')->latest()->paginate(20);
        }
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6'
        ]);

        if($request->photo){
            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];

            \Image::make($request->photo)->save(public_path('img/profile/').$name);
            $request->merge(['photo' => $name]);
        }

        ($request['status'] == 'false') ? $request->merge(['status' => 0]) : $request->merge(['status' => 1]);

        return User::create([
            'photo' => $request['photo'] ? $request['photo'] : '',
            'lokasi_id' => $request['lokasi_id'] ? $request['lokasi_id'] : null,
            'name' => $request['name'],
            'email' => $request['email'],
            'type' => $request['type'],
            'nohp' => $request['nohp'],
            'status' => $request['status'],
            'ktp' => $request['ktp'],
            'password' => Hash::make($request['password']),
        ]);
    }


    public function updateProfile(Request $request)
    {
        $user = auth('api')->user();

        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password' => 'sometimes|required|min:6'
        ]);

        $currentPhoto = $user->photo;

        if($request->photo != $currentPhoto){
            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];

            \Image::make($request->photo)->save(public_path('img/profile/').$name);
            $request->merge(['photo' => $name]);

            $userPhoto = public_path('img/profile/').$currentPhoto;
            if(file_exists($userPhoto)){
                @unlink($userPhoto);
            }
        }

        if(!empty($request->password)){
            $request->merge(['password' => Hash::make($request['password'])]);
        }

        $user->update($request->all());
        return ['message' => "Success"];
    }


    public function profile()
    {
        return auth('api')->user();
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password' => 'sometimes|min:6'
        ]);
        
        $currentPhoto = $user->photo;

        if($request->photo != $currentPhoto){
            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];

            \Image::make($request->photo)->save(public_path('img/profile/').$name);
            $request->merge(['photo' => $name]);

            $userPhoto = public_path('img/profile/').$currentPhoto;
            if(file_exists($userPhoto)){
                @unlink($userPhoto);
            }
        }

        if(!empty($request->password)){
            $request->merge(['password' => Hash::make($request['password'])]);
        }
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
        $id = auth('api')->user()->id;
        if ($search = \Request::get('q')) {
            if($search == "uvuvwe"  && \Gate::allows('isAuthor')){
                 $users = User::where("status", false)->where("id", '!=', $id)->latest()->paginate(20);
            }else if($search == "uvuvwu"){
                $users = User::where("status", true)->where("id", '!=', $id)->latest()->paginate(20);
                if(\Gate::allows('isAuthor')){
                    $users = User::where("id", '!=', $id)->latest()->paginate(20);
                }
            }else {
                $users = User::where("status", true)->where("id", '!=', $id)->where(function($query) use ($search){
                    $query->where('name','LIKE',"%$search%")
                            ->orWhere('email','LIKE',"%$search%")
                            ->orWhere('status',$search)
                            ->orWhere('type',$search);
                })->paginate(20);
            }
        }else{
            $users = User::where("status", true)->where("id", '!=', $id)->latest()->paginate(20);
        }
        return $users;
    }
}
