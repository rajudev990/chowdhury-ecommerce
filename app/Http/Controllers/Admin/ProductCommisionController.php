<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCommision;
use Illuminate\Http\Request;

class ProductCommisionController extends Controller
{

     public function __construct()
    {
        $this->middleware('permission:view configuration')->only('index');
        $this->middleware('permission:create configuration')->only(['create', 'store']);
        $this->middleware('permission:edit configuration')->only(['edit', 'update']);
        $this->middleware('permission:delete configuration')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::with('commission')->where('status', 1)->get();
        return view('admin.products.commission.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'commission' => 'required|numeric|min:0|max:100', // Commission should be between 0% and 100%
        ]);

        // Update or Create a new ProductCommission entry for the given product
        $commission = ProductCommision::updateOrCreate(
            ['product_id' => $request->product_id], // If the product_id exists, it will update, otherwise create
            ['amount' => $request->commission]      // Set the new commission value
        );

        // Redirect back with success message
        return back()->with('success', 'Commission updated successfully!');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
