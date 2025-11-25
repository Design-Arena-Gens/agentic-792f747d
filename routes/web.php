<?php
use App\Core\Router;
use App\Controllers\HomeController;
use App\Controllers\ProductController;
use App\Controllers\CartController;
use App\Controllers\CheckoutController;
use App\Controllers\BlogController;
use App\Controllers\Admin\AuthController as AdminAuth;
use App\Controllers\Admin\DashboardController as AdminDashboard;
use App\Controllers\Admin\ProductController as AdminProduct;
use App\Controllers\Admin\PostController as AdminPost;
use App\Controllers\Admin\OrderController as AdminOrder;

// Landing
$router->get('/', [HomeController::class, 'landing']);
$router->post('/lead', [HomeController::class, 'captureLead']);

// Brand root pages
$router->get('/shnikh', [HomeController::class, 'shnikhHome']);
$router->get('/cordygen', [HomeController::class, 'cordygenHome']);

// Static pages
$router->get('/shnikh/about', [HomeController::class, 'shnikhAbout']);
$router->get('/shnikh/services', [HomeController::class, 'shnikhServices']);
$router->get('/shnikh/products', [ProductController::class, 'listShnikh']);
$router->get('/shnikh/rnd', [HomeController::class, 'shnikhRnd']);
$router->get('/shnikh/blog', [BlogController::class, 'listShnikh']);
$router->get('/shnikh/blog/{slug}', [BlogController::class, 'detailShnikh']);
$router->get('/shnikh/contact', [HomeController::class, 'contactShnikh']);

$router->get('/cordygen/products', [ProductController::class, 'listCordygen']);
$router->get('/cordygen/product/{slug}', [ProductController::class, 'detailCordygen']);
$router->get('/cordygen/about', [HomeController::class, 'cordygenAbout']);
$router->get('/cordygen/science', [HomeController::class, 'cordygenScience']);
$router->get('/cordygen/blog', [BlogController::class, 'listCordygen']);
$router->get('/cordygen/blog/{slug}', [BlogController::class, 'detailCordygen']);
$router->get('/cordygen/faq', [HomeController::class, 'cordygenFaq']);
$router->get('/cordygen/contact', [HomeController::class, 'contactCordygen']);

// Cart and checkout
$router->post('/cart/add', [CartController::class, 'add']);
$router->post('/cart/remove', [CartController::class, 'remove']);
$router->get('/cart', [CartController::class, 'show']);
$router->get('/checkout', [CheckoutController::class, 'show']);
$router->post('/checkout/place', [CheckoutController::class, 'place']);
$router->post('/checkout/razorpay/verify', [CheckoutController::class, 'verifyRazorpay']);
$router->get('/order/track', [CheckoutController::class, 'trackForm']);
$router->post('/order/track', [CheckoutController::class, 'track']);

// Admin
$router->get('/admin/login', [AdminAuth::class, 'loginForm']);
$router->post('/admin/login', [AdminAuth::class, 'login']);
$router->get('/admin/logout', [AdminAuth::class, 'logout']);
$router->get('/admin', [AdminDashboard::class, 'index']);

$router->get('/admin/products', [AdminProduct::class, 'index']);
$router->get('/admin/products/create', [AdminProduct::class, 'create']);
$router->post('/admin/products', [AdminProduct::class, 'store']);
$router->get('/admin/products/{id}/edit', [AdminProduct::class, 'edit']);
$router->post('/admin/products/{id}', [AdminProduct::class, 'update']);
$router->post('/admin/products/{id}/delete', [AdminProduct::class, 'destroy']);

$router->get('/admin/posts', [AdminPost::class, 'index']);
$router->get('/admin/posts/create', [AdminPost::class, 'create']);
$router->post('/admin/posts', [AdminPost::class, 'store']);
$router->get('/admin/posts/{id}/edit', [AdminPost::class, 'edit']);
$router->post('/admin/posts/{id}', [AdminPost::class, 'update']);
$router->post('/admin/posts/{id}/delete', [AdminPost::class, 'destroy']);

$router->get('/admin/orders', [AdminOrder::class, 'index']);
$router->get('/admin/orders/{id}', [AdminOrder::class, 'show']);
$router->post('/admin/orders/{id}/status', [AdminOrder::class, 'updateStatus']);
