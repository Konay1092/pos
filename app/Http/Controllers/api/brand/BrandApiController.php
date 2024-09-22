<?php

namespace App\Http\Controllers\api\brand;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandApiController extends Controller
{
    public function index()
    {

        // dd('hit');
        $brands = Brand::with(['mainCategory'])->get(); // Load main category with each brand

        // Loop through brands and extract main category
        $brandsData = $brands->map(function ($brand) {
            return [
                'id' => $brand->id,
                'name' => $brand->name,
                'main_category_name' => $brand->mainCategory->name ?? null, // Get main category name if exists
                'main_category_id' => $brand->main_category_id,
                'image' => $brand->image,
                // 'category_name' => $brand->category->name,
                // 'category_id' => $brand->category->id,
            ];
        });

        return response()->json([
            'success' => true,
            'message' => "All Brands with Categories",
            'data' => $brandsData,
        ]);
    }
    // public function getBrand($id)
    // {

    //     $brand = Brand::with(['mainCategory'])->find($id);

    //     // Check if the brand is found
    //     if (!$brand) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Brand not found',
    //             'data' => []
    //         ]);
    //     }

    //     // Fetch products associated with this brand
    //     $products = Product::where('brand_id', $id)->inRandomOrder()->limit(10)->get();

    //     // Prepare brand data
    //     $brandData = [
    //         'id' => $brand->id,
    //         'name' => $brand->name,
    //         'main_category_name' => $brand->mainCategory->name ?? null,
    //         'main_category_id' => $brand->main_category_id,
    //         'image' => $brand->image,
    //         // 'category_name' => $brand->category->name ?? null,
    //         // 'category_id' => $brand->category->id ?? null,
    //         'products' => $products ?? null
    //     ];

    //     // Prepare response data
    //     // $responseData = [
    //     //     'brand' => $brandData,

    //     // ];

    //     // Return JSON response
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Brand and products fetched successfully',
    //         'data' => $brandData
    //     ]);
    // }
    public function getBrand($id)
    {
        // Fetch the brand with its main category and products, including their categories
        $brand = Brand::with(['mainCategory', 'products.category'])->find($id);

        // Check if the brand is found
        if (!$brand) {
            return response()->json([
                'success' => false,
                'message' => 'Brand not found',
                'data' => []
            ]);
        }

        // Prepare brand data
        $brandData = [
            'id' => $brand->id,
            'name' => $brand->name,
            'main_category_name' => $brand->mainCategory->name ?? null,
            'main_category_id' => $brand->main_category_id,
            'image' => $brand->image,
            // 'products' => $brand->products->generate()->take(10)->map(function ($product) {
            'products' => $brand->products->random(10)
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
            'message' => 'Brand and products fetched successfully',
            'data' => $brandData
        ]);
    }
}
