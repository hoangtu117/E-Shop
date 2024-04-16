<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVoucherRequest;
use App\Http\Requests\UpdateVoucherRequest;
use Illuminate\Http\Request;
use App\Models\Voucher;
class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Voucher::query()->latest('id')->paginate(5);
        return view('admin.voucher.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.voucher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVoucherRequest $request)
    {
        $model = new Voucher();
        $model -> fill($request->all());
        $model->save();

        return redirect()->route('voucher.index')->with('success', 'Thêm voucher thành công!');
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
    public function edit(string $id)
    {
        $data = Voucher::query()->findOrFail($id);
        return view('admin.voucher.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVoucherRequest $request, string $id)
    {
        $data = $request->validated();

        // Tìm voucher trong cơ sở dữ liệu theo id
        $voucher = Voucher::findOrFail($id);

        // Cập nhật thông tin voucher
        $voucher->update($data);

        // Chuyển hướng về trang hiển thị danh sách voucher hoặc trang chi tiết voucher đã được cập nhật
        return redirect()->route('voucher.index')->with('success', 'Cập nhật voucher thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voucher $voucher)
    {
        $voucher->delete();
        return back()->with('success', 'xóa voucher thành công!');
    }
}
