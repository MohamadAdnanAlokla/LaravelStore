<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SystemSettingsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\VariationController;
use App\Http\Controllers\DeliveryUserController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\DiscountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/shop/detail', [HomeController::class, 'detail'])->name('detail');
Route::get('/cart', [HomeController::class, 'cart'])->name('cart');
Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/loginshow', [HomeController::class, 'showLogin'])->name('loginshow');
Route::get('/registershow', [HomeController::class, 'showRegister'])->name('registershow');



Route::post('/login_submit', [AuthController::class, 'login'])->name('login_submit');
Route::post('/register_submit', [AuthController::class, 'register'])->name('register_submit');
Route::post('/logout_submit', [AuthController::class, 'logout'])->name('logout_submit');


Route::group(['middleware' => ['auth', 'checkAdminRole']], function () {

Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard')->middleware('auth');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index')->middleware('auth');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create')->middleware('auth');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store')->middleware('auth');
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit')->middleware('auth');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update')->middleware('auth');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy')->middleware('auth');

Route::get('/products', [ProductController::class, 'index'])->name('products.index')->middleware('auth');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create')->middleware('auth');
Route::post('/products', [ProductController::class, 'store'])->name('products.store')->middleware('auth');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit')->middleware('auth');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update')->middleware('auth');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy')->middleware('auth');


Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware('auth');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create')->middleware('auth');
Route::post('/users', [UserController::class, 'store'])->name('users.store')->middleware('auth');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('auth');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update')->middleware('auth');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('auth');

Route::get('/delivery-users', [DeliveryUserController::class, 'index'])->name('delivery-users.index')->middleware('auth');
Route::get('/delivery-users/create', [DeliveryUserController::class, 'create'])->name('delivery-users.create')->middleware('auth');
Route::post('/delivery-users', [DeliveryUserController::class, 'store'])->name('delivery-users.store')->middleware('auth');
Route::get('/delivery-users/{user}/edit', [DeliveryUserController::class, 'edit'])->name('delivery-users.edit')->middleware('auth');
Route::put('/delivery-users/{user}', [DeliveryUserController::class, 'update'])->name('delivery-users.update')->middleware('auth');
Route::delete('/delivery-users/{user}', [DeliveryUserController::class, 'destroy'])->name('delivery-users.destroy')->middleware('auth');




Route::get('/system-settings', [SystemSettingsController::class, 'index'])->name('system_settings.index')->middleware('auth');
Route::post('/system-settings', [SystemSettingsController::class, 'store'])->name('system_settings.store')->middleware('auth');
Route::put('/system-settings', [SystemSettingsController::class, 'update'])->name('system_settings.update')->middleware('auth');
Route::delete('/system-settings', [SystemSettingsController::class, 'destroy'])->name('system_settings.destroy');
Route::get('/colors/create', [ColorController::class, 'create'])->name('colors.create')->middleware('auth');
Route::post('/colors', [ColorController::class, 'store'])->name('colors.store')->middleware('auth');
Route::delete('/colors/{color}', [ColorController::class, 'delete'])->name('colors.delete')->middleware('auth');
Route::get('/colors', function () {
    $colors = App\Models\Color::all();
    $setting = App\Models\SystemSettings::first();
    return view('admin.colors', compact('colors','setting'));
})->name('colors.index')->middleware('auth');


Route::get('/variations/create', [VariationController::class, 'create'])->name('variations.create')->middleware('auth');
Route::post('/variations', [VariationController::class, 'store'])->name('variations.store')->middleware('auth');
Route::get('/variations/{variation}/edit', [VariationController::class, 'edit'])->name('variations.edit')->middleware('auth');
Route::put('/variations/{variation}', [VariationController::class, 'update'])->name('variations.update')->middleware('auth');
Route::delete('/variations/{variation}', [VariationController::class, 'delete'])->name('variations.delete')->middleware('auth');


    // عرض نموذج إنشاء طلب جديد
    Route::get('/create', [OrderController::class,'index'])->name('orders.create');
    Route::post('/updateDriver/{id}', [OrderController::class, 'updateDriver'])->name('updateDriver');
    Route::put('/updateStatus/{id}', [OrderController::class, 'updateStatus'])->name('updateStatus');
    Route::delete('/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
    Route::get('orders.show/{id}', [OrderController::class,'show'])->name('orders.show');

    Route::get('/Reviews.show', [ReviewController::class, 'showReviewProducts'])->name('Reviews.show');
    Route::get('/product.details/{productId}', [ReviewController::class, 'showProductWithReviews'])->name('product.details');
    Route::post('/addComment', [ReviewController::class, 'addComment'])->name('addComment');
 
  
   
Route::get('/discounts', [DiscountController::class, 'index'])->name('discounts.index');
Route::post('/add-discount', [DiscountController::class, 'addDiscount'])->name('addDiscount');
Route::post('/remove-discount', [DiscountController::class, 'removeDiscount'])->name('removeDiscount');



});

// Route لعرض الصفحة الرئيسية للمستخدم العادي

Route::get('/user_dashboard', [UserDashboardController::class, 'index'])->name('user_dashboard')->middleware('auth');
Route::get('/user_order', [UserDashboardController::class, 'order'])->name('user_order')->middleware('auth');
Route::post('/add_to_cart', [UserDashboardController::class, 'addToCart'])->middleware('auth');
Route::get('/cartshow', [UserDashboardController::class, 'showCart'])->name('cart.show')->middleware('auth');
Route::post('/confirm_purchase', [UserDashboardController::class, 'confirmPurchase'])->name('confirm_purchase')->middleware('auth');
Route::get('/showOrders', [UserDashboardController::class, 'showOrders'])->name('showOrders')->middleware('auth');
Route::get('/orders/pdf/{orderId}', [UserDashboardController::class, 'generatePDF'])->name('generatePDF')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
