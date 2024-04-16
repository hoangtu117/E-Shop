<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Banner;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    //    lấy thông tin người dùng
        $user = auth()->user();
        // Lấy thông tin giỏ hàng của người dùng
        $cartItems = Cart::where('user_id', $user->id)
            ->with('product') // Để lấy thông tin chi tiết của sản phẩm từ bảng products
            ->get();
        $banner = Banner::where('status',1)->get();
        return view('customer.cart.index', compact('cartItems','banner'));
    }

    /**
     * Show the form for creating a new resource.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

    // Kiểm tra nếu người dùng đã đăng nhập
    if ($user) {
        // Lưu thông tin giỏ hàng vào cơ sở dữ liệu
        $cart = new Cart();
        $cart->user_id = $user->id; // Gán user_id với id của người dùng hiện tại
        $cart->product_id = $request->input('product_id');
        $cart->quantity = $request->input('quantity');
        $cart->save();
        return redirect()->route('index')->with('success','thêm vào giỏ hàng thành công');
        // Nếu muốn thêm dữ liệu bằng Eloquent, bạn cũng có thể làm như sau:
        // $user->carts()->create([
        //     'product_id' => $request->input('product_id'),
        //     'quantity' => $request->input('quantity')
        // ]);

        // Tiếp tục xử lý sau khi đã lưu thành công giỏ hàng
    } else {
        // Nếu người dùng chưa đăng nhập, bạn có thể chuyển hướng hoặc hiển thị thông báo lỗi
        return redirect()->route('login');
    }
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
        // Tìm sản phẩm trong giỏ hàng của người dùng
        $cartItem = Cart::query()->find($id);

        if ($cartItem) {
            // Xóa sản phẩm trong giỏ hàng
            $cartItem->delete();

            // Trả về JSON response cho Ajax request để xác nhận xóa thành công
            return response()->json(['message' => 'Product removed from cart successfully.'], 200);
        } else {
            // Trả về JSON response cho Ajax request để thông báo không tìm thấy sản phẩm trong giỏ hàng
            return response()->json(['message' => 'Product not found in your cart.'], 404);
        }
    }
}
