<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'description' => 'nullable|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'others' => 'nullable|array',
        'others.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Slug
    $slug = Str::slug($request->name);
    $count = Product::where('slug', 'LIKE', "{$slug}%")->count();
    if ($count > 0) {
        $slug .= '-' . ($count + 1);
    }

    // Create product first
    $data = $request->except(['image', 'others']);
    $data['slug'] = $slug;
    $data['description'] = $request->description;

    $product = Product::create($data);

    // Base upload path
    $basePath = dirname(base_path()).'/assets/images/product/'.$product->id.'/uploads';

    // Ensure directory exists
    if (!file_exists($basePath)) {
        mkdir($basePath, 0755, true);
    }

    // Store main image
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move($basePath, $fileName);

        $product->update([
            'image' => 'assets/images/product/' . $product->id . '/uploads/' . $fileName,
        ]);
    }

    // Store gallery images
    if ($request->hasFile('others')) {
        foreach ($request->file('others') as $file) {
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($basePath, $fileName);

            $product->images()->create([
                'image_path' => 'assets/images/product/' . $product->id . '/uploads/' . $fileName,
                'is_primary' => 0,
            ]);
        }
    }

    return redirect()
        ->route('admin.products.index')
        ->with('success', 'Product created successfully.');
}


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'others' => 'nullable|array',
            'others.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except(['image', 'others']);
        
        // Update slug if name changes
        if ($request->name !== $product->name) {
             $slug = Str::slug($request->name);
             $count = Product::where('slug', 'LIKE', "{$slug}%")->where('id', '!=', $product->id)->count();
             if ($count > 0) {
                  $slug .= '-' . ($count + 1);
             }
             $data['slug'] = $slug;
        }

        $basePath = dirname(base_path()).'/assets/images/product/'.$product->id.'/uploads';

        // Ensure directory exists
        if (!file_exists($basePath)) {
            mkdir($basePath, 0755, true);
        }

        if ($request->hasFile('image')) {
            // Delete old primary image if it exists
            if ($product->image && file_exists(dirname(base_path()).'/'.$product->image)) {
                @unlink(dirname(base_path()).'/'.$product->image);
            }
            
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move($basePath, $fileName);
            $data['image'] = 'assets/images/product/' . $product->id . '/uploads/' . $fileName;
        }

        $product->update($data);

        // Store gallery images
        if ($request->hasFile('others')) {
            foreach ($request->file('others') as $file) {
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move($basePath, $fileName);

                $product->images()->create([
                    'image_path' => 'assets/images/product/' . $product->id . '/uploads/' . $fileName,
                    'is_primary' => 0,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove individual product image from gallery.
     */
    public function destroyImage($id)
    {
        $image = \App\Models\ProductImage::findOrFail($id);
        
        // Delete file
        if (file_exists(dirname(base_path()).'/'.$image->image_path)) {
            @unlink(dirname(base_path()).'/'.$image->image_path);
        }
        
        $image->delete();

        return response()->json(['success' => true, 'message' => 'Image removed successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
