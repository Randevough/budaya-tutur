<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\View\View;

class DonationController extends Controller
{
    public function index(): View
    {
        $settings = SiteSetting::current();

        if (! $settings->is_donation_active) {
            abort(404);
        }

        return view('donasi', compact('settings'));
    }
}
