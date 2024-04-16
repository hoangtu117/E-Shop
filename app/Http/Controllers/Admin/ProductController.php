<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditProductRequest;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::query()->with('category')->latest('id')->paginate(4);
        // dd($data);
        return view('admin.product.index',compact('data'))->with('i',(request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::query()->pluck('name','id')->all();

        return view('admin.product.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        // xu lí ảnh
        $data = $request->except('img_thumb');
        if($request->hasFile('img_thumb')){
            $pathFile= Storage::putFile('products',$request->file('img_thumb'));

            $data['img_thumb']='storage/'.$pathFile;
        }
        // dd($data);

        Product::query()->create($data);

        return redirect()->route('product.index')->with('success','Thêm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::query()->pluck('name','id')->all();

        return view('admin.product.edit',compact('categories','product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditProductRequest $request, Product $product)
    {
        $data = $request->except('img_thumb');
        if($request->hasFile('img_thumb')){
            $pathFile= Storage::putFile('products',$request->file('img_thumb'));

            $data['img_thumb']='storage/'.$pathFile;
        }
        // dd($data);
        // trước khi upload
        $currentImgThumb=$product->img_thumb;
        $product->update($data);
        return redirect()->route('product.index')->with('success','Cập nhật thành công');
        // xóa ảnh cũ khi upload
        if($request->hasFile('img_thumb') 
        && $currentImgThumb
        && file_exists(public_path($currentImgThumb))
        
        ){
            unlink(public_path($currentImgThumb));
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product ->delete();
        
        if( $product->img_thumb
        && file_exists(public_path($product->img_thumb))
        
        ){
            unlink(public_path($product->img_thumb));
        }
        return redirect()->route('product.index')->with('success','xóa thành công');
    }
}
