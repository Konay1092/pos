<?php

namespace App\Http\Controllers\admin\product;


use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\ProductImage;
use App\Models\ProductVideo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'subcategory', 'brand', 'images', 'videos')->get();

        return view('product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $brands = Brand::all();

        return view('product.createproduct', compact('categories', 'subcategories', 'brands'));
    }
    public function fetchSubcategories(Request $request)
    {

        $categoryId = $request->category_id;
        // dd($categoryId);

        if (is_null($categoryId) || !is_numeric($categoryId)) {
            return response()->json(['error' => 'Invalid category ID'], 400);
        }
        if (is_null($categoryId)) {
            return response()->json(['error' => 'Category ID is required'], 400);
        }

        $subcategories = Subcategory::where('category_id', $categoryId)->get();

        if ($subcategories->isEmpty()) {
            return response()->json(['message' => 'No subcategories found for the selected category'], 404);
        }

        return response()->json(['subcategories' => $subcategories]);


        // return response()->json(['error' => 'Invalid request'], 400);
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'category_id' => 'required',
    //         'subcategory_id' => 'required',
    //         'brand_id' => 'required',
    //         'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'videos.*' => 'nullable|mimes:mp4,avi,mkv|max:10000',
    //     ]);

    //     $product = Product::create([
    //         'name' => $request->name,
    //         'description' => $request->description,
    //         'category_id' => $request->category_id,
    //         'subcategory_id' => $request->subcategory_id,
    //         'brand_id' => $request->brand_id,
    //     ]);

    //     if ($request->hasFile('images')) {
    //         foreach ($request->file('images') as $image) {
    //             $path = $image->store('product_images', 'public');
    //             ProductImage::create([
    //                 'product_id' => $product->id,
    //                 'path' => $path,
    //             ]);
    //         }
    //     }

    //     if ($request->hasFile('videos')) {
    //         foreach ($request->file('videos') as $video) {
    //             $path = $video->store('product_videos', 'public');
    //             ProductVideo::create([
    //                 'product_id' => $product->id,
    //                 'path' => $path,
    //             ]);
    //         }
    //     }

    //     return redirect()->route('products.index')->with('success', 'Product created successfully.');
    // }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'brand_id' => 'required',
            'sh_description' => 'required',
            'pd_description' => 'required',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'videos.*' => 'nullable|mimes:mp4|max:20000',
        ]);
        // dd($request->all());

        // Create the product
        $product = Product::create([
            'name' => $request->name,
            'short_description' => $request->sh_description,
            'description' => $request->pd_description,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'brand_id' => $request->brand_id,
        ]);

        // Handle images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $this->processImage($image);
                // dd($imagePath);
                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $imagePath,
                ]);
            }
        }


        // Handle videos
        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $video) {
                $videoPath = $this->storeVideo($video);
                ProductVideo::create([
                    'product_id' => $product->id,
                    'path' => $videoPath,
                ]);
            }
        }

        // return redirect()->route('products.index')->with('success', 'Product created successfully.');
        return redirect()->route('products.index');
    }

    private function processImage($image)
    {

        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $directory = public_path('vendors/images/products');
        // $path = $directory . '/' . $name_gen;

        // Ensure the directory exists
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        // Resize and save the image
        Image::make($image)->resize(626, 626)->save('vendors/images/products/' . $name_gen);

        // Prepare the relative path
        $relativePath = 'vendors/images/products/' . $name_gen;


        return $relativePath;
    }

    private function storeVideo($video)
    {
        // Generate a unique name for the video
        $videoName = hexdec(uniqid()) . '.' . $video->getClientOriginalExtension();

        // Define the directory path where videos will be stored
        $directory = public_path('vendors/videos/products');

        // Ensure the directory exists
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        // Define the path to store the video
        $videoPath = $directory . '/' . $videoName;

        // Move the uploaded video to the defined directory
        $video->move($directory, $videoName);

        // Prepare the relative path for the video
        $relativePath = 'vendors/videos/products/' . $videoName;

        return $relativePath;
    }

    public function show($id)
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $brands = Brand::all();
        $product = Product::findOrFail($id);

        return view('product.showproduct', compact('product', 'categories', 'subcategories', 'brands'));
    }


    public function edit($id)
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $brands = Brand::all();
        $product = Product::findOrFail($id);
        // $categories = Category::orderBy('id', 'ASC')->get();
        // $categories = Category::all();
        return view('product.editproduct', compact('product', 'categories', 'subcategories', 'brands'));
    }


    public function update(Request $request, Product $product)
    {
        // Validate the request
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'brand_id' => 'required',
            'sh_description' => 'required',
            'pd_description' => 'required',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'videos.*' => 'nullable|mimes:mp4|max:20000',
        ]);
        $cleanedText = strip_tags($request->sh_description);
        $desc = strip_tags($request->pd_description);
        $desc = html_entity_decode($desc);

        // Optionally, decode HTML entities
        $cleanedText = html_entity_decode($cleanedText);


        // Update the product details
        $product->update([
            'name' => $request->name,
            'short_description' => $cleanedText,
            'description' => $desc,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'brand_id' => $request->brand_id,
        ]);

        // Handle images
        if ($request->hasFile('images')) {
            // Delete old images
            foreach ($product->images as $image) {
                if (file_exists(public_path($image->path))) {
                    unlink(public_path($image->path));
                }
                $image->delete();
            }

            // Save new images
            foreach ($request->file('images') as $image) {
                $imagePath = $this->processImage($image);
                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $imagePath,
                ]);
            }
        }

        // Handle videos
        if ($request->hasFile('videos')) {
            // Delete old videos
            foreach ($product->videos as $video) {
                if (file_exists(public_path($video->path))) {
                    unlink(public_path($video->path));
                }
                $video->delete();
            }

            // Save new videos
            foreach ($request->file('videos') as $video) {
                $videoPath = $this->storeVideo($video);
                ProductVideo::create([
                    'product_id' => $product->id,
                    'path' => $videoPath,
                ]);
            }
        }
        $notification = array(
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('products.index')->with($notification);
    }


    public function destroy(Product $product)
    {
        // Delete associated images
        foreach ($product->images as $image) {
            // Check if the file exists and delete it
            if (file_exists(public_path($image->path))) {
                unlink(public_path($image->path));
            }
            // Delete the image record from the database
            $image->delete();
        }

        // Delete associated videos
        foreach ($product->videos as $video) {
            // Check if the file exists and delete it
            if (file_exists(public_path($video->path))) {
                unlink(public_path($video->path));
            }
            // Delete the video record from the database
            $video->delete();
        }

        // Delete the product
        $product->delete();

        // Prepare notification
        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );

        // Redirect back to products index with notification
        return redirect()->route('products.index')->with($notification);
    }
}
