<?php

namespace App\Http\Controllers;

use App\Models\CultureItem;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArsipController extends Controller
{
    public function index(Request $request): View
    {
        $query = CultureItem::published()->with(['regency.province']);

        // Search filter: simultaneous match on title, excerpt, description, regency, and province
        if ($request->filled('q')) {
            $search = trim($request->input('q'));
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('regency', function ($rq) use ($search) {
                        $rq->where('name', 'like', "%{$search}%")
                            ->orWhereHas('province', function ($pq) use ($search) {
                                $pq->where('name', 'like', "%{$search}%");
                            });
                    });
            });
        }

        // Province filter
        if ($request->filled('province')) {
            $provinceSlug = $request->input('province');
            $query->whereHas('regency.province', function ($pq) use ($provinceSlug) {
                $pq->where('slug', $provinceSlug);
            });
        }

        // Dynamic responsive pagination: 6 on mobile, 9 on desktop by default
        $isMobile = (bool) preg_match('/Mobile|Android|iPhone/i', $request->userAgent() ?? '');
        $defaultPerPage = $isMobile ? 6 : 9;
        $perPage = in_array((int) $request->input('per_page'), [6, 9, 12], true)
            ? (int) $request->input('per_page')
            : $defaultPerPage;

        $items = $query->latest()->paginate($perPage)->withQueryString();

        // Filters data
        $provinces = Province::whereHas('regencies.cultureItems', fn ($q) => $q->where('is_published', true))->get();

        return view('arsip.index', compact('items', 'provinces'));
    }

    public function show(string $slug): View
    {
        $item = CultureItem::published()
            ->where('slug', $slug)
            ->with(['regency.province'])
            ->firstOrFail();

        // Related items: Prioritize nearest proximity (exact regency first, then province)
        $relatedItems = CultureItem::published()
            ->where('id', '!=', $item->id)
            ->where(function ($q) use ($item) {
                $q->where('regency_id', $item->regency_id)
                    ->orWhereHas('regency', function ($rq) use ($item) {
                        $rq->where('province_id', $item->regency->province_id);
                    });
            })
            ->orderByRaw("CASE WHEN regency_id = ? THEN 0 ELSE 1 END", [$item->regency_id])
            ->latest()
            ->take(3)
            ->get();

        return view('arsip.show', compact('item', 'relatedItems'));
    }
}
