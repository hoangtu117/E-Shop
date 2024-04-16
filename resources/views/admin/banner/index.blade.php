@extends('admin.admin.admin')
@section('admin_content')
    <div class="table-agile-info">
      @if ($message = Session::get('success'))
  <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>	
          <strong>{{ $message }}</strong>
  </div>
  @endif
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê sản phẩm
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>ID</th>
            <th>Tên banner</th>
            <th>Hình ảnh</th>
            <th>Hiển thị</th>

          </tr>
        </thead>
        <tbody>
          @foreach($data as $key => $pro)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $pro->id }}</td>
            <td>{{ $pro->name }}</td>
            <td> <img src="{{asset($pro->img_thumb)}}" alt="" width="100px"></td>
            <td>{!!$pro->status?'<span class="label label-success">Hiển thị</span>':'<span class="label label-danger">Ẩn</span>'!!}</td>

            <td>
              <a href="{{route('banner.edit',$pro)}}" class="btn btn-success">Sửa</a>
                <form action="{{route('banner.destroy',$pro)}}" method="POST">
                  @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('có chắc muốn xóa không')" class="btn btn-danger">Xóa</button>
                </form> 
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">

        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">
          <ul class="pagination pagination-sm m-t-none m-b-none">
            {{$data->links()}}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection
