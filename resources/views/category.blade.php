@extends('masterlayout.masterlayout')

{{-- title --}}
@section('title')
Category
@endsection

{{-- page heading --}}
@section('page heading')
Product Category
@endsection

{{-- custom css --}}
@push('styles')
<style>
    #cat_form {
        margin: auto;
    }

    .category {
        width: 400px !important;
    }
    .cat_table{
        margin: auto;
        padding-top: 60px;
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
    <div id="cat_form">
        <form action="{{ route('add.category') }}" method="POST" class="form-inline">
            @csrf
            <div class="form-group mx-sm-3 mb-2">
                <input type="text" name="category" value="" class="form-control category" id="search" placeholder="Category Name">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Submit</button>
        </form>
        @error('category')
            <div class="text-danger text-center p-2">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row">
    <div class="cat_table">
        <table>
            <tr>
                <th>Category Title</th>
                <th>Action</th>
            </tr>
            @foreach ($show_cat as $show_cats )  
            <tr>
                <td>{{$show_cats->category_name}}</td>
                <td>
                    <a href="{{route('edit.category',$show_cats->id)}}" class="btn btn-warning">Edit</a>
                    {{-- <a href="{{route('remove.category',$show_cats->id)}}" class="btn btn-danger">Remove</a>  --}}
                    
                    <a href="javascript:void(0);" onclick="confirmDelete({{ $show_cats->id }})" class="btn btn-danger">Remove</a>
                    <form id="delete-form-{{ $show_cats->id }}" action="{{ route('remove.category',$show_cats->id) }}" method="POST" style="display: none;">
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
