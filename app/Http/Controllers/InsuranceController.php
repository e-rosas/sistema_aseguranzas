<?php

namespace App\Http\Controllers;

use App\Insurance;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Insurance $model)
    {
        return view('insurances.index', ['insurances' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('insurances.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validateInsurance();
        Insurance::create($validated);

        return redirect()->route('insurances.index')->withStatus(__('Insurance successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Insurance $insurance)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Insurance $insurance)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Insurance $insurance)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Insurance $insurance)
    {
    }

    protected function validateInsurance()
    {
        return request()->validate([
            'name' => ['required', 'min:10', 'max:255'],
            'address' => ['max:255'],
            'city' => ['max:255'],
            'state' => ['max:255'],
            'postal_code' => ['digits:5'],
            'phone_number' => ['required', 'max:255'],
            'email' => ['email'],
            'code' => ['max:255'],
        ]);
    }
}
