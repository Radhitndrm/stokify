<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Http\Requests\UnitRequest;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UnitController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('permission:units-data', only: ['index']),
            new Middleware('permission:units-create', only: ['create', 'store']),
            new Middleware('permission:units-update', only: ['edit', 'update']),
            new Middleware('permission:units-destroy', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $currentPage = $request->input('page', 1);
        $perPage = $request->input('per_page', 10);

        $units = Unit::search()->latest()->paginate($perPage, ['*'], 'page', $currentPage)->withQueryString();

        return inertia('apps/units/index', [
            'units' => $units,
            'currentPage' => $currentPage,
            'perPage' => $perPage
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('apps/units/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UnitRequest $request)
    {
        Unit::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return to_route('apps.units.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        //
        return inertia('apps/units/edit', ['unit' => $unit]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UnitRequest $request, Unit $unit)
    {
        $unit->update([
            'name' => $request->name,
            'description' => $request->description
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        $unit->delete();

        return back();
    }
}
