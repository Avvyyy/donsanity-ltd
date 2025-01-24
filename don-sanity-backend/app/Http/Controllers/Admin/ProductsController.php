<?php
namespace App\Http\Controllers\Admin;
// Admin Controller

use App\Models\Products;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductsRequest;
use App\Http\Requests\UpdateProductsRequest;

class ProductsController extends Controller
{
    /**
     * Display all the products in the Products database with a pagination of 20.
     */
    public function index()
    {
        $products = Products::paginate(20);

        // Getting the current page number
        $currentPage = $products->currentPage();
        // Getting the next page url
        $nextPageUrl = $products->nextPageUrl();
        // Getting the previous page url
        $previousPageUrl = $products->previousPageUrl();
        // Getting the product data from the url
        $data = $products->items();

        return response()->json([
            'data' => $data,
            'next_page_url' => $nextPageUrl,
            'previous_page_url' => $previousPageUrl,
            'current_page' => $currentPage
        ]);
    }

    /**
     * Push products to the database.
     */
    public function store(StoreProductsRequest $request)
    {
        $data = $request->validated();
        $response = [];
    
        // Check if the data is a multi-dimensional array (multiple products)
        $isMultipleProducts = isset($data[0]) && is_array($data[0]);
        
        // Convert single product to array format for consistent processing
        $productsData = $isMultipleProducts ? $data : [$data];
        
        foreach ($productsData as $productData) {
            // Handle colours
            $colours = isset($productData['colours']) ? $productData['colours'] : [];
            $productData['colours'] = json_encode($colours);
            
            // Generate slug from name
            $productData['slug'] = Str::slug($productData['name']);
            
            // Create the product
            $product = Products::create($productData);
            $response[] = $product;
        }
    
        // Return appropriate response based on whether it was single or multiple products
        return response()->json([
            'message' => count($response) . ' product(s) created successfully',
            'data' => $isMultipleProducts ? $response : $response[0]
        ], 201);
    }
    

    /**
     * Display a particular product based on its slug.
     */
    public function show(Products $product)
    {
        return response()->json($product);
    }

    /** Implement search functionality*/
    public function search(Request $request)
    {
        $query = Products::query();

        if (request()->has('name')) {
            $query->where('name', 'like', '%' . request('name') . '%');
        }

        if (request()->has('description')) {
            $query->where('description', 'like', '%' . request('description') . '%');
        }

        if (request()->has('price')) {
            $query->where('price', 'like', '%' . request('price') . '%');
        }

        if (request()->has('colour')) {
            $query->where('colours', 'like', '%' . request('colour') . '%');
        }

        $query->orderBy('name', 'asc');
        $query->paginate(20);
        $products = $query->get();

        return response()->json($products);
    }


    /**
     * Update a particular product in the database
     */
    public function update(UpdateProductsRequest $request, Products $product)
    {
        $validated = $request->validated();

        // Generate new slug and update name
        if ($request->has('name')) {
            $product->name = $validated['name'];
            $product->slug = Str::slug($validated['name']);
        }

        // Update other fields
        foreach(['decription', 'price', 'image', 'colours'] as $field) {
            if ($request->has($field)) {
                if ($field === 'colours') {
                    $product->$field = json_encode($validated[$field]);
                }
                else {
                    $product->$field = $validated[$field];
                }
            }
        }
        
        $product->save();

        return response()->json($product);
        

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $product)
    {
        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully'
        ]);

        // Implement deletion of multiple products later
    }
}
