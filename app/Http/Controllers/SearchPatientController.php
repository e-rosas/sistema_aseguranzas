<?php

namespace App\Http\Controllers;

use App\PersonData;
use Illuminate\Http\Request;

class SearchPatientController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->search;
        $patients = PersonData::query()
            ->whereLike('name', $search)
            ->whereLike('last_name', $search)
            ->whereLike('maiden_name', $search)
            ->get()->take(5)
        ;
        $response = [];
        foreach ($patients as $patient) {
            $response[] = [
                'id' => $patient->id,
                'text' => $patient->fullName(),
            ];
        }
        echo json_encode($response);
        exit;
    }

    public function searchInsuree(Request $request)
    {
        $search = $request->search;
        $patients = PersonData::query()
            ->whereLike('name', $search)
            ->whereLike('last_name', $search)
            ->whereLike('maiden_name', $search)
            ->where('insured', 1)
            ->get()->take(5)
        ;
        $response = [];
        foreach ($patients as $patient) {
            $response[] = [
                'id' => $patient->id,
                'text' => $patient->fullName(),
            ];
        }
        echo json_encode($response);
        exit;
    }
}
