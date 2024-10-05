<?php

namespace App\Http\Controllers;

use App\Models\Region;

class MainController extends Controller
{
    public function index()
    {
        $regions = Region::with('cities')->get();
        return view('index', compact('regions'));
    }
    public function about()
    {
        return view('about');
    }
    public function news()
    {
        return view('news');
    }
}
