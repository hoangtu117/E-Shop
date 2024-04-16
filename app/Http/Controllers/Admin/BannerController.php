<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data= Banner::query()->latest('id')->paginate(5);
        return view('admin.banner.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data= Banner::all();
        return view('admin.banner.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBannerRequest $request)
    {
        // xu lí ảnh
        $data = $request->except('img_thumb');
        if($request->hasFile('img_thumb')){
            $pathFile= Storage::putFile('banners',$request->file('img_thumb'));

            $data['img_thumb']='storage/'.$pathFile;
        }
        // dd($data);

        Banner::query()->create($data);

        return redirect()->route('banner.index')->with('success','Thêm thành công');
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
    public function edit(Banner $banner)
    {
        $data= Banner::all();
        return view('admin.banner.edit',compact('data','banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBannerRequest $request, Banner $banner)
    {
        $data = $request->except('img_thumb');
        if($request->hasFile('img_thumb')){
            $pathFile= Storage::putFile('products',$request->file('img_thumb'));

            $data['img_thumb']='storage/'.$pathFile;
        }
        // dd($data);
        // trước khi upload
        $currentImgThumb=$banner->img_thumb;
        $banner->update($data);
        return redirect()->route('banner.index')->with('success','Cập nhật thành công');
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
    public function destroy(Banner $banner)
    {
        $banner ->delete();
        
        if( $banner->img_thumb
        && file_exists(public_path($banner->img_thumb))
        
        ){
            unlink(public_path($banner->img_thumb));
        }
        return redirect()->route('banner.index')->with('success','xóa thành công');
    }
}
