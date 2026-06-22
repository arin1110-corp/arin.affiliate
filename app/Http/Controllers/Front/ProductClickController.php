<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ModelProduct;

class ProductClickController extends Controller
{
    public function click($clientSlug, $productSlug)
    {
        $product = ModelProduct::where('product_slug', $productSlug)
            ->where('product_status', 'active')
            ->whereHas('user', function ($query) use ($clientSlug) {
                $query->where('user_slug', $clientSlug)
                    ->where('user_role', 'client')
                    ->where('user_is_active', true);
            })
            ->firstOrFail();

        $product->increment('product_total_click');

        return redirect()->away($product->product_affiliate_link);
    }
    public function clickSubdomain($subdomain, $productSlug)
    {
        $client = \App\Models\ModelUser::where('user_slug', $subdomain)
            ->where('user_role', 'client')
            ->where('user_is_active', true)
            ->firstOrFail();

        $product = \App\Models\ModelProduct::where('user_id', $client->user_id)
            ->where('product_slug', $productSlug)
            ->where('product_status', 'active')
            ->firstOrFail();

        $product->increment('product_total_click');

        return redirect()->away($product->product_affiliate_link);
    }
}