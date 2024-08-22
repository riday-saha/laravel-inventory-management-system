@extends('masterlayout.masterlayout')

{{-- title --}}
@section('title')
Update - Customer
@endsection

{{-- page heading --}}
@section('page heading')
Update Customer
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
    
        <form action="{{route('update.customer',$edit_customer->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="customer_name">Customer's Name</label>
                <input type="text" id="customer_name" name="customer_name" value="{{$edit_customer->cus_name}}">
            </div>
    
            <div class="form-group">
                <label for="customer_address">Customer's Address</label>
                <textarea id="customer_address" name="customer_address" cols="50" rows="4">{{ $edit_customer->cus_address }}</textarea>
            </div>
    
            <div class="form-group">
                <label for="customer_phone">Customer's Phone</label>
                <input type="text" id="customer_phone" name="customer_phone" value="{{ $edit_customer->cus_phone }}">
            </div>
    
            <div class="form-group">
                <label for="customer_nid">Customer's NID</label>
                <input type="text" id="customer_nid" name="customer_nid" value="{{ $edit_customer->cus_nid }}">
            </div>
    
            <div class="form-group">
                <label for="customer_image">Customer's Image</label>
                <img src="{{asset('customerPic/'.$edit_customer->cus_image)}}" alt="" style="height: 240px; width:300px;">
            </div>

            <div class="form-group">
                <label for="customer_updateimage">Update Customer's Image</label>
                <input type="file" id="customer_image" name="customer_image">
            </div>

            <div class="form-group">
                <label for="customer_note">Note</label>
                <textarea id="customer_note" name="customer_note" cols="50" rows="4" placeholder="Make a note..">{{ $edit_customer->cus_note }}</textarea>
            </div>
    
            <button type="submit" class="btn btn-success">Update Customer</button>
        </form>
    </div>
    
</div>
@endsection
