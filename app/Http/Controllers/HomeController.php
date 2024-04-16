<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
class HomeController extends Controller
{
    public function index(){
        $products = Product::where('status',1)->limit(12)->get();
        // $products = Product::orderBy('created_at', 'desc')->take(8)->get();//sp mới nhất
        $banner = Banner::where('status',1)->get();
        return view('customer.home',compact('products','banner'));
    }
    public function detail($id){
        $product = Product::where('id',$id)->first();
        $banner = Banner::where('status',1)->get();
        $related = Product::where('category_id',$product->category_id)->where('id','!=',$product->id)->limit(4)->get();
        return view('customer.detail',compact('product','related','banner'));
    }
    public function category(Category $cat){
        // $product = Product::where('category_id',$cat->id)->get();
        // dd($cat->product);
        $banner = Banner::where('status',1)->get();
        return view('customer.category.show',compact('cat','banner'));
    }
    
}
