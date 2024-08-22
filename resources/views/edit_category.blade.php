@extends('masterlayout.masterlayout')

{{-- title --}}
@section('title')
Edit-Category
@endsection

{{-- page heading --}}
@section('page heading')
Edit Category
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
        <form action="{{route('update.category',$edit_cat->id)}}" method="POST" class="form-inline">
            @csrf
            <div class="form-group mx-sm-3 mb-2">
                <input type="text" name="category" value="{{$edit_cat->category_name}}" class="form-control category" id="search" placeholder="Category Name">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Submit</button>
        </form>
        @error('category')
            <div class="text-danger text-center p-2">{{ $message }}</div>
        @enderror
    </div>
</div>

















@endsection
