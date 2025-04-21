<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductMatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = new Product();
        return view('admin.product.edit', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'external_url' => 'nullable|url|max:2048'
        ]);

        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
            $filename = 'product_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/products'), $filename);
            $validated['featured_image'] = 'uploads/products/' . $filename;
        }

        $product = Product::create($validated);

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $index => $image) {
                $filename = 'gallery_' . time() . '_' . uniqid() . '_' . $index . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/products/gallery'), $filename);
                $product->images()->create([
                    'image_path' => 'uploads/products/gallery/' . $filename,
                    'sort_order' => $index
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Ürün başarıyla oluşturuldu.');
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
    public function edit(Product $product)
    {
        return view('admin.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'external_url' => 'nullable|url|max:2048',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'nullable|integer|exists:product_images,id'
        ]);

        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($product->featured_image && file_exists(public_path($product->featured_image))) {
                unlink(public_path($product->featured_image));
            }

            $file = $request->file('featured_image');
            $filename = 'product_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/products'), $filename);
            $validated['featured_image'] = 'uploads/products/' . $filename;
        }

        $product->update($validated);

        // Handle image deletions
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $image = $product->images()->find($imageId);

                if ($image) {
                    // Delete the physical file
                    if (file_exists(public_path($image->image_path))) {
                        unlink(public_path($image->image_path));
                    }

                    // Delete the database record
                    $image->delete();
                }
            }
        }

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $index => $image) {
                $filename = 'gallery_' . time() . '_' . uniqid() . '_' . $index . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/products/gallery'), $filename);
                $product->images()->create([
                    'image_path' => 'uploads/products/gallery/' . $filename,
                    'sort_order' => $product->images()->count() + $index
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Ürün başarıyla güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Delete featured image
        if ($product->featured_image && file_exists(public_path($product->featured_image))) {
            unlink(public_path($product->featured_image));
        }

        // Delete gallery images
        foreach ($product->images as $image) {
            if (file_exists(public_path($image->image_path))) {
                unlink(public_path($image->image_path));
            }
        }

        // Delete related product matches
        ProductMatch::where('product_id', $product->id)->delete();

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Ürün başarıyla silindi.');
    }
}
