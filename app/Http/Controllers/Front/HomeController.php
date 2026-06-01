<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ModelLandingSetting;
use App\Models\ModelPackage;

class HomeController extends Controller
{
    public function index()
    {
        $landing = ModelLandingSetting::firstOrCreate(
            ['landing_id' => 1],
            [
                'site_name' => 'ARIN',
                'hero_title' => 'Buat Website Affiliate Sendiri',
            ]
        );

        $packages = ModelPackage::where('package_is_active', true)
            ->orderBy('package_sort_order')
            ->get();

        return view('front.home', compact('landing', 'packages'));
    }
}