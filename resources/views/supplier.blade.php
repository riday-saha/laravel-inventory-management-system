@extends('masterlayout.masterlayout')

{{-- title --}}
@section('title')
Add - Supplier
@endsection

{{-- page heading --}}
@section('page heading')
Add Supplier
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

    .sup_form{
        margin: auto;
        width: 500px;
    }
</style>

@endpush

{{-- main content --}}
@section('content')

<div class="row">
    <div class="sup_form">
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    
        <form action="{{route('add.supplier')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="supplier_name">Supplier's Name</label>
                <input type="text" id="supplier_name" name="supplier_name" value="{{ old('supplier_name') }}">
            </div>
    
            <div class="form-group">
                <label for="supplier_address">Supplier's Address</label>
                <textarea id="supplier_address" name="supplier_address" cols="50" rows="4">{{ old('supplier_address') }}</textarea>
            </div>
    
            <div class="form-group">
                <label for="supplier_phone">Supplier's Phone</label>
                <input type="text" id="supplier_phone" name="supplier_phone" value="{{ old('supplier_phone') }}">
            </div>
    
            <div class="form-group">
                <label for="supplier_nid">Supplier's NID</label>
                <input type="text" id="supplier_nid" name="supplier_nid" value="{{ old('supplier_nid') }}">
            </div>
    
            <div class="form-group">
                <label for="supplier_image">Supplier's Image</label>
                <input type="file" id="supplier_image" name="supplier_image">
            </div>
    
            <button type="submit" class="btn btn-success">Add Supplier</button>
        </form>
    </div>
    
</div>

















@endsection
