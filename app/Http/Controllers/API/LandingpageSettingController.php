<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\LandingpageSetting;
use Illuminate\Http\Request;

class LandingpageSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $data = [];
        $settings = [
            'link_button_login',
            'link_dapatkan_penawaran',
            'link_pelajari_selengkapnya',
            'address_head_office_makassar',
            'address_head_office_makassar2',
            'facebook',
            'whatsapp',
            'instagram',
            'link_tentang_kami',
            'link_karir',
            'link_syarat_ketentuan',
        ];
        foreach ($settings as $setting) {
            $data[$setting] = optional(LandingpageSetting::where('setting', $setting)->first())->value;
        }
        return response()->json($data);
    }

    public function update(Request $request)
    {
        foreach ($request->all() as $key => $value) {
            if ($setting = LandingpageSetting::where('setting', $key)->first()) {
                $setting->update([
                    'value' => $value
                ]);
            } else {
                LandingpageSetting::create([
                    'setting' => $key,
                    'value' => $value
                ]);
            }
        }
    }
}
