{{-- custom css --}}
@push('styles')
    <style>
    .sup_form{
        border:2px solid red;
    }
    </style>
@endpush









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

    <form action="{{route('update.pos',$product_edit->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="p_name">Product Name</label>
            <input type="text" id="p_name" name="p_name" value="{{$product_edit->product->product_name}}">
        </div>

        <div class="form-group">
            <label for="p_quantity">Product Quantity</label>
            <input type="number" id="p_quantity" name="p_quantity" value="{{$product_edit->quantity}}">
        </div>

        

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>