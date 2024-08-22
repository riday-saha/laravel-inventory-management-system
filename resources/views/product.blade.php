@extends('masterlayout.masterlayout')

{{-- title --}}
@section('title')
Add - Product
@endsection

{{-- page heading --}}
@section('page heading')
Add Product
@endsection

{{-- custom css --}}
@push('styles')
<style>
    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
    }

    .form-group input {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }

    .form-group button {
        padding: 10px 15px;
        background-color: #007bff;
        color: white;
        border: none;
        cursor: pointer;
    }

    .form-group button:hover {
        background-color: #0056b3;
    }

    .pro_form{
        margin: auto;
        width: 500px;
    }
</style>
@endpush

{{-- main content --}}
@section('content')

<div class="row">
    <div class="pro_form">
        @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{route('add.product')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="product_name">Product Name:</label>
                <input type="text" id="product_name" class="form-control" name="product_name" value="{{ old('product_name') }}">
            </div>

            <div class="form-group">
                <label for="product_code">Product Code:</label>
                <input type="text" id="product_code" class="form-control" name="product_code" value="{{ old('product_code') }}">
            </div>

            <div class="form-group">
                <label for="category">Category:</label>   
                <select id="category" class="form-control" name="category">
                    <option value="">Select Category</option>
                    @foreach ($show_categoy as $show_categories )    
                    <option value="{{$show_categories->id}}" {{ old('category') == '$show_categories->id' ? 'selected' : '' }}>{{$show_categories->category_name}}</option>
                    @endforeach
                </select>    
            </div>

            <div class="form-group">
                <label for="supplier">Supplier:</label>
                <select id="supplier" class="form-control" name="supplier">
                    <option value="">Select Supplier</option>
                    @foreach ($show_supplier as $show_suppliers )    
                    <option value="{{$show_suppliers->id}}" {{ old('category') == '$show_suppliers->id' ? 'selected' : '' }}>{{$show_suppliers->supplier_name}}</option>
                    @endforeach
                </select> 
            </div>

            <div class="form-group">
                <label for="godaun">Godaun:</label>
                <input type="text" id="godaun" class="form-control" name="godaun" value="{{ old('godaun') }}">
            </div>

            <div class="form-group">
                <label for="buying_date">Buying Date:</label>
                <input type="date" id="buying_date" class="form-control" name="buying_date" value="{{ old('buying_date') }}">
            </div>

            <div class="form-group">
                <label for="expire_date">Expire Date:</label>
                <input type="date" id="expire_date" class="form-control" name="expire_date" value="{{ old('expire_date') }}">
            </div>

            <div class="form-group">
                <label for="buying_price">Buying Price:</label>
                <input type="number" step="0.01" id="buying_price" class="form-control" name="buying_price" value="{{ old('buying_price') }}">
            </div>

            <div class="form-group">
                <label for="selling_price">Selling Price:</label>
                <input type="number" step="0.01" id="selling_price" class="form-control" name="selling_price" value="{{ old('selling_price') }}">
            </div>

            <div class="form-group">
                <label for="product_image">Product Image</label>
                <input type="file" id="product_image" class="form-control" name="product_image">
            </div>

            <button type="submit" class="btn btn-success">Add Product</button>
        </form>
    </div>
</div>

















@endsection
