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
                    Thêm voucher
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form id="create" method="POST" action="{{ route('voucher.store') }}">
                            @csrf
                            <div class="form-group"  >
                                <label>Code</label>
                                <input type="text" class="form-control" id="code" name="code"  placeholder="code">
                            </div>
                            <div class="form-group"  >
                                <label>Expiration Date</label>
                                <input type="date" class="form-control" id="expiration_date" name="expiration_date"  placeholder="code">
                            </div>
                    
                            <div class="form-group">
                                <label>Usage Limit</label>
                                <input type="text" class="form-control" id="usage_limit" name="usage_limit" placeholder="Image">
                            </div>
                    
                            <div class="form-group">
                                <label>Value</label>
                                <input type="number" class="form-control" id="value" name="value" placeholder="Image">
                            </div>
                    
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        </form>
                    </div>

                </div>
            </section>

    </div>
@endsection