<?php

namespace App\Http\Controllers;

use App\Insurer;
use Illuminate\Http\Request;

class InsurerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Insurer $model)
    {
        return view('insurers.index', ['insurers' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('insurers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validateInsurer();
        Insurer::create($validated);

        return redirect()->route('insurers.index')->withStatus(__('Insurer successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Insurer $Insurer)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Insurer $Insurer)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Insurer $Insurer)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Insurer $Insurer)
    {
    }

    protected function validateInsurer()
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
