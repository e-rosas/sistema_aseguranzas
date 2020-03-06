<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $model)
    {
        return view('categories.index', ['categories' => $model->paginate(15)]);
    }

    public function list()
    {
        $categories = Category::query();

        return DataTables::eloquent($categories)
            ->addColumn('action', function ($id) {
                return '<button class="btn btn-icon btn-outline-info btn-sm"  type="button" onClick="showEditCallModal('.$id->id.')">
                <span class="btn-inner--icon">
                    <i class="fas fa-eye"></i>
                </span>
            </button>
            <button class="btn btn-icon btn-outline-warning btn-sm"  type="button" onClick="showEditCallModal('.$id->id.')">
                <span class="btn-inner--icon">
                    <i class="fas fa-edit"></i>
                </span>
            </button>
            <button class="btn btn-icon btn-outline-danger btn-sm"  type="button" onClick="showEditCallModal('.$id->id.')">
                <span class="btn-inner--icon">
                    <i class="fas fa-trash"></i>
                </span>
            </button>'
            ;
            })
            ->toJson()
        ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validateItemCategory();
        Category::create($validated);

        return redirect()->route('categories.index')->withStatus(__('Category successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Category $Category)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $itemCategory)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $itemCategory)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $itemCategory)
    {
    }

    protected function validateItemCategory()
    {
        return request()->validate([
            'name' => ['required', 'max:255'],
        ]);
    }
}
