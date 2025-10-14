<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubSubCategoryController extends Controller
{
      public function __construct()
    {
        $this->middleware('permission:view subsubcategory')->only('index');
        $this->middleware('permission:create subsubcategory')->only(['create', 'store']);
        $this->middleware('permission:edit subsubcategory')->only(['edit', 'update']);
        $this->middleware('permission:delete subsubcategory')->only('destroy');
    }
    public function index()
    {
        $subSubCategories = SubSubCategory::with(['category', 'subCategory'])->latest()->paginate(10);
        return view('admin.categories.subsubcategories.index', compact('subSubCategories'));
    }

    public function create()
    {
        $categories = Category::where('status', 1)->get();
        return view('admin.categories.subsubcategories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:0,1',
        ]);

        $image = $request->hasFile('image') ? ImageHelper::uploadImage($request->file('image')) : null;

        SubSubCategory::create([
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'image' => $image,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.subsubcategories.index')->with('success', 'Sub-SubCategory created successfully!');
    }

    public function edit(SubSubCategory $subSubCategory)
    {
        $categories = Category::where('status', 1)->get();
        $subcategories = SubCategory::where('category_id', $subSubCategory->category_id)->get();
        return view('admin.categories.subsubcategories.edit', compact('subSubCategory', 'categories', 'subcategories'));
    }

    public function update(Request $request, SubSubCategory $subSubCategory)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:0,1',
        ]);

        $data = $request->only('category_id', 'sub_category_id', 'name', 'status');
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('image')) {
            if ($subSubCategory->image) {
                Storage::disk('public')->delete($subSubCategory->image);
            }
            $data['image'] = ImageHelper::uploadImage($request->file('image'));
        }

        $subSubCategory->update($data);

        return redirect()->route('admin.subsubcategories.index')->with('success', 'Sub-SubCategory updated successfully!');
    }

    public function destroy(SubSubCategory $subSubCategory)
    {
        if ($subSubCategory->image && Storage::disk('public')->exists($subSubCategory->image)) {
            Storage::disk('public')->delete($subSubCategory->image);
        }
        $subSubCategory->delete();

        return redirect()->route('admin.subsubcategories.index')->with('success', 'Sub-SubCategory deleted successfully!');
    }

    // Ajax function to get subcategories by category
    public function getSubCategories(Category $category)
    {
        $subcategories = $category->subCategories()->where('status',1)->get();
        return response()->json($subcategories);
    }

    // SubSubCategories by SubCategory
    public function getSubSubCategories(SubCategory $subcategory)
    {
        $subSubCategories = $subcategory->subSubCategories()->where('status',1)->get();
        return response()->json($subSubCategories);
    }

}
