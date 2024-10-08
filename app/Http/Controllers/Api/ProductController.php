<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ProductDetailsResource;
use App\Http\Resources\Admin\ProductResource;
use App\Models\Admin\Product;
use App\Trait\ResponseTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ResponseTrait;
    public function get()
    {
        $products = Product::with('category')->get();
        return  $this->res(true ,'All Products' , 200 ,ProductResource::collection($products));
    }
    public function get_product_details(Request $request) {

        $request->validate([
            'slug'=>'required|string'
        ]);
        $productdetails = Product::whereHas('translations', function ($query) use($request) {
            $query->where('locale', '=', app()->getLocale())->where('slug' , $request->slug);
        })->first();

        if(optional($productdetails)->exists()){
            return  $this->res(true ,'product Details' , 200 , new ProductDetailsResource($productdetails));
        }

        return  $this->res(false ,'product details not found. Maybe there is no data with this slug or no data in this language.' , 404);
    }

    public function get_product_category(Request $request){
  

        $request->validate([
            'slug'=>'required|string'
        ]);
        $category = Category::whereHas('translations', function ($query) use($request) {
            $query->where('locale', '=', app()->getLocale())->where('slug', $request->slug);
        })->first();
        $products = Product::with('category')->where('category_id' , $category->id)->get();
     
        return  $this->res(true ,'All Products' , 200 ,ProductResource::collection($products));

    }
}
