<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Add_cart;
use App\Models\Category;
use App\Models\Customer;
use App\Models\employee;
use App\Models\Supplier;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\SupplierRequest;
use App\Http\Requests\AttendanceRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Requests\UpdateSupplierRequest;

class AdminController extends Controller
{
    
    //category related
    public function category(){
        $show_cat = Category::all();
        return view('category',compact('show_cat'));
    }

    public function add_category(Request $request){
        $request -> validate([
            'category' => 'required|max:50|regex:/^[\s\S]*[a-zA-Z]+[\s\S]*$/'
        ]);

        $add_category = Category::create([
            'category_name' => $request->input('category'),
        ]);
        toastr()->success('Category Added Successfully');
        return redirect()->back();
    }

    public function edit_category($id){
        $edit_cat = Category::find($id);
        return view('edit_category',compact('edit_cat'));
    }

    public function update_category(Request $request ,$id){
        $request -> validate([
            'category' => 'nullable|max:50|regex:/^[\s\S]*[a-zA-Z]+[\s\S]*$/'
        ]);

        $category = category::find($id);

        $update_category = Category::find($id)->update([
            'category_name' => $request->input('category')?? $category->category_name,
        ]);
        toastr()->success('Category Updated Successfully');
        return redirect()->route('admin.category');
    }

    public function remove_category($id){
        $remove = Category::find($id)->delete();
        return redirect()->back();
    }
    //   end category
 
    // start for suppliers
    public function supplier(){
        return view('supplier');
    }

    public function add_supplier(SupplierRequest $request){
    $validatedData = $request->validated();
    if ($request->hasFile('supplier_image')) {
        $image = $request->file('supplier_image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/supplierPic');
        $image->move($destinationPath, $imageName);
        $validatedData['supplier_image'] = $imageName;
    }
    $supplier_add = Supplier::create([
        'supplier_name' => $validatedData['supplier_name'],
        'supplier_address' => $validatedData['supplier_address'],
        'supplier_phone' => $validatedData['supplier_phone'],
        'supplier_nid' => $validatedData['supplier_nid'],
        'supplier_image' => $validatedData['supplier_image'] ?? null, // Default to null if no image uploaded
    ]);
    toastr()->success('Supplier Added Successfully');
    return redirect()->route('view.supplier');
    }

    public function view_supplier(){
        $view_suppliers = Supplier::all();
        return view('allSupplier',compact('view_suppliers'));
    }

    public function edit_supplier($id){
        $edit_supplier = Supplier::find($id);
        return view('edit_supplier',compact('edit_supplier'));
    }

    public function update_supplier(UpdateSupplierRequest $request, $id){
        $validated_supplier = $request->validated();

        // Handle the file upload
        if ($request->hasFile('supplier_image')) {
            $image = $request->file('supplier_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/supplierPic');
            $image->move($destinationPath, $imageName);
            $validated_supplier['supplier_image'] = $imageName;
        }
        $supplier = Supplier::find($id);
        $update_supplier = $supplier->update([
            'supplier_name' => $validated_supplier['supplier_name'],
            'supplier_address' => $validated_supplier['supplier_address'],
            'supplier_phone' => $validated_supplier['supplier_phone'],
            'supplier_nid' => $validated_supplier['supplier_nid'],
            'supplier_image' => $validated_supplier['supplier_image'] ?? $supplier->supplier_image,
        ]);
        toastr()->warning('Supplier Updated Successfully');
        return redirect()->route('view.supplier');
    }

    public function delete_supplier($id){
    // Find the supplier
    $supplier = Supplier::find($id);
    
    if ($supplier) {
        // Get the image path
        $image_path = public_path('supplierPic/' . $supplier->supplier_image);

        // Delete the image file if it exists
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        // Delete the supplier record from the database
        $supplier->delete();

        toastr()->warning('Supplier Deleted Successfully');
    } else {
        toastr()->error('Supplier not found');
    }

    return redirect()->back();
    }
    //end supplier
    
// start for product
    public function product(){
        $show_categoy = Category::all();
        $show_supplier = Supplier::all();
    return view('product',compact('show_categoy','show_supplier'));
    }

