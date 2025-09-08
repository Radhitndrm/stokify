<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierRequest;
use App\Models\Order;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;

class SupplierController extends Controller
{

    public static function middleware()
    {
        return [
            new Middleware('permission:suppliers-data', only: ['index']),
            new Middleware('permission:suppliers-create', only: ['create', 'store']),
            new Middleware('permission:suppliers-update', only: ['edit', 'store']),
            new Middleware('permission:suppliers-destroy', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentPage = request()->input('page', 1);
        $perPage = request()->input('per_page', 10);

        $suppliers = Supplier::search()->latest()->paginate($perPage, ['*'], 'page', $currentPage)->withQueryString();

        return inertia('apps/suppliers/index', [
            'suppliers' => $suppliers,
            'currentPage' => $currentPage,
            'perPage' => $perPage,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $supplierCode = Supplier::generateCode('SPR');

        return inertia('apps/suppliers/create', ['supplierCode' => $supplierCode]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplierRequest $request)
    {
        Supplier::create([
            'code' => $request->code,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address
        ]);

        return to_route('apps.suppliers.index');
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
    public function edit(Supplier $supplier)
    {
        return inertia('apps/suppliers/edit', ['supplier' => $supplier]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $supplier->update([
            'code' => $request->code,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address
        ]);

        return to_route('apps.suppliers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier, Request $request)
    {
        $supplier->update(['deleted_by' => $request->user()->id]);

        $supplier->delete();

        return to_route('apps.suppliers.index');
    }

    public function getOrders(Supplier $supplier)
    {
        $orders = Order::query()
            ->with('supplier')
            ->success()
            ->notReceived()
            ->where('supplier_id', $supplier->id)->get();

        return response()->json([
            'data' => $orders
        ]);
    }
}
