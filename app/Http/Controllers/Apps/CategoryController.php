<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Redis;

class CategoryController extends Controller
{
    public static function middleware()
    {
        return [
            new Middleware('permission:categories-data', only: ['index']),
            new Middleware('permission:categories-create', only: ['create', 'store']),
            new Middleware('permission:categories-update', only: ['edit', 'update']),
            new Middleware('permission:categories-destroy', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $currentPage = $request->input('page', 1);
        $perPage = $request->input('per_page', 10);

        $categories = Category::search()->latest()->paginate($perPage, ['*'], 'page', $currentPage)->withQueryString();

        return inertia('apps/categories/index', [
            'categories' => $categories,
            'currentPage' => $currentPage,
            'perPage' => $perPage
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('apps/categories/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return to_route('apps.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return inertia('apps/categories/edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return to_route('apps.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return back();
    }
}
