@extends('masterlayout.masterlayout')

{{-- title --}}
@section('title')
Product Details
@endsection

{{-- page heading --}}
@section('page heading')
Product Details
@endsection

{{-- custom css --}}
@push('styles')
<style>
    

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

    <div class="sup_table">
        <table>
            <tr>
                <th class="col-md-2">Title</th>
                <th class="col-md-2">Code</th>
                <th class="col-md-2">Godaun</th>
                <th class="col-md-2">Buying Date</th>
                <th class="col-md-2">Exp Date</th>
                <th class="col-md-2">Image</th>
                <th class="col-md-2">Buying Price</th>
                <th class="col-md-2">Selling Price</th>
                <th class="col-md-2">Category</th>
                <th class="col-md-2">Seller</th>
                <th class="col-md-2">Action</th>
            </tr>
            @foreach ($view_products as $view_product )  
            <tr>

                <td class="col-md-2">{{$view_product->product_name}}</td>
                <td class="col-md-2">{{$view_product->	product_code}}</td>
                <td class="col-md-2">{{$view_product->godaun}}</td>
                <td class="col-md-2">{{$view_product->buying_date}}</td>
                <td class="col-md-2">{{$view_product->expire_date}}</td>
                <td  class="col-md-2"><img src="{{asset('productPic/' .$view_product->photo)}}" style="height:150px; width:190px; " alt=""></td> 
                
                <td class="col-md-2">{{$view_product->buying_price}}</td>
                <td class="col-md-2">{{$view_product->selling_price}}</td>
                <td class="col-md-2">{{$view_product->category->category_name}}</td>
                <td class="col-md-2">{{$view_product->supplier->supplier_name}}</td>

                <td>
                    <a href="{{route('edit.product',$view_product->id)}}"><i class="fas fa-edit"></i></a>
                    <a href="javascript:void(0);" onclick="confirmDelete({{ $view_product->id }})"><i class="fas fa-trash"></i></a>
                    <form id="delete-form-{{ $view_product->id }}" action="{{ route('delete.product', $view_product->id) }}" method="POST" style="display: none;">
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
