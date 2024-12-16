<?php

namespace App\Http\Controllers;

use App\Charts\BarangTerpakai;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index( BarangTerpakai $chart)
    {
        return view('admin.dashboard' , ['chart' => $chart->build()]);
    }
}
