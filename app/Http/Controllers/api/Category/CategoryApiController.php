<?php

namespace App\Http\Controllers\api\Category;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryApiController extends Controller
{
    public function index()
    {

        // dd('hit');
        $categories = Category::with(['mainCategory'])->get(); // Load main category with each brand

        // Loop through brands and extract main category
        $categoriesData = $categories->map(function ($cat) {
            return [
                'id' => $cat->id,
                'name' => $cat->name,
                'main_category_name' => $cat->mainCategory->name ?? null, // Get main category name if exists
                'main_category_id' => $cat->main_category_id,
                'image' => $cat->image,
                // 'category_name' => $brand->category->name,
                // 'category_id' => $brand->category->id,
            ];
        });

        return response()->json([
            'success' => true,
            'message' => "All  Categories",
            'data' => $categoriesData,
        ]);
    }

    public function getCategory($id)
    {
        // Fetch the category with its main category and products
        $category = Category::with(['mainCategory', 'products'])->find($id);

        // Check if the category is found
        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found',
                'data' => []
            ]);
        }

        // Prepare category data
        $categoryData = [
            'id' => $category->id,
            'name' => $category->name,
            'main_category_name' => $category->mainCategory->name ?? null,
            'main_category_id' => $category->main_category_id,
            'image' => $category->image,
            'products' => $category->products->take(10) // Get first 10 products, no need for random
                ->map(function ($product) {
                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        'category_id' => $product->category_id,
                        'brand_id' => $product->brand_id,
                        'category_name' => $product->category->name ?? null,
                        'image' => $product->image,
                        // Include other product details as needed
                    ];
                })
        ];

        // Return JSON response
        return response()->json([
            'success' => true,
            'message' => 'Category and products fetched successfully',
            'data' => $categoryData
        ]);
    }
}