    public function add_product(ProductRequest $request){
        $productValidate = $request->validated();
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/productPic');
            $image->move($destinationPath, $imageName);
            $productValidate['product_image'] = $imageName;
        }
        $product_add = Product::create([
            'product_name' => $productValidate['product_name'],
            'product_code' => $productValidate['product_code'],
            'category_id' => $productValidate['category'],
            'supplier_id' => $productValidate['supplier'],
            'godaun' => $productValidate['godaun'],
            'buying_date' => $productValidate['buying_date'],
            'expire_date' => $productValidate['expire_date'],
            'buying_price' => $productValidate['buying_price'],
            'selling_price' => $productValidate['selling_price'],
            'photo' => $productValidate['product_image'] ?? null, // Default to null if no image uploaded
        ]);
        toastr()->success('Product Added Successfully');
        return redirect()->route('view.product');
    }

    public function view_product(){
        $view_products = Product::all();
        return view('allProduct',compact('view_products'));
    }

    public function edit_product($id){
        $options_c = Category::all();
        $options_s = Supplier::all();

        $edit_products = Product::find($id);
        return view('edit_product',compact('edit_products','options_c','options_s'));
    }

    public function update_product(UpdateProductRequest $request, $id){
        $validated_product = $request->validated();

        // Handle the file upload
        if ($request->hasFile('product_images')) {
            $image = $request->file('product_images');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/productPic');
            $image->move($destinationPath, $imageName);
            $validated_product['product_images'] = $imageName;
        }
        $product = Product::find($id);
        $update_product = $product->update([
            'product_name' => $validated_product['product_names'],
            'product_code' => $validated_product['product_codes'],
            'category_id' => $validated_product['categorys'],
            'supplier_id' => $validated_product['suppliers'],
            'godaun' => $validated_product['godauns'],
            'buying_date' => $validated_product['buying_dates'],
            'expire_date' => $validated_product['expire_dates'],
            'buying_price' => $validated_product['buying_prices'],
            'selling_price' => $validated_product['selling_prices'],
            'photo' => $validated_product['product_images'] ?? $product->photo,
        ]);
        toastr()->warning('Product Updated Successfully');
        return redirect()->route('view.product');
    }


    public function delete_product($id){
        // Find the supplier
        $product = Product::find($id);
        
        if ($product) {
            // Get the image path
            $image_path = public_path('productPic/' . $product->photo);
    
            // Delete the image file if it exists
            if (file_exists($image_path)) {
                unlink($image_path);
            }
    
            // Delete the supplier record from the database
            $product ->delete();
    
            toastr()->warning('Prduct Deleted Successfully');
        } else {
            toastr()->error('Product not found');
        }
    
        return redirect()->back();
    }

