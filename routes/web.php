<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\productController;
use App\Http\Controllers\rowMaterialController;
use App\Http\Controllers\productionDetailController;
use App\Http\Controllers\customerController;
use App\Http\Controllers\orderController;
use App\Http\Controllers\saleController;
use App\Http\Controllers\DailyTaskController;





Route::get('/', function () {
    return view('first_page');
})->name('first_page');

Route::middleware(['middleware' => 'PrevenBackHistory'])->group(function(){
    Auth::routes();
});



// Admin routes
Route::group(['prefix' => 'admin', 'middleware' => ['isAdmin', 'auth', 'PrevenBackHistory']], function () {
    Route::get('index', [AdminController::class, 'index'])->name('admin.index');
    Route::get('profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('settings', [AdminController::class, 'settings'])->name('admin.settings');
    // catagory routes
    Route::get('category-show', [categoryController::class, 'show'])->name('category-show');
    Route::get('category-add', [categoryController::class, 'add'])->name('category-add');
    Route::post('addCategory', [categoryController::class, 'addCategory'])->name('addCategory');
    Route::get('/categoryDelete/{cat_id}', [categoryController::class , 'categoryDelete'])->name('categoryDelete');
    Route::get('/categoryEdit/{cat_id}', [categoryController::class , 'categoryEdit'])->name('categoryEdit');
    Route::post('EditCategory', [categoryController::class, 'EditCategory'])->name('EditCategory');
    Route::get('/search/categories', [CategoryController::class, 'search'])->name('search.categories');
    // product routes
    Route::get('product-show', [productController::class, 'show'])->name('product-show');
    Route::get('product-add', [productController::class, 'add'])->name('product-add');
    Route::post('addProduct', [productController::class, 'addProduct'])->name('addProduct');
    Route::get('/productDelete/{product_id}', [productController::class , 'productDelete'])->name('productDelete');
    Route::get('/productEdit/{product_id}', [productController::class , 'productEdit'])->name('productEdit');
    Route::post('EditProduct', [productController::class, 'EditProduct'])->name('EditProduct');
    Route::get('/search/products', [productController::class, 'search'])->name('search.products');
    Route::post('product/addStockproduct/{product_id}', [productController::class, 'addStockproduct'])->name('product.addStockproduct');
  
    // row Material routes
    Route::get('row_materail-show', [rowMaterialController::class, 'show'])->name('row_materail-show');
    Route::get('row_material-add', [rowMaterialController::class, 'add'])->name('row_material-add');
    Route::post('addRow_material', [rowMaterialController::class, 'addRow_material'])->name('addRow_material');
    Route::get('/row_materialDelete/{row_material_id}', [rowMaterialController::class , 'row_materialDelete'])->name('row_materialDelete');
    Route::get('/row_materialEdit/{row_material_id}', [rowMaterialController::class , 'row_materialEdit'])->name('row_materialEdit');
    Route::post('EditRow_material', [rowMaterialController::class, 'EditRow_material'])->name('EditRow_material');
    Route::get('/search/row_materials', [rowMaterialController::class, 'search'])->name('search.row_materails');
    Route::post('row_material/addStock/{row_material_id}', [rowMaterialController::class, 'addStock'])->name('row_material.addStock');
    // row production details routes  production_detail
    Route::get('production_detail-show', [productionDetailController::class, 'show'])->name('production_detail-show');
    Route::get('production_detail-add', [productionDetailController::class, 'add'])->name('production_detail-add');
    Route::post('addProduction_detail', [productionDetailController::class, 'addProduction_detail'])->name('addProduction_detail');
    Route::get('/production_detailDelete/{production_detail_id}', [productionDetailController::class , 'production_detailDelete'])->name('production_detailDelete');
    Route::get('/production_detailEdit/{production_detail_id}', [productionDetailController::class , 'production_detailEdit'])->name('production_detailEdit');
    Route::get('/search/production_details', [productionDetailController::class, 'search'])->name('search.production_details');
    Route::put('/production_detailEdit/{production_detail_id}', [productionDetailController::class, 'EditProduction_detail'])->name('EditProduction_detail');
    
    // row customer  routes  
    Route::get('customer-show', [customerController::class, 'show'])->name('customer-show');
    Route::get('customer-add', [customerController::class, 'add'])->name('customer-add');
    Route::post('addCustomer', [customerController::class, 'addCustomer'])->name('addCustomer');
    Route::get('/customerDelete/{customer_id}', [customerController::class , 'customerDelete'])->name('customerDelete');
    Route::get('/customerEdit/{customer_id}', [customerController::class , 'customerEdit'])->name('customerEdit');
    Route::post('EditCustomer', [customerController::class, 'EditCustomer'])->name('EditCustomer');
    Route::get('/search/customers', [customerController::class, 'search'])->name('search.customers');
   
 // Order routes  
Route::get('order-show', [orderController::class, 'show'])->name('order-show');
Route::get('order-add', [orderController::class, 'add'])->name('order-add');
Route::post('addOrder', [orderController::class, 'addOrder'])->name('addOrder');
Route::get('/orderDelete/{order_id}', [orderController::class, 'orderDelete'])->name('orderDelete');
Route::get('/orderEdit/{order_id}', [orderController::class, 'orderEdit'])->name('orderEdit');
Route::put('/orderEdit/{order_id}', [orderController::class, 'updateOrder'])->name('updateOrder'); // Use PUT for updates
Route::get('/search/orders', [orderController::class, 'search'])->name('search.orders');
Route::patch('/order/updateStatus/{id}', [orderController::class, 'updateStatus'])->name('order.updateStatus');


// sale route:
Route::get('sale-show', [saleController::class, 'show'])->name('sale-show');



Route::get('sale/cancel/{sale_id}', [SaleController::class, 'cancelSale'])->name('sale.cancel');
Route::post('sale/cancel/{sale_id}', [SaleController::class, 'cancelSale'])->name('sale.cancel');

// Daily Task Routes
Route::get('dailyTask-show', [DailyTaskController::class, 'show'])->name('dailyTask-show'); // Show all daily tasks
Route::get('daily-tasks/create', [DailyTaskController::class, 'create'])->name('daily-tasks.create'); // Show form to create a new task

});


// User routes

Route::group(['prefix' => 'user', 'middleware' => ['isUser', 'auth', 'PrevenBackHistory']], function () {
    Route::get('index', [UserController::class, 'index'])->name('user.index');
    Route::get('dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/profile', [HomeController::class, 'profile'])->name('user.profile');
}); 





    Route::get('/welcome', [HomeController::class, 'showExamPage'])->name('welcome');




 









