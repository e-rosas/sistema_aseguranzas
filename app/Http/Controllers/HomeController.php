<?php

namespace App\Http\Controllers;

use App\DiscountPersonData;
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
        $discounts = DiscountPersonData::with('person_data')
            ->where('active', 1)
            ->orderBy('end_date', 'desc')
            ->take(10)
            ->get()
        ;
        $insurance_discounts = PersonStats::with('person_data')
            ->where('status', 0)
            ->orderBy('amount_due', 'desc')
            ->take(10)
            ->get()
        ;

        $personal_discounts = PersonStats::with('person_data')
            ->where('status', 1)
            ->orderBy('personal_amount_due', 'desc')
            ->take(10)
            ->get()
        ;

        return view('dashboard', compact('discounts', 'insurance_discounts', 'personal_discounts'));
    }

    public function welcome()
    {
        return view('welcome');
    }
}
