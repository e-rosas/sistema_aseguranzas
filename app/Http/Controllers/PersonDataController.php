<?php

namespace App\Http\Controllers;

use App\Beneficiary;
use App\Insuree;
use App\PersonData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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
    public function storeInsuree(Request $request)
    {
        $data = $this->validateData();
        $insuree = $this->validateInsuree();
        $data['insured'] = 1;

        $personData = PersonData::create($data);
        $insuree['person_data_id'] = $personData->id;

        Insuree::create($insuree);

        return redirect()->route('insurees.index')->withStatus(__('Insuree successfully created.'));
    }

    public function storeBeneficiary(Request $request)
    {
        $data = $this->validateData();
        $beneficiary = $this->validateBeneficiary();
        $data['insured'] = 0;
        $insuree = DB::table('insurees')->where('person_data_id', $beneficiary['insuree_id'])->value('id');
        $beneficiary['insuree_id'] = $insuree;
        $personData = PersonData::create($data);
        $beneficiary['person_data_id'] = $personData->id;

        Beneficiary::create($beneficiary);

        return redirect()->route('beneficiaries.index')->withStatus(__('Beneficiary successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(PersonData $personData)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(PersonData $personData)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PersonData $personData)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(PersonData $personData)
    {
    }

    protected function validateData()
    {
        return request()->validate(PersonData::$rules);
    }

    protected function validateInsuree()
    {
        return request()->validate([
            'insurer_id' => ['required'],
            'insurance_id' => ['required'],
        ]);
    }

    protected function validateBeneficiary()
    {
        return request()->validate([
            'insuree_id' => ['required'],
        ]);
    }
}
