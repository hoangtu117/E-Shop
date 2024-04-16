@extends('customer.index')
@section('main')
    <div class="jumbotron text-center">
        <h1 class="display-3">Thank You!</h1>
        <p class="lead">
            <a class="btn btn-primary btn-sm" href="{{route('index')}}" role="button">Quay trở lại trang chủ</a>
        </p>
    </div>
@endsection
