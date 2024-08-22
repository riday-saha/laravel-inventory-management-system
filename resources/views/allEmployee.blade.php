@extends('masterlayout.masterlayout')

{{-- title --}}
@section('title')
All - Employee
@endsection

{{-- page heading --}}
@section('page heading')
All Employee
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

    .action_style{
        border: 2px solid #ff5c12;
        padding: 10px;
        border-radius: 5px;
    }
</style>
@endpush

{{-- main content --}}
@section('content')

<div class="row">

    <div class="sup_table">
        <table>
            <tr>
                <th class="col-md-2">Employee's Name</th>
                <th class="col-md-2">Employee's Position</th>
                <th class="col-md-2">Employee's Phone</th>
                <th class="col-md-2">Employee's NID</th>
                <th class="col-md-2">Employee's Image</th>
                {{-- <th class="col-md-2">Details</th> --}}
                <th class="col-md-2">Action</th>
            </tr>
            @foreach ($all_employee as $all_employees)  
            <tr>
                <td class="col-md-2">{{$all_employees->name}}</td>
                <td class="col-md-2">{{$all_employees->	position}}</td>
                <td class="col-md-2">{{$all_employees->phone}}</td>
                <td class="col-md-2">{{$all_employees->nid}}</td>                
                <td class="col-md-2"><img src="{{asset('employeePic/' .$all_employees->image)}}" style="height:150px; width:190px; " alt=""></td> 
                {{-- <td><a href="{{route('detail.employee',$all_employees->id)}}" class="btn btn-primary">Details</a></td> --}}
                <td class="col-md-2">
                    <a href="{{route('detail.employee',$all_employees->id)}}" class="action_style"><i class="fas fa-eye"></i></a>
                    <a href="{{route('edit.employee',$all_employees->id)}}" class="action_style"><i class="fas fa-edit text-warning"></i></a>
                    <a href="javascript:void(0);" onclick="confirmDelete({{ $all_employees->id }})" class="action_style"><i class="fas fa-trash text-danger"></i></a>
                    <form id="delete-form-{{ $all_employees->id }}" action="{{ route('delete.employee', $all_employees->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
            @endforeach
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

