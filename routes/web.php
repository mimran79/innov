<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    $featuredProducts = Product::where('is_feature', true)->limit(3)->get();
    $recentProducts = Product::latest()->limit(3)->get();
    return view('welcome', compact('featuredProducts', 'recentProducts'));
})->name('welcome');

Route::get('/catalog', function () {
    $products = Product::all();
    return view('catalog', compact('products'));
})->name('catalog');
Route::get('/catalog/{id}', function ($id) {
    $product = Product::where('id', $id)->first();
    return view('product', compact('product'));
})->name('product.show');


// Client Routes
Route::middleware(['auth', 'verified', RoleMiddleware::class . ':client'])->group(function () {
    Route::get('/dashboard', function () {
        $orders = Order::orderBy('created_at', 'desc')->where('user_id', Auth::user()->id)->get();
        $totalSpent = Auth::user()->orders()->sum('total_amount');
        $budget = Auth::user()->budget;
        return view('dashboard', compact('orders', 'totalSpent', 'budget'));
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile', [ProfileController::class, 'setBudget'])->name('profile.budget');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Cart Routes
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart/reset', [CartController::class, 'reset'])->name('cart.reset');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/checkout', [CartController::class, 'store'])->name('cart.store');

    //Order Route Client View
    Route::get('/order/{id}', [OrderController::class, 'view'])->name('order.view');
});

// Admin Routes
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        $users = User::where('role', 'client')->count();
        $orders = Order::count();
        return view('admin.dashboard', compact('users', 'orders'));
    })->name('dashboard');
    //Product routes
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/products/deleted', [ProductController::class, 'deletedProducts'])->name('products.deleted');
    Route::post('/products/{product}/restore', [ProductController::class, 'restore'])->name('products.restore');

    //Clients routes
    Route::get('/clients', [UserController::class, 'index'])->name('clients.index');
    Route::get('/clients/deleted', [UserController::class, 'deletedClients'])->name('clients.deleted');
    Route::post('/clients/restore/{id}', [UserController::class, 'restoreClient'])->name('clients.restore');
    Route::get('/clients/{id}', [UserController::class, 'view'])->name('clients.view');
    Route::delete('/clients/delete/{id}', [UserController::class, 'deleteClient'])->name('clients.delete');
    //Orders routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/order/{id}', [OrderController::class, 'orderSummary'])->name('order.summary');
    Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

require __DIR__ . '/auth.php';
