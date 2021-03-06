<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Perusahaan;


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
            return User::where("type", 'collector')->where("status", true)->where('user_id', \Auth::user()->id)->latest()->paginate(20);
        }
        if (\Gate::allows('isOwner')) {
            return User::where('user_id', \Auth::user()->id)->where("type", 'admin')->where("status", true)->latest()->paginate(20);
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

    public function kolek()
    {
        $id = auth('api')->user()->id;
        if (\Gate::allows('isAuthor') ){
            return User::where("id", '!=' , $id)->where("type", "collector")->latest()->paginate(20);
        }
        if (\Gate::allows('isAdmin') ){
            return User::where("type", 'collector')->where("status", true)->where('user_id', \Auth::user()->id)->latest()->paginate(20);
        }
    }

    public function owner()
    {
        // $this->authorize('isAdmin');
        if (\Gate::allows('isAuthor')) {
            return User::where("status", true)->where('type', 'owner')->latest()->paginate(20);
        }
        if (\Gate::allows('isOwner') ){
            return User::where("status", true)->where('type', 'owner')->where('id', \Auth::user()->id)->latest()->paginate(20);
        }
        if (\Gate::allows('isAdmin') ){
            return User::where("status", true)->where('type', 'owner')->where('id', \Auth::user()->user_id)->latest()->paginate(20);
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

        $user = User::create([
            'photo' => $request['photo'] ? $request['photo'] : '',
            'lokasi_id' => $request['lokasi_id'] ? $request['lokasi_id'] : null,
            'name' => $request['name'],
            'email' => $request['email'],
            'type' => $request['type'],
            'user_id' => \Auth::user()->id,
            'nohp' => $request['nohp'],
            'status' => $request['status'],
            'ktp' => $request['ktp'],
            'password' => Hash::make($request['password']),
        ]);

        if($user->type === 'owner'){
            Perusahaan::create([
                'name' => 'Nama Perusahaan',
                'alamat' => 'Alamat Perusahaan',
                'user_id' => $user->id,
            ]);
        }

        return $user;
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

            $user = User::findOrFail($id);
            // delete the user

            $user->status = 0;
            $user->save();

            return ['message' => 'User Deleted'];
    }

    public function destroy2($id)
    {

            $user = User::findOrFail($id);
            // delete the user

            $user->status = 1;
            $user->save();

            return ['message' => 'User Deleted'];
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
                if (\Gate::allows('isAdmin')) {
                    $users = User::where("type", 'collector')->where("status", true)->where('user_id', \Auth::user()->id)->where("id", '!=', $id)->where(function($query) use ($search){
                        $query->where('name','LIKE',"%$search%")
                            ->orWhere('email','LIKE',"%$search%")
                            ->orWhere('status',$search)
                            ->orWhere('type',$search);
                    })->paginate(20);
                }
                if (\Gate::allows('isOwner')) {
                    $users = User::where('user_id', \Auth::user()->id)->where("type", 'admin')->where("status", true)->where('user_id', \Auth::user()->id)->where("id", '!=', $id)->where(function($query) use ($search){
                        $query->where('name','LIKE',"%$search%")
                            ->orWhere('email','LIKE',"%$search%")
                            ->orWhere('status',$search)
                            ->orWhere('type',$search);
                    })->paginate(20);
                }
            }
        }else{
            $users = User::where("status", true)->where("id", '!=', $id)->latest()->paginate(20);
            if (\Gate::allows('isAdmin')) {
                return User::where("type", 'collector')->where("status", true)->where('user_id', \Auth::user()->id)->latest()->paginate(20);
            }
            if (\Gate::allows('isOwner')) {
                return User::where('user_id', \Auth::user()->id)->where("type", 'admin')->where("status", true)->latest()->paginate(20);
            }
        }
        return $users;
    }
}
