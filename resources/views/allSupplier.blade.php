@extends('masterlayout.masterlayout')

{{-- title --}}
@section('title')
All-Supplier
@endsection

{{-- page heading --}}
@section('page heading')
All Supplier
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
        font-weight: bold;
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
                <th>Supplier's Name</th>
                <th>Supplier's Address</th>
                <th>Supplier's Phone</th>
                <th>Supplier's NID</th>
                <th>Supplier's Image</th>
                <th>Action</th>
            </tr>
            @foreach ($view_suppliers as $view_supplier )  
            <tr>

                <td>{{$view_supplier->supplier_name}}</td>
                <td>{{$view_supplier->supplier_address}}</td>
                <td>{{$view_supplier->supplier_phone}}</td>
                <td>{{$view_supplier->supplier_nid}}</td>
                <td><img src="{{asset('supplierPic/' .$view_supplier->supplier_image)}}" style="height:150px; width:190px; " alt=""></td> 
                <td>
                    <a href="{{route('edit.supplier',$view_supplier->id)}}"><i class="fas fa-edit"></i></a>
                    {{-- <a href="{{route('delete.supplier',$view_supplier->id)}}" onclick="confirmDelete({{ $view_supplier->id }})"><i class="fas fa-trash"></i></a>     --}}
                
                    <a href="javascript:void(0);" onclick="confirmDelete({{ $view_supplier->id }})"><i class="fas fa-trash"></i></a>
                    <form id="delete-form-{{ $view_supplier->id }}" action="{{ route('delete.supplier', $view_supplier->id) }}" method="POST" style="display: none;">
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