//end product

    //start for customer
    public function customer(){
    return view('customer');
    }

    public function add_customer(CustomerRequest $request){
        $Customervalidated = $request->validated();
        if ($request->hasFile('customer_image')) {
            $image = $request->file('customer_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/customerPic');
            $image->move($destinationPath, $imageName);
            $Customervalidated['customer_image'] = $imageName;
        }
        $supplier_add = Customer::create([
            'cus_name' => $Customervalidated['customer_name'],
            'cus_address' => $Customervalidated['customer_address'],
            'cus_phone' => $Customervalidated['customer_phone'],
            'cus_nid' => $Customervalidated['customer_nid'],
            'cus_note' => $Customervalidated['customer_note'],
            'cus_image' => $Customervalidated['customer_image'] ?? null, // Default to null if no image uploaded
        ]);
        toastr()->success('Customer Added Successfully');
        return redirect()->route('admin.pos');
        }

    public function view_customer(){
        $view_customers = Customer::all();
        return view('allCustomer',compact('view_customers'));
    }

    public function edit_customer($id){
        $edit_customer = Customer::find($id);
        return view('edit_customer',compact('edit_customer'));
    }


    public function update_customer(UpdateCustomerRequest $request, $id){
        $validated_customer = $request->validated();

        // Handle the file upload
        if ($request->hasFile('customer_image')) {
            $image = $request->file('customer_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/customerPic');
            $image->move($destinationPath, $imageName);
            $validated_customer['customer_image'] = $imageName;
        }
        $customer = Customer::find($id);
        $update_customer = $customer->update([
            'cus_name' => $validated_customer['customer_name'],
            'cus_address' => $validated_customer['customer_address'],
            'cus_phone' => $validated_customer['customer_phone'],
            'cus_nid' => $validated_customer['customer_nid'],
            'cus_note' => $validated_customer['customer_note'],
            'cus_image' => $validated_customer['customer_image'] ?? $customer->cus_image,
        ]);
        toastr()->warning('Customer Updated Successfully');
        return redirect()->route('view.customer');
    }

    public function delete_customer($id){
        // Find the supplier
        $customer = Customer::find($id);
        
        if ($customer) {
            // Get the image path
            $image_path = public_path('customerPic/' . $customer->cus_image);
    
            // Delete the image file if it exists
            if (file_exists($image_path)) {
                unlink($image_path);
            }
    
            // Delete the supplier record from the database
            $customer ->delete();
    
            toastr()->success('Customer Deleted Successfully');
        } else {
            toastr()->error('Customer not found');
        }
    
        return redirect()->back();
    }
    //End for customer

    //Start For Point of sale(pos)
    public function POS(){
        $added_product = Add_cart::all();
        $pos_product = Product::Paginate(2);
        $customers = Customer::all();
        return view('pos',compact('pos_product','added_product','customers'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);

        Add_cart::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity
        ]);

        return response()->json(['message' => 'Product added to cart successfully']);
    }

    public function product_remove($id){
        $product_remove = Add_cart::find($id)->delete();
        return redirect()->back();
    }

    public function edit_pos($id){
        $product_edit = Add_cart::find($id);
        return view('edit_pos',compact('product_edit'));
    }


    public function update_pos(Request $request ,$id){

        $request -> validate([   
            'p_quantity' => 'nullable|min:1',
        ]);

        $update_pos = Add_cart::find($id);

        $update_pos = Add_cart::find($id)->update([
            'quantity' => $request->input('p_quantity')?? $update_pos->quantity,
        ]);
        toastr()->success('Quantity Updated Successfully');
        return redirect()->route('admin.pos');
    }

    public function transferCartToOrder(Request $request)
    {
        $customerId = $request->input('customer_id');
        $paymentMethod = $request->input('payment_method');
        $paidAmount = $request->input('paid_amount');
        $dueAmount = $request->input('due_amount');

        DB::transaction(function () use ($customerId,$paymentMethod,$paidAmount,$dueAmount) {
            $cartItems = Add_Cart::all();

            foreach ($cartItems as $item) {
                Order::create([
                    'products_id' => $item->product_id,
                    'customer_id' => $customerId, // Use the customer ID here
                    'quantity' => $item->quantity,
                    'payment_method' => $paymentMethod,
                    'paid_amount' => $paidAmount,
                    'due_amount' => $dueAmount,
                    
                ]);

                $item->delete();
            }
        });
        toastr()->success('Order Added Successfully');
        return redirect()->route('all.order');
    }

    //end for pos

    //start for ORDER

    public function all_order(){
        $all_order = Order::all();
        return view('order',compact('all_order'));
    }

    public function update_success($id) {
        $updateSuccess = Order::find($id)->update(['status' => 'Completed']);
        toastr()->success('Order Successfully Completed');  
        return redirect()->back();
    }

    public function delete_order($id){
        // Find the supplier
        $product = Order::find($id)->delete();
        toastr()->warning('Order Canceld'); 
        return redirect()->back();
    }

    public function print_order($id){
        
        $print_order = Order::where('customer_id',$id)->get();
        $pdf = PDF::loadView('print_pdf', compact('print_order'));
        return $pdf->download('invoice.pdf');
    } 
    //end for ORDER

    // start for EMPLOYEE
    public function employee(){
        return view('employee');
    }

    public function add_employee(EmployeeRequest $request){
    $employeeValidate = $request->validated();
    if ($request->hasFile('emp_image')) {
        $image = $request->file('emp_image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/employeePic');
        $image->move($destinationPath, $imageName);
        $employeeValidate['emp_image'] = $imageName;
    }
    $employee_add = employee::create([
        'name' => $employeeValidate['emp_name'],
        'father_name' => $employeeValidate['emp_fname'],
        'mother_name' => $employeeValidate['emp_mname'],
        'present_address' => $employeeValidate['emp_preaddress'],
        'permanent_address' => $employeeValidate['emp_peraddress'],
        'email' => $employeeValidate['emp_email'],
        'phone' => $employeeValidate['emp_phone'],
        'age' => $employeeValidate['emp_age'],
        'nid' => $employeeValidate['emp_nid'],
        'experience' => $employeeValidate['emp_experience'],
        'position' => $employeeValidate['emp_position'],
        'image' => $employeeValidate['emp_image'],
        'ssc' => $employeeValidate['ssc'],
        'hsc' => $employeeValidate['hsc'],
        'bba' => $employeeValidate['bba'],
        'salary' => $employeeValidate['emp_salary'],
        'joining_date' => $employeeValidate['emp_join'],
        'note' => $employeeValidate['emp_note'],
    ]);
    toastr()->success('Employee Added Successfully');
    return redirect()->route('employee');
}

    public function view_employees(){
        $all_employee = employee::all();
        return view('allEmployee',compact('all_employee'));
    }

    // public function detail_employee($id){
    //     $detail_employee = employee::find($id);
    //     return view('employee_detail',compact('detail_employee'));
    // }

    public function edit_employee($id){
        $edit_employee = employee::find($id);
        return view('edit_employee',compact('edit_employee'));
    }

    public function update_employee(UpdateEmployeeRequest $request, $id){
        $validated_employee = $request->validated();

        // Handle the file upload
        if ($request->hasFile('employee_image')) {
            $image = $request->file('employee_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/employeePic');
            $image->move($destinationPath, $imageName);
            $validated_employee['employee_image'] = $imageName;
        }
        $employees = employee::find($id);
        $update_employee = $employees->update([
            'name' => $validated_employee['emp_name'],
            'father_name' => $validated_employee['emp_fname'],
            'mother_name' => $validated_employee['emp_mname'],
            'present_address' => $validated_employee['emp_preaddress'],
            'permanent_address' => $validated_employee['emp_peraddress'],
            'email' => $validated_employee['emp_email'],
            'phone' => $validated_employee['emp_phone'],
            'age' => $validated_employee['emp_age'],
            'nid' => $validated_employee['emp_nid'],
            'experience' => $validated_employee['emp_experience'],
            'position' => $validated_employee['emp_position'],
            'ssc' => $validated_employee['ssc'],
            'hsc' => $validated_employee['hsc'],
            'bba' => $validated_employee['bba'],
            'salary' => $validated_employee['emp_salary'],
            'joining_date' => $validated_employee['emp_join'],
            'note' => $validated_employee['emp_note'],
            'image' => $validated_employee['employee_image'] ?? $employees->image,
        ]);
        toastr()->warning('Employee Updated Successfully');
        return redirect()->route('view.employees');
    }

    public function delete_employee($id){
        $delete_employee = employee::find($id)->delete();
        toastr()->success('Employee Removed');
        return redirect()->back();
    }

    // START FOR ATTENDANCE
    public function attendance(){
        $atten_employee = employee::all();
        return view('attendance',compact('atten_employee'));
    }


    public function take_attendance(Request $request){
    foreach ($request->employee_id as $key => $employee_id) {

        $attendanceExists = Attendance::where('employee_id', $employee_id)
            ->where('date', $request->date)
            ->exists();

        if ($attendanceExists) {
            return redirect()->back()->withErrors(['error' => 'Attendance for this date already exists for one or more employees.']);
        }


        Attendance::create([
            'employee_id' => $employee_id,
            'date' => $request->date,  // Changed 'Date' to 'date' for consistency
            'attendance' => $request->status[$key],
        ]);
    }
    return redirect()->back()->with('success', 'Attendance taken successfully.');
    }

    public function show_attendance(){
        $show_attendance =  Attendance::orderBy('Date', 'desc')->get();
        return view('show_attendance', compact('show_attendance'));
    }

    public function search_attendance(Request $request){
        $search = $request->search_date;
        $show_attendance = Attendance::where('Date','=',$search)->get();
        return view('show_attendance',compact('show_attendance'));
    }

    public function showemployeeDetails($id) {
        // Fetch employee information
        $detail_employee = Employee::find($id);
    
        // Fetch attendance data by year and month with counts of present and absent days
        $attendance = DB::table('attendances')
            ->select(
                DB::raw('YEAR(date) as year'),
                DB::raw('MONTH(date) as month'),
                DB::raw('COUNT(CASE WHEN attendance = "1" THEN 1 END) as days_present'), // Count of days present
                DB::raw('COUNT(CASE WHEN attendance = "0" THEN 1 END) as days_absent')  // Count of days absent
            )
            ->where('employee_id', $id)
            ->groupBy('year', 'month')
            // ->orderBy('year', 'desc')
            // ->orderBy('month', 'desc')
            ->get();
    
        return view('employee_detail', compact('detail_employee', 'attendance'));
    }
    
    //END FOR ATTENDANCE

    //START FOR SALARY--------------
    
    public function salary(){
        $emp_salary= employee::all();
        return view('salary',compact('emp_salary'));
    }
    
    
    



    






























































    

    

   

    
















}
