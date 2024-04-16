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
                    Cập nhật banner
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{route('banner.update',$banner)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" value="{{$banner->name}}" data-validation="length" data-validation-length="min10" data-validation-error-msg="Làm ơn điền ít nhất 10 ký tự" name="name" class="form-control " id="slug" placeholder="Tên danh mục" onkeyup="ChangeToSlug();">
                        </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                            <input type="file" name="img_thumb" class="form-control" id="img_thumb">
                            <img src="{{asset($banner->img_thumb)}}" alt="" width="100px" >
                        </div>
                       
                        <div class="form-group">
                            <label for="exampleInputEmail1">Chọn trạng thái</label>
                            <div class="radio">
                              <label>
                                <input type="radio" name="status" id="input" value="1"  {{$banner->status ? 'checked' : ""}}>
                                Hiện
                              </label>
                              <label>
                                <input type="radio" name="status" id="input" value="0"{{$banner->status ? 'checked' : ""}}>
                                Ẩn
                              </label>
                            </div>
                          </div>

                        <button type="submit" name="" class="btn btn-info">Cập nhật banner</button>
                        </form>
                    </div>

                </div>
            </section>

    </div>
@endsection
