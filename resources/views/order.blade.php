@extends('masterlayout.masterlayout')

{{-- title --}}
@section('title')
Order Details
@endsection

{{-- page heading --}}
@section('page heading')
Order Details
@endsection

{{-- custom css --}}
@push('styles')
<style>
    .sup_table {
        margin: auto;
        padding-top: 30px;
    }
    table {
        border: 2px solid #000000 !important;
        text-align: center !important;
        color: black !important;
        font-size: 20px !important;
        width: 100% !important;
    }
    th, td {
        border: 2px solid #000000 !important;
        padding: 10px;
    }
    .table-responsive {
        overflow-x: auto;
    }
</style>
@endpush

{{-- main content --}}
@section('content')

<div class="row">
    <div class="sup_table table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th rowspan="2">Customer Name</th>
                    <th rowspan="2">Address</th>
                    <th rowspan="2">Product Title</th>
                    <th rowspan="2">Quantity</th>
                    <th rowspan="2">Single Price</th>
                    <th rowspan="2">Total Price</th>
                    <th colspan="3">Payment</th>
                    <th rowspan="2">Status</th>
                    <th rowspan="2">Change Status</th>
                    <th rowspan="2">Print</th>
                    <th rowspan="2">Edit</th>
                </tr>
                <tr>
                    <th>Type</th>
                    <th>Paid</th>
                    <th>Due</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $lastCustomerName = null;
                    $lastCustomerAddress = null;
                    $orderId = null;

                   

                @endphp
                @foreach ($all_order as $all_orders)
                <tr>
                    <td>
                        @if ($lastCustomerName != $all_orders->customer->cus_name)
                        {{ $all_orders->customer->cus_name }}
                        @php 
                            $lastCustomerName = $all_orders->customer->cus_name;
                         @endphp
                        @endif   
                    </td>
                    <td>
                        @if ($lastCustomerAddress != $all_orders->customer->cus_address)
                        {{ Str::limit($all_orders->customer->cus_address, 10) }}
                        @php $lastCustomerAddress = $all_orders->customer->cus_address; @endphp
                    @endif
                    </td>
                    <td>{{$all_orders->product->product_name}}</td>
                    <td>{{$all_orders->quantity}}</td>
                    <td>{{$all_orders->product->selling_price}}</td>
                    @php
                        $b = $all_orders->product->selling_price;
                        $c = $all_orders->quantity;
                    @endphp
                    <td>{{$b * $c}}</td>
                    <td>{{$all_orders->payment_method}}</td>
                    <td>{{$all_orders->paid_amount}}</td>
                    <td>{{$all_orders->due_amount}}</td>
                    <td>
                        @if ($all_orders->status == 'Pending')
                            <span style="color: red; font-weight: bold;">{{$all_orders->status}}</span>
                        @elseif ($all_orders->status == 'Completed')
                            <span style="color: #0076ff; font-weight: bold;">{{$all_orders->status}}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('update.success',$all_orders->id)}}" class="btn btn-success">Success</a>
                    </td>
                    <td>
                        @if ($orderId != $all_orders->customer_id)
                            <a href="{{route('print.order',$all_orders->customer_id)}}"><i class="fas fa-print"></i></a>
                            @php
                               $orderId =  $all_orders->customer_id;
                            @endphp
                        @endif    
                    </td>
                    <td>
                        <a href="javascript:void(0);" onclick="confirmDelete({{ $all_orders->id }})" style="color: red"><i class="fas fa-trash"></i></a>
                        <form id="delete-form-{{ $all_orders->id }}" action="{{ route('delete.order', $all_orders->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function confirmDelete(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                })
            }
        </script>




@endsection
