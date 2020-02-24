<?php

namespace App\Http\Controllers;

use App\Item;
use App\Service;
use Illuminate\Http\Request;

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
                'text' => $service->code.' '.$service->description,
            ];
        }
        echo json_encode($response);
        exit;
    }

    public function findService(Request $request)
    {
        $service_id = $request->service_id;
        $service = Service::find($service_id, ['id', 'code', 'description', 'price', 'discounted_price'])
        ;

        echo json_encode($service);
        exit;
    }

    public function searchItem(Request $request)
    {
        $search = $request->search;
        $items = Item::query()
            ->whereLike('code', $search)
            ->whereLike('description', $search)
            ->get()->take(5)
        ;
        $response = [];
        foreach ($items as $item) {
            $response[] = [
                'id' => $item->id,
                'text' => $item->code.' '.$item->description,
            ];
        }
        echo json_encode($response);
        exit;
    }

    public function findItem(Request $request)
    {
        $item_id = $request->item_id;
        $item = Item::find($item_id, ['id', 'code', 'description', 'price', 'discounted_price', 'tax'])
        ;

        echo json_encode($item);
        exit;
    }
}
