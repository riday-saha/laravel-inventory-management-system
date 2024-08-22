@extends('masterlayout.masterlayout')

{{-- title --}}
@section('title')
All- Customer
@endsection

{{-- page heading --}}
@section('page heading')
All Customer
@endsection

{{-- custom css --}}
@push('styles')
<style>
    
    .add_cus{
        margin-left: auto;
        padding-right: 50px;
    }

    .sup_table{
        margin: auto;
        padding-top: 30px;
    }
    table{
        border: 2px solid #446AD8;
        text-align: center;
        color:black;
        font-size: 20px;
        
    }
    th{
        border: 2px solid #446AD8;
        padding: 20px;
        font-weight: bold;
    }
    td{
        border: 2px solid #446AD8;
        padding: 25px;
    }
</style>
@endpush

{{-- main content --}}
@section('content')

<div class="row">

    <div class="add_cus">
        <a href="{{route('customer')}}" class="btn btn-primary">Add Customer</a>
    </div>

    <div class="sup_table">
        <table>
            <tr>
                <th class="col-md-2">Supplier's Name</th>
                <th class="col-md-2">Supplier's Address</th>
                <th class="col-md-2">Supplier's Phone</th>
                <th class="col-md-2">Supplier's NID</th>
                <th class="col-md-2">Note</th>
                <th class="col-md-2">Supplier's Image</th>
                <th class="col-md-2">Action</th>
            </tr>
            @foreach ($view_customers as $view_customer)  
            <tr>

                <td class="col-md-2">{{$view_customer->cus_name}}</td>
                <td class="col-md-2">{{$view_customer->cus_address}}</td>
                <td class="col-md-2">{{$view_customer->cus_phone}}</td>
                <td class="col-md-2">{{$view_customer->cus_nid}}</td>
                <td class="col-md-2">{{$view_customer->cus_note}}</td>
                
                <td class="col-md-2"><img src="{{asset('customerPic/' .$view_customer->cus_image)}}" style="height:150px; width:190px; " alt=""></td> 
                <td class="col-md-2">
                    <a href="{{route('edit.customer',$view_customer->id)}}"><i class="fas fa-edit"></i></a>
                
                    <a href="javascript:void(0);" onclick="confirmDelete({{ $view_customer->id }})"><i class="fas fa-trash"></i></a>
                    <form id="delete-form-{{ $view_customer->id }}" action="{{ route('delete.customer', $view_customer->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                       
                
                </td>
            </tr>
            @endforeach
        </table>
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
