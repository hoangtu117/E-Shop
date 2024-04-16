@extends('customer.index')
@section('main')
<div class="row px-xl-5" >
    <div class="col-lg-8 table-responsive mb-5" style="margin-left: 200px">
        <h1 style="text-align: center">GIO HÀNG</h1>
        <table class="table table-bordered text-center mb-0">
            <thead class="bg-secondary text-dark">
                <tr>
                    <td></td>
                    <th>Products</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                <form action="{{ route('checkout.index') }}" method="POST">
                    @csrf
                    @if($cartItems->isEmpty())
                        <h1>No items in cart</h1>
                    @else
                        @foreach($cartItems as $item)
                            <tr>
                                <td>
                                    <input type="checkbox" name="selected_products[]" value="{{ $item->product->id }}">
                                </td>
                                <td class="cart_product">
                                    <a href=""><img style="width: 110px" src="{{ asset($item -> product -> img_thumb) }}" alt=""></a>
                                </td>
                                <td class="cart_description">
                                    <a href="">{{ $item -> product -> name }}</a>
                                </td>
                                <td class="cart_price">
                                    <p>${{$item -> product -> price}}</p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <a class="cart_quantity_up" href=""> + </a>
                                        <input class="cart_quantity_input" type="text" name="quantity"
                                               value="{{$item->quantity}}"
                                               autocomplete="off" size="2">
                                        <a class="cart_quantity_down" href=""> - </a>
                                    </div>
                                </td>
                                {{-- <td class="cart_total">
                                    <p class="cart_total_price">${{ $item-> quantity * $item -> product -> price }}</p>
                                </td> --}}
                                <td class="cart_delete">
                                    <button data-product-url=" {{route('cart.destroy', $item ->id) }}"
                                            class="cart_quantity_delete" data-product-id="{{$item->id}}"><i
                                            class="fa fa-times"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    @if($cartItems->isNotEmpty())
                        <input type="hidden" name="prices[]" value="{{ $item->product->price }}">
                        <input type="hidden" name="names[]" value="{{ $item->product->name }}">
                        <input type="hidden" name="quantities[]" value="{{ $item->quantity }}">
                    @endif
                    <td>
                        <button type="submit"  class="btn btn-block btn-primary my-3 py-3">Proceed to Pay</button>
                    </td>
                </form>
            </tbody>
        </table>
    </div>
  
</div>
@endsection