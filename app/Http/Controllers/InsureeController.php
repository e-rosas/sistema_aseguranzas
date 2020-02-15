<?php

namespace App\Http\Controllers;

use App\Insuree;
use App\Insurer;
use Illuminate\Http\Request;

class InsureeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Insuree $model)
    {
        return view('insurees.index', ['insurees' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $insurers = Insurer::take(10)->get();

        return view('insurees.create', compact('insurers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Insuree $Insuree)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Insuree $Insuree)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Insuree $Insuree)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Insuree $Insuree)
    {
    }

    public function search(Request $request)
    {
        $insurees = Insuree::query()
            ->whereLike(['name', 'last_name', 'maiden_name', 'email'], $request->search)
            ->get()->take(10);
    }
}