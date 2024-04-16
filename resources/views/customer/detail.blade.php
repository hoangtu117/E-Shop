@extends('customer.index')
@section('main')

<div class="row px-xl-5">
    <div class="col-lg-5 pb-5">
        <div id="product-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner border">
                <div class="carousel-item active">
                    <img class="w-100 h-100" src="{{asset($product->img_thumb)}}" alt="Image">
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-7 pb-5">
        <h3 class="font-weight-semi-bold">{{$product->name}}</h3>
        <div class="d-flex mb-3">
            <div class="text-primary mr-2">
                <small class="fas fa-star"></small>
                <small class="fas fa-star"></small>
                <small class="fas fa-star"></small>
                <small class="fas fa-star-half-alt"></small>
                <small class="far fa-star"></small>
            </div>
            <small class="pt-1">(50 Reviews)</small>
        </div>
        <h3 class="font-weight-semi-bold mb-4">${{$product->price}}</h3>
        <p class="mb-4">{{$product->desc}}</p>
        <div class="d-flex mb-3">
            <p class="text-dark font-weight-medium mb-0 mr-3">ID:{{$product->id}}</p>
        </div>
        <div class="d-flex mb-4">
            <p class="text-dark font-weight-medium mb-0 mr-3">
                @if($product->so_luong > 0)
                <a href="#"><span>Trạng thái</span> : Còn hàng</a>
            @else
                <li><a href="#"><span>Trạng thái</span> : Hết hàng</a></li>
            
            @endif
            </p>
        </div>
        <div class="d-flex mb-4">
            <p class="text-dark font-weight-medium mb-0 mr-3">Loại hàng: <span style="color: red">New</span></p>
        </div>
        <div class="d-flex align-items-center mb-4 pt-2">
            <div class="input-group quantity mr-3" style="width: 130px;">
                <div class="input-group-btn">
                    <button class="btn btn-primary btn-minus" >
                    <i class="fa fa-minus"></i>
                    </button>
                </div>
                <input type="text" class="form-control bg-secondary text-center" value="1">
                <div class="input-group-btn">
                    <button class="btn btn-primary btn-plus">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
            <form action="{{route('cart.store')}}" method="POST">
                @csrf
                <input type="hidden" value="{{$product->id}}" name="product_id">
                <input type="hidden" value="{{ auth()->id() }}" id="user_id"
                       name="user_id">
                <input type="hidden" name="quantity" id="quantity" value="1">
                <button class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
            </form>
            
        </div>
    </div>
</div>
<div class="text-center mb-4">
    <h2 class="section-title px-5"><span class="px-2">SẢN PHẨM LIÊN QUAN</span></h2>
</div>
<div class="row px-xl-5 pb-3">
    @foreach ($related as $item)
    <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
        <div class="card product-item border-0 mb-4">
            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                <a href="{{route('detail',$item->id)}}">
                <img class="img-fluid w-100" src="{{asset($item->img_thumb)}}" alt="">
                </a>
            </div>
            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                <h6 class="text-truncate mb-3">{{$item->name}}</h6>
                <div class="d-flex justify-content-center">
                    <h6>{{number_format($item->price).' '.'VNĐ'}}</h6>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between bg-light border">
                <a href="{{route('detail',$item->id)}}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                <form action="{{route('cart.store')}}" method="POST">
                    @csrf
                    <input type="hidden" value="{{$item->id}}" name="product_id">
                    <input type="hidden" value="{{ auth()->id() }}" id="user_id"
                           name="user_id">
                    <input type="hidden" name="quantity" id="quantity" value="1">
                    <button type="submit" class="btn btn-default add-to-cart"><i
                            class="fa fa-shopping-cart"></i>Add to cart
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach  
</div>

@endsection