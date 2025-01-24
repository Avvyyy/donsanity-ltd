<?php
namespace App\Http\Controllers\User;
// User Controller

use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    /**
     * Display a list of all products in the database with a pagination of 20.
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
     * Display a specific product from the database based on the slug.
     */
    public function show(Products $products)
    {
        return response()->json($products);
    }

    /**
     * Implement search functionality for products in the database.
     */

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

}
