<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $campaigns = Campaign::with('categories')->latest()->take(3)->get();

        return view('home', compact('campaigns'));
    }

    public function donasi(): View
    {
        $campaigns = Campaign::with(['categories', 'account', 'donations'])
            ->latest()
            ->get();

        return view('donasi', compact('campaigns'));
    }

    public function profil(): View
    {
        return view('profil');
    }

    public function kontak(): View
    {
        return view('kontak');
    }
}
