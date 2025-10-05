<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Helpers\ImageHelper;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'subCategory', 'subSubCategory', 'brand'])->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        $colors = Color::where('status', 1)->get();
        $sizes = Size::where('status', 1)->get();
        return view('admin.products.create', compact('categories', 'brands', 'colors', 'sizes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'sub_sub_category_id' => 'required|exists:sub_sub_categories,id',
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:0,1',
            'price' => 'required|numeric',
            'sku' => 'nullable|string|max:50',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'featured_image_1' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'featured_image_2' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'variants.*.color_id' => 'required|exists:colors,id',
            'variants.*.size_id' => 'required|exists:sizes,id',
            'variants.*.price' => 'required|numeric',
            'variants.*.stock' => 'required|numeric',
        ]);

        $product = Product::create([
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'sub_sub_category_id' => $request->sub_sub_category_id,
            'brand_id' => $request->brand_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'status' => $request->status,
            'regular_price' => $request->price,
            'sku' => $request->sku,
            'stock' => $request->stock ?? 0,
            'is_featured' => $request->has('is_featured') ? 1 : 0,
            'is_popular' => $request->has('is_popular') ? 1 : 0,
            'is_new' => $request->has('is_new') ? 1 : 0,
        ]);

        // Upload multiple images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = ImageHelper::uploadImage($img);
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                ]);
            }
        }

        // Upload featured images
        if ($request->hasFile('featured_image_1')) {
            $path = ImageHelper::uploadImage($request->file('featured_image_1'));
            $product->update(['featured_image_1' => $path]);
        }
        if ($request->hasFile('featured_image_2')) {
            $path = ImageHelper::uploadImage($request->file('featured_image_2'));
            $product->update(['featured_image_2' => $path]);
        }

        // Variants
        if ($request->variants) {
            foreach ($request->variants as $variant) {
                ProductVariant::create([
                    'product_id' => $product->id,
                    'color_id' => $variant['color_id'],
                    'size_id' => $variant['size_id'],
                    'price' => $variant['price'],
                    'stock' => $variant['stock'],
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }


    public function edit(Product $product)
    {
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        $colors = Color::where('status', 1)->get();
        $sizes = Size::where('status', 1)->get();
        $subcategories = SubCategory::where('category_id', $product->category_id)->get();
        $subsubcategories = SubSubCategory::where('sub_category_id', $product->sub_category_id)->get();

        return view('admin.products.edit', compact(
            'product', 'categories', 'brands', 'colors', 'sizes', 'subcategories', 'subsubcategories'
        ));
    }


    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'sub_sub_category_id' => 'required|exists:sub_sub_categories,id',
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:0,1',
            'price' => 'required|numeric',
            'sku' => 'nullable|string|max:50',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'featured_image_1' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'featured_image_2' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'variants.*.color_id' => 'required|exists:colors,id',
            'variants.*.size_id' => 'required|exists:sizes,id',
            'variants.*.price' => 'required|numeric',
            'variants.*.stock' => 'required|numeric',
        ]);

        $product->update([
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'sub_sub_category_id' => $request->sub_sub_category_id,
            'brand_id' => $request->brand_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'status' => $request->status,
            'regular_price' => $request->price,
            'sku' => $request->sku,
            'stock' => $request->stock ?? 0,
            'is_featured' => $request->has('is_featured') ? 1 : 0,
            'is_popular' => $request->has('is_popular') ? 1 : 0,
            'is_new' => $request->has('is_new') ? 1 : 0,
        ]);

        // Upload multiple images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = ImageHelper::uploadImage($img);
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                ]);
            }
        }

        // Upload featured images
        if ($request->hasFile('featured_image_1')) {
            $path = ImageHelper::uploadImage($request->file('featured_image_1'));
            $product->update(['featured_image_1' => $path]);
        }
        if ($request->hasFile('featured_image_2')) {
            $path = ImageHelper::uploadImage($request->file('featured_image_2'));
            $product->update(['featured_image_2' => $path]);
        }

        // Remove old variants and add new ones
        $product->variants()->delete();
        if ($request->variants) {
            foreach ($request->variants as $variant) {
                ProductVariant::create([
                    'product_id' => $product->id,
                    'color_id' => $variant['color_id'],
                    'size_id' => $variant['size_id'],
                    'price' => $variant['price'],
                    'stock' => $variant['stock'],
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }


    public function destroy(Product $product)
    {
        foreach ($product->images as $img) {
            if (Storage::disk('public')->exists($img->image)) Storage::disk('public')->delete($img->image);
            $img->delete();
        }
        $product->variants()->delete();
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }

    // AJAX
    public function getSubCategories(Category $category)
    {
        return response()->json($category->subCategories()->where('status', 1)->get());
    }

    public function getSubSubCategories(SubCategory $subCategory)
    {
        return response()->json($subCategory->subSubCategories()->where('status', 1)->get());
    }

    public function removeImage($id)
    {
        $image = ProductImage::findOrFail($id);

        // Delete from storage
        if (Storage::exists($image->image)) {
            Storage::delete($image->image);
        }

        // Delete from database
        $image->delete();

        return back()->with('success', 'Image removed successfully!');
    }
}
