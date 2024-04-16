@extends('admin.admin.admin')
@section('admin_content')
<div class="card">
    <div class="card-body">
        <div class="container mb-5 mt-3">
            <div class="row d-flex align-items-baseline">
                <div class="col-xl-9">
                    <p style="color: #7e8d9f;font-size: 20px;">Invoice >> <strong>ID: {{$data[0]->order->id}}</strong></p>
                </div>
                <hr>
            </div>

            <div class="container">
                <div class="col-md-12">
                </div>


                <div class="row">
                    {{-- <div class="col-xl-8">
                        @foreach ($user as $user )
                        <ul class="list-unstyled">
                            <li class="text-muted">To: <span style="color:#5d9fc5 ;">{{$user->name}}</span></li>
                            <li class="text-muted">To: {{$user->address}}</li>
                            <li class="text-muted"><i class="fas fa-phone"></i> {{$user->phone}}</li>
                        </ul>
                        @endforeach
                        
                    </div> --}}
                    <div class="col-xl-4">
                        <p class="text-muted">Invoice</p>
                        <ul class="list-unstyled">
                            <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                    class="fw-bold">ID:</span>#{{$data[0]->order->id}}</li>
                            <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                    class="fw-bold">Creation Date: </span>{{$data[0]->order->created_at}}</li>
                            <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                    class="me-1 fw-bold">Status:</span><span class="badge bg-warning text-black fw-bold">
              Đang giao</span></li>
                        </ul>
                    </div>
                </div>

                <div class="row my-2 mx-1 justify-content-center">
                    <table class="table table-striped table-borderless">
                        <thead style="background-color:#84B0CA ;" class="text-white">
                        <tr>
                            <th  style="color: black">#</th>
                            <th style="color: black">Description</th>
                            <th  style="color: black">Quantity</th>
                            <th  style="color: black">Unit Price</th>
                            <th  style="color: black">Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                                <?php $i = 1;
                                $total = 0;
                                ?>
                            <tr>
                                <th scope="row">{{$i}}</th>
                                <td>{{$item->product->name}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>${{$item->product->price}}</td>
                                <td>${{$item->product->price * $item->quantity}}</td>
                            </tr>
                                <?php $i++;
                                $total += $item->product->price * $item->quantity;
                                ?>
                        @endforeach
                        </tbody>

                    </table>
                </div>
                <div class="row">
                    <div class="col-xl-8">
                        <p class="ms-3">Add additional notes and payment information</p>

                    </div>
                    <div class="col-xl-3">
                        <ul class="list-unstyled">
                            <li class="text-muted ms-3"><span class="text-black me-4">SubTotal</span>$ {{$total}}</li>
                            <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Tax(10%)</span>$ {{$total * 10 / 100}}</li>
                            @if($voucherValue)
                                <li class="text-success ms-3 mt-2"><span class="text-black me-4">Discount</span>- {{$voucherValue}}%</li>
                            @endif
                        </ul>
                        <p class="text-black float-start"><span class="text-black me-3"> Total Amount</span><span
                                style="font-size: 25px;">${{
                                    $voucherValue ? $total * 110 / 100 - $total*$voucherValue/100 : $total * 110 / 100
                                }}</span></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xl-10">
                        <p>Thank you for your purchase</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

