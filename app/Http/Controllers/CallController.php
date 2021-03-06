<?php

namespace App\Http\Controllers;

use App\Call;
use App\Http\Requests\UpdateCallRequest;
use App\Http\Resources\CallResource;
use Illuminate\Http\Request;

class CallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $calls = Call::with('person_data', 'invoice')
            ->orderBy('date', 'desc')
            ->paginate(15)
        ;

        return view('calls.index', compact('calls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validateCall();
        Call::create($validated);

        return $this->getPersonCalls($request->person_data_id);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Call $call)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Call $call)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCallRequest $request)
    {
        $validated = $request->validated();
        $id = $request->id;

        $call = Call::findOrFail($id);
        $call->fill($validated);
        $call->save();

        return $this->getPersonCalls($call->person_data_id);
    }

    public function delete(Request $request)
    {
        $call = Call::findOrFail($request['call_id']);
        $person_data_id = $call->person_data_id;
        $call->delete();

        return $this->getPersonCalls($person_data_id);
    }

    public function validateCall()
    {
        return request()->validate(Call::$rules);
    }

    public function find(Request $request)
    {
        $call = Call::findOrFail($request->id);

        CallResource::withoutWrapping();

        return new CallResource($call);
    }

    private function getPersonCalls($person_data_id)
    {
        $calls = Call::where('person_data_id', $person_data_id)
            ->orderBy('date', 'desc')
            ->paginate(15)
        ;

        return CallResource::collection($calls);
    }
}
