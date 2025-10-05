<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $sizes = Size::latest()->paginate(10);
        return view('admin.products.sizes.index', compact('sizes'));
    }

    public function create()
    {
        return view('admin.products.sizes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ]);

        Size::create($request->only('name', 'status'));

        return redirect()->route('admin.sizes.index')->with('success', 'Size created successfully!');
    }

    public function edit(Size $size)
    {
        return view('admin.products.sizes.edit', compact('size'));
    }

    public function update(Request $request, Size $size)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ]);

        $size->update($request->only('name', 'status'));

        return redirect()->route('admin.sizes.index')->with('success', 'Size updated successfully!');
    }

    public function destroy(Size $size)
    {
        $size->delete();
        return redirect()->route('admin.sizes.index')->with('success', 'Size deleted successfully!');
    }
}
