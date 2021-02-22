<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Global Routes
|--------------------------------------------------------------------------
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post("/login", "AuthController@login");
$router->post("/register", "AuthController@register");
$router->get("/allbuyer", "AuthController@allbuyer");

$router->get("/toko/{id_toko}", "TokoController@tokobyid");
$router->get("/toko", "TokoController@tokoall");
$router->group(["prefix" => "toko", "middleware" => ["jwtadmin.auth"]], function() use ($router){
	$router->post("/add", "TokoController@create");
	$router->post("/update", "TokoController@update");
});

$router->get("/produk/{id_produk}", "ProdukController@produkbyid");
$router->get("/produk/toko/{id_toko}", "ProdukController@produkbyidtoko");
$router->get("/produk", "ProdukController@produkall");
$router->get("/findproduk", "ProdukController@find");

$router->group(["prefix" => "produk", "middleware" => ["jwtadmin.auth"]], function() use ($router){
	$router->post("/add", "ProdukController@create");
	$router->post("/update", "ProdukController@update");
	$router->delete("/delete", "ProdukController@delete");
});

$router->get("/checkout/toko/{id_toko}", "CheckoutController@checkoutbyidtoko");
$router->get("/checkout/produk/{id_produk}", "CheckoutController@checkoutbyidproduk");
$router->get("/checkout/user/{id_user}", "CheckoutController@checkoutbyiduser");
$router->get("/checkout/{id_checkout}", "CheckoutController@checkoutbyid");

$router->group(["prefix" => "checkout", "middleware" => ["jwtadmin.auth"]], function() use ($router){
	$router->post("/add", "CheckoutController@create");
	$router->post("/update", "CheckoutController@update");
	$router->delete("/delete", "CheckoutController@delete");
});

$router->group(["prefix" => "payment", "middleware" => ["jwtadmin.auth"]], function() use ($router){
	$router->post("/midtrans", "MidtransController@getSnapToken");
});