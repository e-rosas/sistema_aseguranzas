<?php

namespace App\Http\Controllers;

use App\Item;
use App\ItemCategory;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = \App\Item::with('item_category')->paginate(15);

        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item_categories = ItemCategory::take(10)->get();

        return view('items.create', compact('item_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validateItem();
        Item::create($validated);

        return redirect()->route('items.index')->withStatus(__('Item successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
    }

    protected function validateItem()
    {
        return request()->validate([
            'code' => ['required', 'numeric'],
            'description' => ['required', 'max:255'],
            'price' => ['required', 'between:0,999999999.999'],
            'discounted_price' => ['required', 'between:0,999999999.999', 'lte:price'],
            'type' => ['max:255'],
            'SAT' => ['max:255'],
            'tax' => ['boolean'],
        ]);
    }
}
