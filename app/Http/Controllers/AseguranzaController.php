<?php

namespace App\Http\Controllers;

use App\Aseguranza;
use Illuminate\Http\Request;

class AseguranzaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Aseguranza $model)
    {
        return view('aseguranzas.index', ['aseguranzas' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('aseguranzas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validateInsurance();
        Aseguranza::create($validated);

        return redirect()->route('aseguranzas.index')->withStatus(__('Insurance successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Aseguranza $aseguranza)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Aseguranza $aseguranza)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aseguranza $aseguranza)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aseguranza $aseguranza)
    {
    }

    protected function validateInsurance()
    {
        return request()->validate([
            'nombre' => ['required', 'min:10', 'max:255'],
            'domicilio' => ['max:255'],
            'ciudad' => ['max:255'],
            'estado' => ['max:255'],
            'codigo_postal' => ['digits:5'],
            'telefono' => ['required', 'max:255'],
            'correo_e' => ['email'],
            'clave' => ['max:255'],
        ]);
    }
}
