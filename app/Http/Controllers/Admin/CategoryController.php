<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\EditCategoryRequest;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories= Category::query()->latest('id')->paginate(4);
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories= Category::all();
        return view('admin.category.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        try{
            Category::create($request->all());
            return redirect()->route('category.index')->with('success','thêm mới thành công');
        }
        catch(\Throwable $th){
            return redirect()->back()->with('error','thêm mới thất bại');
        }   
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
    public function edit(Category $category)
    {
        $categories= Category::all();
        return view('admin.category.edit',compact('category','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditCategoryRequest $request, Category $category)
    {
        try{
            $category->update($request->all());
            // dd($category);
            return redirect()->route('category.index')->with('success','Cập nhật thành công');
        }
        catch(\Throwable $th){
            return redirect()->back()->with('error',' thất bại');
        }   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try{
            $category->delete();
            return redirect()->route('category.index')->with('success','Xóa  thành công');
        }
        catch(\Throwable $th){
            return redirect()->back()->with('error',' thất bại');
        }   
    }
}
