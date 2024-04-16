
@extends('customer.index')
@section('main')
<div class="text-center mb-4">
    <h2 class="section-title px-5"><span class="px-2">{{$cat->name}}</span></h2>
</div>
<div class="row px-xl-5 pb-3">
    @foreach ($cat->product as $value)
    <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
        <div class="card product-item border-0 mb-4">
            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                <a href="{{route('detail',$value->id)}}">
                <img class="img-fluid w-100" src="{{asset($value->img_thumb)}}" alt="">
                </a>
            </div>
            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                <h6 class="text-truncate mb-3">{{$value->name}}</h6>
                <div class="d-flex justify-content-center">
                    <h6>${{$value->price}}</h6>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between bg-light border">
                <a href="{{route('detail',$value->id)}}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                <form action="{{route('cart.store')}}" method="POST">
                    @csrf
                    <input type="hidden" value="{{$value->id}}" name="product_id">
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

