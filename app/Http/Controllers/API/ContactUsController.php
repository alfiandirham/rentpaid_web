<?php

namespace App\Http\Controllers\API;

use App\ContactUs;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContactUs AS ContactUsCollection;

class ContactUsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        return ContactUsCollection::collection(ContactUs::where(function($q){
            if (request()->has('q')){
                $q->where('name','like','%'.request('q').'%');
                $q->orWhere('email','like','%'.request('q').'%');
                $q->orWhere('perusahaan','like','%'.request('q').'%');
                $q->orWhere('pesan','like','%'.request('q').'%');
            }
        })->latest()->paginate(20));
    }
}

