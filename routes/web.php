<?php

use App\Exports\AttendanceExport;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


//route for category
route::get('/product-category',[AdminController::class,'category'])->middleware(['auth'])->name('admin.category');
route::post('/add-category',[AdminController::class,'add_category'])->middleware(['auth'])->name('add.category');
route::get('/edit-category/{id}',[AdminController::class,'edit_category'])->middleware(['auth'])->name('edit.category');
route::post('/update-category/{id}',[AdminController::class,'update_category'])->middleware(['auth'])->name('update.category');
route::delete('/remove-category/{id}',[AdminController::class,'remove_category'])->middleware(['auth'])->name('remove.category');

//route for suppliers
route::get('/suppliers',[AdminController::class,'supplier'])->middleware(['auth'])->name('supplier');
route::post('/add-suppliers',[AdminController::class,'add_supplier'])->middleware(['auth'])->name('add.supplier');
route::get('/view-suppliers',[AdminController::class,'view_supplier'])->middleware(['auth'])->name('view.supplier');
route::get('/edit-suppliers/{id}',[AdminController::class,'edit_supplier'])->middleware(['auth'])->name('edit.supplier');
route::post('/update-suppliers/{id}',[AdminController::class,'update_supplier'])->middleware(['auth'])->name('update.supplier');
route::delete('/delete-suppliers/{id}',[AdminController::class,'delete_supplier'])->middleware(['auth'])->name('delete.supplier');

//route for Products
route::get('/product',[AdminController::class,'product'])->middleware(['auth'])->name('product');
route::post('/add-products',[AdminController::class,'add_product'])->middleware(['auth'])->name('add.product');
route::get('/view-products',[AdminController::class,'view_product'])->middleware(['auth'])->name('view.product');
route::get('/edit-product/{id}',[AdminController::class,'edit_product'])->middleware(['auth'])->name('edit.product');
route::post('/update-product/{id}',[AdminController::class,'update_product'])->middleware(['auth'])->name('update.product');
route::delete('/delete-product/{id}',[AdminController::class,'delete_product'])->middleware(['auth'])->name('delete.product');

//route for customer
route::get('/customer',[AdminController::class,'customer'])->middleware(['auth'])->name('customer');
route::post('/add-customer',[AdminController::class,'add_customer'])->middleware(['auth'])->name('add.customer');
route::get('/view-customers',[AdminController::class,'view_customer'])->middleware(['auth'])->name('view.customer');
route::get('/edit-customers/{id}',[AdminController::class,'edit_customer'])->middleware(['auth'])->name('edit.customer');
route::post('/update-customer/{id}',[AdminController::class,'update_customer'])->middleware(['auth'])->name('update.customer');
route::delete('/delete-customer/{id}',[AdminController::class,'delete_customer'])->middleware(['auth'])->name('delete.customer');

//route for point of sale(pos)
route::get('/pos',[AdminController::class,'POS'])->middleware(['auth'])->name('admin.pos');
route::post('/cart/add',[AdminController::class,'add'])->middleware(['auth'])->name('cart.add');
route::get('/product-remove/{id}',[AdminController::class,'product_remove'])->middleware(['auth'])->name('product.remove');
route::get('/edit_pos/{id}',[AdminController::class,'edit_pos'])->middleware(['auth'])->name('edit.pos');
route::post('/update-pos/{id}',[AdminController::class,'update_pos'])->middleware(['auth'])->name('update.pos');
Route::post('/transfer-cart-to-order', [AdminController::class, 'transferCartToOrder'])->name('cart.transfer');

//route for ORDER
route::get('/all-order',[AdminController::class,'all_order'])->middleware(['auth'])->name('all.order');
route::get('/update-success/{id}',[AdminController::class,'update_success'])->middleware(['auth'])->name('update.success');
route::delete('/delete-order/{id}',[AdminController::class,'delete_order'])->middleware(['auth'])->name('delete.order');
route::get('/print-invoice/{id}',[AdminController::class,'print_order'])->middleware(['auth'])->name('print.order');

//route for EMPLOYEE
route::get('/employee',[AdminController::class,'employee'])->middleware(['auth'])->name('employee');
route::post('/add-employee',[AdminController::class,'add_employee'])->middleware(['auth'])->name('add.employee');
route::get('/view-employees',[AdminController::class,'view_employees'])->middleware(['auth'])->name('view.employees');
// route::get('/detail-employee/{id}',[AdminController::class,'detail_employee'])->middleware(['auth'])->name('detail.employee');
route::get('/edit-employee/{id}',[AdminController::class,'edit_employee'])->middleware(['auth'])->name('edit.employee');
route::post('/update-employee/{id}',[AdminController::class,'update_employee'])->middleware(['auth'])->name('update.employee');
route::delete('/delete-employee/{id}',[AdminController::class,'delete_employee'])->middleware(['auth'])->name('delete.employee');

//route for ATTENDANCE
route::get('/attendance',[AdminController::class,'attendance'])->middleware(['auth'])->name('attendance');
route::post('/take-attendance',[AdminController::class,'take_attendance'])->middleware(['auth'])->name('take.attendance');
route::get('/show-attendance',[AdminController::class,'show_attendance'])->middleware(['auth'])->name('show.attendance');
route::get('/search-attendance',[AdminController::class,'search_attendance'])->middleware(['auth'])->name('search.attendance');
// Route::get('export-attendance', function () {
//     return Excel::download(new AttendanceExport, 'attendance.xlsx');
// });
// Route::get('/student/{id}/details', [StudentController::class, 'showStudentDetails']);
route::get('/employee/{id}',[AdminController::class,'showemployeeDetails'])->middleware(['auth'])->name('detail.employee');

//route for SALARY
route::get('/salary',[AdminController::class,'salary'])->middleware(['auth'])->name('salary');
























route::get('/details-employee',[AdminController::class,'oneEmployee'])->middleware(['auth'])->name('one.mployee');
//route::get('/salary',[AdminController::class,'salary'])->middleware(['auth'])->name('salary');
