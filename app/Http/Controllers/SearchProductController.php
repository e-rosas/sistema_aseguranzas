<?php

namespace App\Http\Controllers;

use App\Item;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SearchProductController extends Controller
{
    public function searchService(Request $request)
    {
        $search = $request->search;
        $services = Service::query()
            ->whereLike('code', $search)
            ->whereLike('description', $search)
            ->get()->take(5)
        ;
        $response = [];
        foreach ($services as $service) {
            $response[] = [
                'id' => $service->id,
                'text' => $service->description,
            ];
        }
        echo json_encode($response);
        exit;
    }

    public function findService(Request $request)
    {
        Log::info('message'.$request);

        $service_id = $request->service_id;
        $service = Service::find($service_id)
        ;

        echo json_encode($service);
        exit;
    }

    public function searchItem(Request $request)
    {
        $search = $request->search;
        $items = Item::query()
            ->whereLike('name', $search)
            ->whereLike('last_name', $search)
            ->whereLike('maiden_name', $search)
            ->where('insured', 1)
            ->get()->take(5)
        ;
        $response = [];
        foreach ($items as $item) {
            $response[] = [
                'id' => $item->id,
                'text' => $item->fullName(),
            ];
        }
        echo json_encode($response);
        exit;
    }
}
