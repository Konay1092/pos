<?php

namespace App\Http\Controllers\api\main_category;

use App\Models\Product;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainCategoryApiController extends Controller
{
    public function index()
    {
        $mainCategories = MainCategory::with(['brands', 'categories'])->get();


        $mainCategoriesData = $mainCategories->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
                'created_at' => $category->created_at,
                'updated_at' => $category->updated_at,
                'categories' => $category->categories->isNotEmpty() ? $category->categories->map(function ($cat) {
                    return [
                        'id' => $cat->id,
                        'name' => $cat->name,
                        'main_category_id' => $cat->main_category_id,
                        // 'image' => $brand->image,
                        // 'created_at' => $brand->created_at,
                        // 'updated_at' => $brand->updated_at,
                    ];
                }) : null,
                'brands' => $category->brands->isNotEmpty() ? $category->brands->map(function ($brand) {
                    return [
                        'id' => $brand->id,
                        'main_category_id' => $brand->main_category_id,
                        'name' => $brand->name,
                        // 'image' => $brand->image,
                        // 'created_at' => $brand->created_at,
                        // 'updated_at' => $brand->updated_at,
                    ];
                }) : null, // If no brands, return null
            ];
        });

        return response()->json([
            'success' => true,
            'message' => "All Main Categories ",
            'data' => $mainCategoriesData,
        ]);
    }
    public function home()
    {
        $mainCategories = MainCategory::with(['brands', 'categories'])->get();


        $mainCategoriesData = $mainCategories->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
                'created_at' => $category->created_at,
                'updated_at' => $category->updated_at,
                'categories' => $category->categories->isNotEmpty() ? $category->categories->map(function ($cat) {
                    return [
                        'id' => $cat->id,
                        'name' => $cat->name,
                        'main_category_id' => $cat->main_category_id,
                        // 'image' => $brand->image,
                        // 'created_at' => $brand->created_at,
                        // 'updated_at' => $brand->updated_at,
                    ];
                }) : null,
                'brands' => $category->brands->isNotEmpty() ? $category->brands->map(function ($brand) {
                    return [
                        'id' => $brand->id,
                        'main_category_id' => $brand->main_category_id,
                        'name' => $brand->name,
                        // 'image' => $brand->image,
                        // 'created_at' => $brand->created_at,
                        // 'updated_at' => $brand->updated_at,
                    ];
                }) : null, // If no brands, return null
            ];
        });

        // dd($products1);

        $products = Product::select('id', 'name', 'brand_id', 'category_id', 'description', 'short_description', 'original_price', 'discount_price')
            // ->with(['category:id,name', 'brand:id,name']) // Eager load categories and brands
            ->inRandomOrder()
            ->limit(30)
            ->get();
        // Split the products into two groups of 10
        $products1 = $products->slice(0, 10);
        $products2 = $products->slice(10, 10);
        $products3 = $products->slice(20, 30);




        // Prepare the response data
        $productData = [
            'total' => $products->count(),
            'beauty_offer' => $products1->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'category_id' => $product->category_id,
                    'brand_id' => $product->brand_id,
                    'category_name' => $product->category->name ?? null,
                    'short_description' => $product->short_description,
                    'description' => $product->description,
                    'original_price' => $product->original_price ?? 0,
                    'discount_price' => $product->discount_price  ?? 0,

                    'image' => $product->images ?? null,
                ];
            }),
            'Choose_for_you' => $products2->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'category_id' => $product->category_id,
                    'brand_id' => $product->brand_id,
                    'category_name' => $product->category->name ?? null,

                    'short_description' => $product->short_description,
                    'description' => $product->description,
                    'original_price' => $product->original_price ?? 0,
                    'discount_price' => $product->discount_price  ?? 0,
                    'image' => $product->image,
                ];
            }),
            'New_Arrivals' => $products3->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'category_id' => $product->category_id,
                    'brand_id' => $product->brand_id,
                    'category_name' => $product->category->name ?? null,

                    'short_description' => $product->short_description,
                    'description' => $product->description,
                    'original_price' => $product->original_price ?? 0,
                    'discount_price' => $product->discount_price  ?? 0,
                    'image' => $product->image,
                ];
            }),

        ];

        // return response()->json($responseData);
        $data = [
            'maincategroies' => $mainCategories,
            'products' => $productData
        ];

        return response()->json([
            'success' => true,
            'message' => "Home Screen ",
            // 'data' => $mainCategoriesData,
            'data' => $data,
        ]);
    }
}
