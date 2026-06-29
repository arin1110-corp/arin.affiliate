<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ModelLandingSetting;
use App\Models\ModelPackage;
use App\Models\ModelUser;
use App\Models\ModelKategori;
use App\Models\ModelProduct;
use App\Models\ModelSlider;

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
    public function kategori($clientSlug, $slug)
    {
        $client = ModelUser::where('user_slug', $clientSlug)
            ->where('user_role', 'client')
            ->where('user_is_active', true)
            ->firstOrFail();

        $kategori = ModelKategori::where('user_id', $client->user_id)
            ->where('kategori_slug', $slug)
            ->where('kategori_is_active', true)
            ->firstOrFail();

        $products = ModelProduct::with('kategori')
            ->where('user_id', $client->user_id)
            ->where('product_kategori', $kategori->kategori_id)
            ->where('product_status', 'active')
            ->latest('product_id')
            ->paginate(12);

        return view(
            'front.client.kategori',
            compact(
                'client',
                'kategori',
                'products'
            )
        );
    }
    public function product($clientSlug, $slug)
    {
        $client = ModelUser::where('user_slug', $clientSlug)
            ->where('user_role', 'client')
            ->where('user_is_active', true)
            ->firstOrFail();

        $product = ModelProduct::with('kategori')
            ->where('user_id', $client->user_id)
            ->where('product_slug', $slug)
            ->where('product_status', 'active')
            ->firstOrFail();

        $relatedProducts = ModelProduct::with('kategori')
            ->where('user_id', $client->user_id)
            ->where('product_kategori', $product->kategori_id)
            ->where('product_id', '!=', $product->product_id)
            ->where('product_status', 'active')
            ->take(4)
            ->get();

        return view(
            'front.client.product',
            compact(
                'client',
                'product',
                'relatedProducts'
            )
        );
    }
}