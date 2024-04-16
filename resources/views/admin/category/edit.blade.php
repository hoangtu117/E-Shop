@extends('admin.admin.admin');
@section('admin_content');
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật danh mục sản phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{route('category.update',$category)}}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" value="{{ $category->name }}" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Chọn trạng thái</label>
                            <div class="radio">
                              <label>
                                <input type="radio" name="status" id="input" value="1"  {{$category->status ? 'checked' : ""}}>
                                Hiện
                              </label>
                              <label>
                                <input type="radio" name="status" id="input" value="0"{{$category->status ? 'checked' : ""}}>
                                Ẩn
                              </label>
                            </div>
                          </div>
                        <button type="submit" name="" class="btn btn-info">Cập nhật Danh mục</button>
                    </form>
                </div>
                </div>
            </section>

    </div>
@endsection
