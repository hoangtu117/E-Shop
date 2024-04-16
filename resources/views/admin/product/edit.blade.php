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
                    Cập nhật sản phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{route('product.update',$product)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" value="{{$product->name}}" data-validation="length" data-validation-length="min10" data-validation-error-msg="Làm ơn điền ít nhất 10 ký tự" name="name" class="form-control " id="slug" placeholder="Tên danh mục" onkeyup="ChangeToSlug();">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" value="{{$product->price}}" data-validation="number" data-validation-error-msg="Làm ơn điền số tiền" name="price" class="form-control" id="" placeholder="Tên danh mục">
                        </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                            <input type="file" name="img_thumb" class="form-control" id="img_thumb">
                            <img src="{{asset($product->img_thumb)}}" alt="" width="100px" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số lượng</label>
                            <input type="number"  value="{{$product->so_luong}}" name="so_luong" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                            <textarea style="resize: none"  rows="8" class="form-control" name="desc" id="ckeditor1" placeholder="Mô tả sản phẩm">
                                {{$product->desc}}
                            </textarea>
                        </div>
                        
                         <div class="form-group">
                            <label for="category_id">Danh mục sản phẩm</label>
                              <select name="category_id" id="category_id" class="form-control input-sm m-bot15">
                                @foreach ($categories as $id=> $name )
                                <option @if($product->category_id == $id) selectetd @endif 
                                    value="{{$id}}">{{$name}}</option>
                        @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Chọn trạng thái</label>
                            <div class="radio">
                              <label>
                                <input type="radio" name="status" id="input" value="1"  {{$product->status ? 'checked' : ""}}>
                                Hiện
                              </label>
                              <label>
                                <input type="radio" name="status" id="input" value="0"{{$product->status ? 'checked' : ""}}>
                                Ẩn
                              </label>
                            </div>
                          </div>

                        <button type="submit" name="" class="btn btn-info">Cập nhật sản phẩm</button>
                        </form>
                    </div>

                </div>
            </section>

    </div>
@endsection
