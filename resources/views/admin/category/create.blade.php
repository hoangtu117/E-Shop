@extends('admin.admin.admin');
@section('admin_content');
<div class="row">
  @if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm danh mục sản phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{route('category.store')}}" method="POST">
                        @csrf
                        <div class="form-group  has-error ">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            
                    <input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Chọn trạng thái</label>
                            <div class="radio">
                              <label>
                                <input type="radio" name="status" id="input" value="1" checked="checked">
                                Hiện
                              </label>
                              <label>
                                <input type="radio" name="status" id="input" value="0">
                                Ẩn
                              </label>
                            </div>
                          </div>
                        <button type="submit" class="btn btn-info">Thêm Danh mục</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
@endsection
