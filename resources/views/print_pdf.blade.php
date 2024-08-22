@php
    $previousCustomer = null;
    $previousAddress = null;
    $rowspan = 0;
    $customerDetails = [];

    // First pass to calculate rowspans
    foreach ($print_order as $print_orders) {
        if ($print_orders->customer->cus_name != $previousCustomer || $print_orders->customer->cus_address != $previousAddress) {
            if ($previousCustomer !== null) {
                $customerDetails[$previousCustomer]['rowspan'] = $rowspan;
            }
            $previousCustomer = $print_orders->customer->cus_name;
            $previousAddress = $print_orders->customer->cus_address;
            $rowspan = 1;
            $customerDetails[$previousCustomer] = [
                'name' => $print_orders->customer->cus_name,
                'address' => $print_orders->customer->cus_address,
                'rowspan' => 0
            ];
        } else {
            $rowspan++;
        }
    }
    // Set the last customer rowspan
    if ($previousCustomer !== null) {
        $customerDetails[$previousCustomer]['rowspan'] = $rowspan;
    }
@endphp

<h2 style="text-align: center;">ABC Store</h2>
<h3>Invoice</h3>

<!-- Table for Product and Customer Details -->
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Customer Name</th>
            <th>Address</th>
            <th>Product Title</th>
            <th>Quantity</th>
            <th>Single Price</th>
            <th>Total Price</th>
        </tr>
    </thead>
    <tbody>
        @php
            $previousCustomer = null;
        @endphp
        @foreach ($print_order as $print_orders)
        <tr>
            @if ($print_orders->customer->cus_name != $previousCustomer)
                @php
                    $currentCustomer = $print_orders->customer->cus_name;
                    $rowspan = $customerDetails[$currentCustomer]['rowspan'];
                @endphp
                <td rowspan="{{ $rowspan }}">{{ $print_orders->customer->cus_name }}</td>
                <td rowspan="{{ $rowspan }}">{{ $print_orders->customer->cus_address }}</td>
                @php
                    $previousCustomer = $print_orders->customer->cus_name;
                @endphp
            @endif
            <td>{{ $print_orders->product->product_name }}</td>
            <td>{{ $print_orders->quantity }}</td>
            <td>{{ $print_orders->product->selling_price }}</td>
            @php
                $b = $print_orders->product->selling_price;
                $c = $print_orders->quantity;
            @endphp
            <td>{{ $b * $c }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Table for Payment Details -->
<table class="table table-bordered table-striped" style="margin-top: 20px;">
    <thead>
        <tr>
            <th>Payment Type</th>
            <th>Paid Amount</th>
            <th>Due Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($print_order as $print_orders)
        <tr>
            <td>{{ $print_orders->payment_method }}</td>
            <td>{{ $print_orders->paid_amount }}</td>
            <td>{{ $print_orders->due_amount }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
