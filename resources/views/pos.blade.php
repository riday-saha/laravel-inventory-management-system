@extends('masterlayout.masterlayout')

{{-- title --}}
@section('title')
Inventory - POS
@endsection

{{-- page heading --}}
@section('page heading')
Point of Sale
@endsection

{{-- custom css --}}
@push('styles')
    <style>
        table {
            border: 2px solid red;
            text-align: center;
        }
        th {
            border: 2px solid red;
            padding: 15px;
        }
        td {
            border: 2px solid red;
            padding: 15px;
        }
    </style>
@endpush

{{-- main content --}}
@section('content')

<div class="container">
    <div class="row">
        <!-- Cart Table -->
        <div class="col-md-5 mb-4">
            <div class="table-responsive">
                <h2 class="text-center">Make Order</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Single Price</th>
                            <th>Sub Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $grandTotal = 0;
                        @endphp
                        @foreach ($added_product as $added_products)
                        @php
                            $subtotal = $added_products->quantity * $added_products->product->selling_price;
                            $grandTotal += $subtotal;
                        @endphp
                        <tr>
                            <td>{{ $added_products->product->product_name }}</td>
                            <td>
                                {{ $added_products->quantity }}
                                <a href="{{route('edit.pos',$added_products->id)}}" class="text-primary"><i class="fas fa-edit"></i></a>
                            </td>
                            <td>{{ $added_products->product->selling_price }}</td>
                            <td>{{ $subtotal }}</td>
                            <td>
                                <a href="{{route('product.remove',$added_products->id)}}" class="btn btn-danger btn-sm">Remove</a>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="3"><strong>Grand Total</strong></td>
                            <td id="grand-total"><strong>{{ $grandTotal }}</strong></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{route('customer')}}" class="btn btn-primary">Add Customer</a>
            </div>

            <form action="{{ route('cart.transfer') }}" method="POST" class="mt-4">
                @csrf
                <div class="form-group">
                    <label for="customer">Select Customer:</label>
                    <select name="customer_id" id="customer" class="form-control" required>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->cus_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="payment_method">Payment Method:</label>
                    <select name="payment_method" id="payment_method" class="form-control" required>
                        <option value="HandCash">HandCash</option>
                        <option value="Bank-Check">Bank-Check</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="paid_amount">Paid Amount:</label>
                    <input type="number" name="paid_amount" id="paid_amount" class="form-control" min="0" required>
                </div>
                <div class="form-group">
                    <label for="due_amount">Due Amount:</label>
                    <input type="number" name="due_amount" id="due_amount" class="form-control" min="0" readonly>
                </div>
                <button type="submit" class="btn btn-success">Place Order</button>
            </form>
        </div>

        <!-- Product Table -->
        <div class="col-md-7">
            <div class="table-responsive">
                <h2 class="text-center">All Products</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Code</th>
                            <th>Quantity</th>
                            <th>Add to Cart</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pos_product as $pos_products )
                        <tr>
                            <td>
                                <img src="{{asset('productPic/'.$pos_products->photo)}}" alt="" class="img-fluid" style="height: 100px;width:150px;">
                            </td>
                            <td>{{$pos_products->product_name}}</td>
                            <td>{{$pos_products->category->category_name}}</td>
                            <td>{{$pos_products->product_code}}</td>
                            <td>
                                <input type="number" id="quantity-{{ $pos_products->id }}" min="1" value="1" class="form-control" style="max-width: 60px;">
                            </td>
                            <td>
                                <button class="btn btn-primary" onclick="addToCart({{ $pos_products->id }})">Add</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    <span class="d-flex justify-content-center">{{$pos_product->links()}}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function addToCart(productId) {
        var quantity = $('#quantity-' + productId).val();

        $.ajax({
            url: '{{ route("cart.add") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: productId,
                quantity: quantity
            },
            success: function(response) {
                console.log(response.message);
                location.reload(true);
            },
            error: function(response) {
                alert('Error adding product to cart.');
            }
        });
    }

    $(document).ready(function() {
        $('#paid_amount').on('input', function() {
            var grandTotal = parseFloat($('#grand-total').text());
            var paidAmount = parseFloat($(this).val()) || 0;
            var dueAmount = grandTotal - paidAmount;
            $('#due_amount').val(dueAmount.toFixed(2));
        });
    });
</script>

@endsection
