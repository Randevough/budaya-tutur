<?php

namespace App\Http\Controllers;

use App\Models\CultureItem;
use App\Models\Province;
use App\Models\Regency;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        // 1. Featured / Recent items for homepage showcase
        $featuredItems = CultureItem::published()
            ->with(['regency.province'])
            ->latest()
            ->take(6)
            ->get();

        // 2. Map data: regencies that have published culture items (cached on file driver)
        $mapRegencies = \Illuminate\Support\Facades\Cache::remember('home_map_regencies', 86400, function () {
            return Regency::withPublishedItems()
                ->with([
                    'province:id,name',
                    'cultureItems' => fn ($query) => $query->where('is_published', true)
                        ->select('id', 'regency_id', 'title', 'slug', 'category', 'youtube_id'),
                ])
                ->get(['id', 'province_id', 'name', 'slug', 'latitude', 'longitude']);
        });

        // 3. Stats for editorial counter (cached on file driver)
        $stats = \Illuminate\Support\Facades\Cache::remember('home_stats', 86400, function () {
            return [
                'total_items' => CultureItem::published()->count(),
                'total_regencies' => Regency::withPublishedItems()->count(),
                'total_provinces' => Province::whereHas('regencies.cultureItems', fn ($q) => $q->where('is_published', true))->count(),
            ];
        });

        return view('home', compact('featuredItems', 'mapRegencies', 'stats'));
    }
}
