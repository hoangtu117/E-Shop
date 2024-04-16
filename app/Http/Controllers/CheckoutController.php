<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Cart;
use App\Models\Items_oder;
use App\Models\Oder;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        // Lấy danh sách sản phẩm được chọn từ form
        $selectedProducts = $request->input('selected_products', []);

        // Tạo một mảng chứa thông tin về giá, tên và số lượng của các sản phẩm được chọn
        $productsData = [];
        foreach ($selectedProducts as $productId) {
            $cartItem = Cart::where('user_id', auth()->id())
                ->with('product')
                ->where('product_id', $productId)
                ->first();
                // dd($cartItem);
            if ($cartItem) {
                $productData = [
                    'product_id' => $productId,
                    'price' => $cartItem->product->price,
                    'name' => $cartItem->product->name,
                    'img_thumb' => $cartItem->product->img_thumb,
                    'quantity' => $cartItem->quantity,
                ];
                $productsData[] = $productData;
            }
            
        }
        $banner = Banner::where('status',1)->get();
        // Truyền danh sách sản phẩm được chọn và thông tin giá, tên và số lượng vào view Checkout
        return view('customer.checkout.index', compact('productsData','banner'));
    }

    public function placeOrder(Request $request){
        //thêm user_id vào bảng order
        $user_id = auth()->id();
        $order = new Oder();
        $order->user_id = $user_id;
        $order->voucher_id = $request['voucher_id'];
        $order->save();
        if ($request['voucher_id'] != null) {
            $voucher = Voucher::query()->where('id',$request['voucher_id'])->first();
            $newValue = $voucher->usage_limit - 1;
            Voucher::where('id', $request['voucher_id'])->update(['usage_limit' => $newValue]);
        }
        //thêm product_id, quantity, price vào bảng order_item
        $jsonString  = $request->input('productsData');
        $trimmedJsonString = trim($jsonString);
        $selectedProducts = json_decode($trimmedJsonString, true);
        $orderItem = new Items_oder();
        foreach ($selectedProducts as $product) {
            $cartItem = Cart::where('user_id', auth()->id())
                ->with('product')
                ->where('product_id', $product['product_id'])
                ->first();
//            dd($cartItem);
            if ($cartItem) {
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $product['product_id'];
                $orderItem->quantity = $cartItem->quantity;
                $orderItem->price = $cartItem->product->price;
                $orderItem->save();
                Cart::where('user_id', $user_id)->where('product_id',$orderItem->product_id)->delete();
            }
        }
//        $userEmail = auth()->user()->email;
//         Mail::to($userEmail)->send(new OrderPlaced($orderItem));
        //xóa các sản phẩm đã order khỏi giỏ hàng
        return redirect()->route('checkout.success');
    }
    public function success() {
        $bannerItem = Banner::query()->where('status', 1)->first();
        $banner = Banner::where('status',1)->get();
        return view('customer.checkout.success',compact('banner'));
    }
    public function redeemCode(Request $request) {
        $code = $request['code'];
        $voucher = Voucher::query()->where('code', $code)->first();
        if (!$voucher) {
            return response()->json(['status' => 'error', 'message' => 'Voucher does not exist.'], 200);
        }

        if ($voucher->expiration_date && Carbon::now()->gt($voucher->expiration_date)) {
            return response()->json(['status' => 'error', 'message' => 'Voucher has expired.'], 200);
        }
        if ($voucher->usage_limit == 0) {
            return response()->json(['status' => 'error', 'message' => 'Voucher has expired.'], 200);
        }
        return response()->json(['status' => 'success','voucherValue' => $voucher->value, 'voucherID' => $voucher->id], 200);
    }
}
