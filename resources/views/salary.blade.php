@extends('masterlayout.masterlayout')

{{-- title --}}
@section('title')
salary
@endsection

{{-- page heading --}}
@section('page heading')
Employee Salary
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

    {{-- <div class="add_cus">
        <a href="{{route('customer')}}" class="btn btn-primary">Add Customer</a>
    </div> --}}

    <div class="sup_table">
        <table>
            <tr>
                <th class="col-md-2">Employee Name</th>
                <th class="col-md-2">Image</th>
                <th class="col-md-2">Salary</th>
                <th class="col-md-2">Action</th>
            </tr>
            @foreach ($emp_salary as $emp_salarys )
                
           
            <tr>
                <td class="col-md-2">{{$emp_salarys->name}}</td>
                <td class="col-md-2">
                    <img src="employeePic/{{$emp_salarys->image}}" alt="" style="height: 150px;width:150px;">
                </td>
                <td class="col-md-2">{{$emp_salarys->salay}}</td>
                <td class="col-md-2">
                    <a href="" class="btn btn-success">Paid</a>
                    <a href="" class="btn btn-danger">Due</a>
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
