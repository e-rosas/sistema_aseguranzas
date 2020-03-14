<?php

namespace App\Http\Controllers;

use App\PersonStats;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
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
    public function index()
    {
        /* $persons = PersonStats::with('person_data')->orderBy('amount_due', 'desc')->get();
        $topPersons = [];

        for ($i = 0; $i < 10; ++$i) {
            array_push($topPersons, $persons[$i]);
        } */

        return view('dashboard');
    }
}
