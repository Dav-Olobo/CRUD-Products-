<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('products.index', compact('products'));
    }

    // Show one product
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.view-products', compact('product'));
    }

 

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create-product');
    }
        


    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    // Simple input validations
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'description' => 'required|string|max:1000',
    ],
        [
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, webp.',
            'name.required' => 'Please enter a product name.',
            'price.required' => 'Please enter a price for the product.',
        ]);
    

   // File uploade, Remember to link storage
    // if ($request->hasFile('image')) {
    //     $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
    //     $request->file('image')->storeAs('public/products', $imageName);
    //     $validated['image'] = 'products/' . $imageName;
   

   // Create product
   $name = $request->input('name');
    $price = $request->input('price');  
    $description = $request->input('description');
    $user_id = Auth::id(); // Get authenticated user's ID

    // Image

    $imagePath = 'storage/'.$request->file('image')->store('products', 'public');

    $product = new Product();
    $product->name = $name;
    $product->price = $price;
    $product->description = $description;
    $product->image = $imagePath;
    $product->user_id = $user_id; // Associate product with the user
    $product->save();   

    return redirect()->back()
                     ->with('success', 'Product created successfully!');
}

// Display the specified resource.

// public function show(Product $product)
// {
//     $product = Product::with('user')->findOrFail($product->id);
//     return view('products.show', compact('product'));
// }

  
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // View Full record
    public function view($id)
        {
            $product = Product::with('user')->findOrFail($id);

            return view('products.view-products', compact('product'));
        }


    //Update the specified resource in storage.

public function update(Request $request, Product $product)
{
    // Validate input
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'description' => 'required|string|max:1000',
    ], [
        'image.image' => 'The file must be an image.',
        'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, webp.',
        'name.required' => 'Please enter a product name.',
        'price.required' => 'Please enter a price for the product.',
    ]);

    // Assign new values
    $product->name = $validated['name'];
    $product->price = $validated['price'];
    $product->description = $validated['description'];

    // Conditionally process the new image if one is provided
    if ($request->hasFile('image')) {
        // Delete the old image to prevent orphaned files
        if ($product->image && Storage::disk('public')->exists(str_replace('storage/', '', $product->image))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $product->image));
        }

        // Store the new image and update the product's image path
        $imagePath = 'storage/' . $request->file('image')->store('products', 'public');
        $product->image = $imagePath;
    }

    // Save updated product
    $product->save();

    return redirect()->back()->with('success', 'Product updated successfully!');
}
  
     // Remove the specified resource from storage.
    
    public function destroy(Product $product)
{
  
    if ($product->image && file_exists(public_path($product->image))) {
        unlink(public_path($product->image));
    }

    // Delete the product
    $product->delete();

    // Redirect back to the products index with a success message
    return redirect()->route('products.index')
                     ->with('success', 'Product deleted successfully!');
}

    }

