<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
      public function __construct()
    {
        $this->middleware('permission:view product')->only('index');
        $this->middleware('permission:create product')->only(['create', 'store']);
        $this->middleware('permission:edit product')->only(['edit', 'update']);
        $this->middleware('permission:delete product')->only('destroy');
    }
    public function index()
    {
        $colors = Color::latest()->paginate(10);
        return view('admin.products.colors.index', compact('colors'));
    }

    public function create()
    {
        return view('admin.products.colors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:colors,name|max:255',
            'code' => 'nullable|string|max:10',
            'status' => 'required|in:0,1',
        ]);

        Color::create([
            'name' => $request->name,
            'code' => $request->code,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.colors.index')->with('success', 'Color created successfully!');
    }

    public function edit(Color $color)
    {
        return view('admin.products.colors.edit', compact('color'));
    }

    public function update(Request $request, Color $color)
    {
        $request->validate([
            'name' => 'required|string|unique:colors,name,' . $color->id . '|max:255',
            'code' => 'nullable|string|max:10',
            'status' => 'required|in:0,1',
        ]);

        $color->update([
            'name' => $request->name,
            'code' => $request->code,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.colors.index')->with('success', 'Color updated successfully!');
    }

    public function destroy(Color $color)
    {
        $color->delete();
        return redirect()->route('admin.colors.index')->with('success', 'Color deleted successfully!');
    }
}
