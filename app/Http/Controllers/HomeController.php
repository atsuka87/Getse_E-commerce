<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\SocialSetting;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::active()->featured()
            ->with(['primaryImage', 'category', 'brand'])
            ->take(8)->get();

        $latestProducts = Product::active()
            ->with(['primaryImage', 'category', 'brand'])
            ->orderByRaw('(CASE WHEN sale_price IS NOT NULL AND sale_price < price THEN 1 ELSE 0 END) DESC')
            ->latest()->take(8)->get();

        $categories = Category::where('is_active', true)
            ->withCount('products')
            ->orderBy('sort_order')
            ->get();

        $instagramUrl = SocialSetting::getInstagramUrl();

        return view('home', compact('featuredProducts', 'latestProducts', 'categories', 'instagramUrl'));
    }
}
