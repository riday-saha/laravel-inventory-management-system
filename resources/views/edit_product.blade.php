@extends('masterlayout.masterlayout')

{{-- title --}}
@section('title')
Edit - Product
@endsection

{{-- page heading --}}
@section('page heading')
Edit Product
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

        <form action="{{route('update.product',$edit_products->id)}}" method="POST" enctype="multipart/form-data">
            {{-- @method('put') --}}
            @csrf
            
            <div class="form-group">
                <label for="product_name">Product Name:</label>
                <input type="text" id="product_name" name="product_names" value="{{ $edit_products->product_name }}">
            </div>

            <div class="form-group">
                <label for="product_code">Product Code:</label>
                <input type="text" id="product_code" name="product_codes" value="{{ $edit_products->product_code }}">
            </div>

            <div class="form-group">
                <label for="category">Category:</label>   
                <select id="category" name="categorys">
                    @foreach ($options_c as $option_c )    
                    <option value="{{$option_c->id}}" {{ $option_c->id == $edit_products->category_id ? 'selected' : '' }}>{{$option_c->category_name}}</option>
                    @endforeach
                </select>    
            </div>

            <div class="form-group">
                <label for="supplier">Supplier:</label>
                <select id="supplier" name="suppliers">
                    @foreach ($options_s as $option_s )    
                    <option value="{{$option_s->id}}" {{ $option_s->id == $edit_products->supplier_id ? 'selected' : '' }}>{{$option_s->supplier_name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="godaun">Godaun:</label>
                <input type="text" id="godaun" name="godauns" value="{{ $edit_products->godaun }}">
            </div>

            <div class="form-group">
                <label for="buying_date">Buying Date:</label>
                <input type="date" id="buying_date" name="buying_dates" value="{{ $edit_products->buying_date }}">
            </div>

            <div class="form-group">
                <label for="expire_date">Expire Date:</label>
                <input type="date" id="expire_date" name="expire_dates" value="{{ $edit_products->expire_date }}">
            </div>

            <div class="form-group">
                <label for="buying_price">Buying Price:</label>
                <input type="number" step="0.01" id="buying_price" name="buying_prices" value="{{ $edit_products->buying_price }}">
            </div>

            <div class="form-group">
                <label for="selling_price">Selling Price:</label>
                <input type="number" step="0.01" id="selling_price" name="selling_prices" value="{{$edit_products->selling_price}}">
            </div>

            <div class="form-group">
                <label for="product_image">Product Current Image</label>
                <img src="{{asset('productPic/' .$edit_products->photo)}}" alt="">
                {{-- <input type="file" id="product_image" name="product_image"> --}}
            </div>

            <div class="form-group">
                <label for="product_image">Choose Update Image</label>
                <input type="file" id="product_image" name="product_images">
            </div>

            <button type="submit" class="btn btn-success">Update Product</button>
        </form>
    </div>
</div>

















@endsection
