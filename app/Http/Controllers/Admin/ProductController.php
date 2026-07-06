<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductImage;
use App\Models\ProductSpec;
use App\Models\Warranty;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['primaryImage', 'category', 'brand']);

        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $products = $query->latest()->paginate(15);
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        $brands = Brand::where('is_active', true)->get();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|unique:products,sku',
            'weight' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,inactive,out_of_stock,discontinued',
            'condition' => 'required|in:new,second,refurbished',
            'instagram_url' => 'nullable|url',
            'is_featured' => 'boolean',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'spec_keys.*' => 'nullable|string|max:255',
            'spec_values.*' => 'nullable|string|max:255',
            'warranty_types.*' => 'nullable|in:store,supplier,official',
            'warranty_durations.*' => 'nullable|integer|min:1',
            'warranty_labels.*' => 'nullable|string|max:255',
            'warranty_descriptions.*' => 'nullable|string',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'stock' => $request->stock,
            'sku' => $request->sku,
            'weight' => $request->weight,
            'status' => $request->status,
            'condition' => $request->condition,
            'instagram_url' => $request->instagram_url,
            'is_featured' => $request->boolean('is_featured'),
        ]);

        // Upload images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $i => $image) {
                $path = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'is_primary' => $i === 0,
                    'sort_order' => $i,
                ]);
            }
        }

        // Save specs
        if ($request->filled('spec_keys')) {
            foreach ($request->spec_keys as $i => $key) {
                if (!empty($key) && !empty($request->spec_values[$i] ?? '')) {
                    ProductSpec::create([
                        'product_id' => $product->id,
                        'spec_key' => $key,
                        'spec_value' => $request->spec_values[$i],
                        'sort_order' => $i,
                    ]);
                }
            }
        }

        // Save warranties
        if ($request->filled('warranty_types')) {
            foreach ($request->warranty_types as $i => $type) {
                if (!empty($type) && !empty($request->warranty_durations[$i] ?? '')) {
                    Warranty::create([
                        'product_id' => $product->id,
                        'type' => $type,
                        'duration_days' => $request->warranty_durations[$i],
                        'duration_label' => $request->warranty_labels[$i] ?? '',
                        'description' => $request->warranty_descriptions[$i] ?? null,
                    ]);
                }
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        $product->load(['images', 'specs', 'warranties']);
        $categories = Category::where('is_active', true)->get();
        $brands = Brand::where('is_active', true)->get();
        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:products,name,' . $product->id,
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|unique:products,sku,' . $product->id,
            'weight' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,inactive,out_of_stock,discontinued',
            'condition' => 'required|in:new,second,refurbished',
            'instagram_url' => 'nullable|url',
            'is_featured' => 'boolean',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'stock' => $request->stock,
            'sku' => $request->sku,
            'weight' => $request->weight,
            'status' => $request->status,
            'condition' => $request->condition,
            'instagram_url' => $request->instagram_url,
            'is_featured' => $request->boolean('is_featured'),
        ]);

        // Upload new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $i => $image) {
                $path = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'sort_order' => $product->images()->count() + $i,
                ]);
            }
        }

        // Update specs
        $product->specs()->delete();
        if ($request->filled('spec_keys')) {
            foreach ($request->spec_keys as $i => $key) {
                if (!empty($key) && !empty($request->spec_values[$i] ?? '')) {
                    ProductSpec::create([
                        'product_id' => $product->id,
                        'spec_key' => $key,
                        'spec_value' => $request->spec_values[$i],
                        'sort_order' => $i,
                    ]);
                }
            }
        }

        // Update warranties
        $product->warranties()->delete();
        if ($request->filled('warranty_types')) {
            foreach ($request->warranty_types as $i => $type) {
                if (!empty($type) && !empty($request->warranty_durations[$i] ?? '')) {
                    Warranty::create([
                        'product_id' => $product->id,
                        'type' => $type,
                        'duration_days' => $request->warranty_durations[$i],
                        'duration_label' => $request->warranty_labels[$i] ?? '',
                        'description' => $request->warranty_descriptions[$i] ?? null,
                    ]);
                }
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus!');
    }

    public function deleteImage(ProductImage $image)
    {
        \Storage::disk('public')->delete($image->image_path);
        $image->delete();
        return back()->with('success', 'Gambar berhasil dihapus.');
    }
}
