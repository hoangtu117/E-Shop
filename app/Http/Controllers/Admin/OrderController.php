<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Oder;
use App\Models\Items_oder;
use App\Models\User;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Oder::query()->with('user')->get();
        return view('admin.oder.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('admin.oder.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Items_oder::query()->with('order')->with('product')->where('order_id',$id)->get();
        $user = User::query()->where('id', $data[0]->order->user_id)->first();
        $voucher = Oder::query()->where('id', $id)->with('voucher')->first();
        $voucherValue = null;

        // Kiểm tra xem đơn hàng có sử dụng voucher không
        if ($voucher && $voucher->voucher) {
            $voucherValue = $voucher->voucher->value;
        }

        return view('admin.oder.detail', compact('data', 'voucherValue'));
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
        
    }
}
