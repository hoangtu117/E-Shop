<?php

namespace App\Http\Controllers;

use App\Models\Items_oder;
use App\Models\Oder;
use Illuminate\Http\Request;

class ItemsOder extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        {
            // Lấy thông tin đơn hàng từ form
            $order = Oder::findOrFail($request->input('order_id'));

            // Lấy danh sách sản phẩm từ form (nếu có)
            $productIds = $request->input('product_id', []);
            $prices = $request->input('price', []);
            $quantities = $request->input('quantity', []);

            // Lưu thông tin sản phẩm vào bảng OrderItems
            foreach ($productIds as $index => $productId) {
                $orderItem = new Items_oder();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $productId;
                $orderItem->price = $prices[$index];
                $orderItem->quantity = $quantities[$index];
                // Thêm các trường thông tin khác cần thiết từ sản phẩm vào đây
                $orderItem->save();
            }

            // Redirect hoặc trả về view thông báo đặt hàng thành công
            return redirect()->route('admin.oder.index')->with('success', 'Đặt hàng thành công!');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
