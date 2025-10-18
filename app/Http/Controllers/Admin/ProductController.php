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
     public function __construct()
{
    // Product permissions
    $this->middleware('permission:view product')->only('index');
    $this->middleware('permission:create product')->only(['create', 'store']);
    $this->middleware('permission:edit product')->only(['edit', 'update']);
    $this->middleware('permission:delete product')->only('destroy');

    $this->middleware('permission:view seller-product')->only('indexSeller');
    $this->middleware('permission:create seller-product')->only(['createSeller', 'storeSeller']);
    $this->middleware('permission:edit seller-product')->only(['editSeller', 'updateSeller']);
    $this->middleware('permission:delete seller-product')->only('destroySeller');
}


    public function index()
    {
        $products = Product::with(['category', 'subCategory', 'subSubCategory', 'brand'])->whereNull('vendor_id')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function sellerProduct()
    {
        $products = Product::with(['category', 'subCategory', 'subSubCategory', 'brand'])->whereNotNull('vendor_id')->latest()->paginate(10);
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
            'sub_category_id' => 'nullable|exists:sub_categories,id',
            'sub_sub_category_id' => 'nullable|exists:sub_sub_categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'name' => 'required|string|max:255',
            'status' => 'required|in:0,1',
            'regular_price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'featured_image_1' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'featured_image_2' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
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
            'purchase_price' => $request->purchase_price,
            'regular_price' => $request->regular_price,
            'sale_price' => $request->sale_price,
            'sku' => $request->sku,
            'unit' => $request->unit,
            'stock' => $request->stock ?? 0,
            'is_featured' => $request->has('is_featured') ? 1 : 0,
            'is_popular' => $request->has('is_popular') ? 1 : 0,
            'is_new' => $request->has('is_new') ? 1 : 0,
        ]);

        // Multiple images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                if ($img->isValid()) {
                    $path = ImageHelper::uploadImage($img);
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $path,
                    ]);
                }
            }
        }

        // Featured images
        if ($request->hasFile('featured_image_1')) {
            $product->update(['featured_image_1' => ImageHelper::uploadImage($request->file('featured_image_1'))]);
        }
        if ($request->hasFile('featured_image_2')) {
            $product->update(['featured_image_2' => ImageHelper::uploadImage($request->file('featured_image_2'))]);
        }

        // Variants
        if (!empty($request->variants)) {
            foreach ($request->variants as $variant) {
                if (
                    !empty($variant['color_id']) ||
                    !empty($variant['size_id']) ||
                    !empty($variant['price']) &&
                    !empty($variant['stock'])
                ) {
                    ProductVariant::create([
                        'product_id' => $product->id,
                        'color_id'   => $variant['color_id'],
                        'size_id'    => $variant['size_id'],
                        'price'      => $variant['price'],
                        'stock'      => $variant['stock'],
                    ]);
                }
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
            'product',
            'categories',
            'brands',
            'colors',
            'sizes',
            'subcategories',
            'subsubcategories'
        ));
    }


    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'nullable|exists:sub_categories,id',
            'sub_sub_category_id' => 'nullable|exists:sub_sub_categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'name' => 'required|string|max:255',
            'status' => 'required|in:0,1',
            'regular_price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'featured_image_1' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'featured_image_2' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
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
            'unit' => $request->unit,
            'purchase_price' => $request->purchase_price,
            'regular_price' => $request->regular_price,
            'sale_price' => $request->sale_price,
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
        // if ($request->variants) {
        //     foreach ($request->variants as $variant) {
        //         ProductVariant::create([
        //             'product_id' => $product->id,
        //             'color_id' => $variant['color_id'],
        //             'size_id' => $variant['size_id'],
        //             'price' => $variant['price'],
        //             'stock' => $variant['stock'],
        //         ]);
        //     }
        // }
        // Variants
        if (!empty($request->variants)) {
            foreach ($request->variants as $variant) {
                if (
                    !empty($variant['color_id']) ||
                    !empty($variant['size_id']) ||
                    !empty($variant['price']) &&
                    !empty($variant['stock'])
                ) {
                    ProductVariant::create([
                        'product_id' => $product->id,
                        'color_id'   => $variant['color_id'],
                        'size_id'    => $variant['size_id'],
                        'price'      => $variant['price'],
                        'stock'      => $variant['stock'],
                    ]);
                }
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
