<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return view('admin.products.index', compact('products'));
    }

    public function deletedProducts()
    {
        $deletedProducts = Product::onlyTrashed()->get();
        return view('admin.products.deleted', compact('deletedProducts'));
    }
    public function restore($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();

        return redirect()->route('admin.products.deleted')->with('success', 'Product restored successfully!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validate the incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'specification' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_feature' => 'nullable|boolean',
            'variants' => 'nullable|array',
            'variants.*' => 'nullable|string|max:255',
        ]);

        // 2. Handle the secure image upload
        $imagePath = $request->file('image')->store('products', 'public');

        // 3. Create the main product
        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'specification' => $validated['specification'],
            'price' => $validated['price'],
            'image' => $imagePath,
            'is_feature' => $validated['is_feature'] ?? 0,
        ]);

        // 4. Save the variants if any were provided
        if (!empty($validated['variants'])) {
            foreach ($validated['variants'] as $variantName) {
                // Only save if the input box wasn't left completely empty
                if (!empty(trim($variantName))) {
                    $product->variants()->create([
                        'variant' => trim($variantName),
                    ]);
                }
            }
        }

        // 5. Redirect back with a success message
        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'specification' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_feature' => 'nullable|boolean',
            'variants' => 'nullable|array',
            'variants.*' => 'nullable|string|max:255',
        ]);

        // Update image only if a new one is uploaded
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $validated['image'] = $request->file('image')
                ->store('products', 'public');
        }

        // Update product details
        $product->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'specification' => $validated['specification'],
            'price' => $validated['price'],
            'image' => $validated['image'] ?? $product->image,
            'is_feature' => $request->boolean('is_feature'),
        ]);

        // Update variants
        $product->variants()->delete();

        foreach ($request->input('variants', []) as $variant) {
            if (trim($variant) !== '') {
                $product->variants()->create([
                    'variant' => trim($variant),
                ]);
            }
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Delete the associated product variants first
        $product->variants()->delete();

        // Delete the product
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }
}
