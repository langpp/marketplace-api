<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Support\Facades\Hash;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Firebase\JWT\ExpiredException;
use App\Models\Users;
use App\Models\Checkout;
use App\Http\Controllers\Midtrans\Config;
use App\Http\Controllers\Midtrans\Transaction;
use App\Http\Controllers\Midtrans\ApiRequestor;
use App\Http\Controllers\Midtrans\SnapApiRequestor;
use App\Http\Controllers\Midtrans\Notification;
use App\Http\Controllers\Midtrans\CoreApi;
use App\Http\Controllers\Midtrans\Snap;
use App\Http\Controllers\Midtrans\Sanitizer;


class MidtransController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    //
    public function getSnapToken(Request $request){

    	$input  = $request->only("id_produk", "id_user", "id_toko", "tanggal", "deskripsi", "total_barang", "harga", "status", "first_name", "last_name", "address", "city", "postal_code", "phone", "country_code", "barang"); //Specify Request

        $validation = Validator::make($input, [
            "id_produk" => "required|integer",
            "id_user" => "required|integer",
            "id_toko" => "required|integer",
            "tanggal" => "required|string",
            "deskripsi" => "required|string",
            "total_barang" => "required|integer",
            "harga" => "required|integer",
            "status" => "required|integer",
            "first_name" => "required|string",
            "last_name" => "required|string",
            "address" => "required|string",
            "city" => "required|string",
            "postal_code" => "required|string",
            "phone" => "required|string",
            "country_code" => "required|string",
            "barang" => "required|string",
        ]);

        if ($validation->fails()) {
            return response($validation->errors()->toJson(), 400);
        }
        $user = Users::where('id_user', $request->input("id_user"))->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => "Id User does not exist."
            ], 400);
        }


        $item_list = array();
        $order_id = rand();
        $amount = 0;
        Config::$serverKey = 'SB-Mid-server-VWyX4wAPyn8j4PZhsHgGuB_k';
        if (!isset(Config::$serverKey)) {
            return "Please set your payment server key";
        }
        Config::$isSanitized = true;

        // Enable 3D-Secure
        Config::$is3ds = true;
        
        // Required

         $item_list[] = [
                'id' => $request->input("id_produk"),
                'price' => $request->input("harga"),
                'quantity' => $request->input("total_barang"),
                'name' => $request->input("barang")
        ];

        $transaction_details = array(
            'order_id' => $order_id,
            'gross_amount' => $request->input("harga"), // no decimal allowed for creditcard
        );


        // Optional
        $item_details = $item_list;

        // Optional
        $billing_address = array(
            'first_name'    => $user->first_name,
            'last_name'     => $user->last_name,
            'address'       => $user->address,
            'city'          => $user->city,
            'postal_code'   => $user->postal_code,
            'phone'         => $user->phone,
            'country_code'  => $user->country_code
        );

        // Optional
        $shipping_address = array(
            'first_name'    => $request->input("first_name"),
            'last_name'     => $request->input("last_name"),
            'address'       => $request->input("address"),
            'city'          => $request->input("city"),
            'postal_code'   => $request->input("postal_code"),
            'phone'         => $request->input("phone"),
            'country_code'  => $request->input("country_code")
        );

        // Optional
        $customer_details = array(
            'first_name'    => $request->input("first_name"),
            'last_name'     => $request->input("last_name"),
            'email'         => $user->email,
            'phone'         => $request->input("phone"),
            'billing_address'  => $billing_address,
            'shipping_address' => $shipping_address
        );

        // Optional, remove this to display all available payment methods
        $enable_payments = array();

        // Fill transaction details
        $transaction = array(
            'enabled_payments' => $enable_payments,
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
        );
        // return $transaction;
       
        try {
            $snapToken = Snap::getSnapToken($transaction);
            $datacheckout = [
	            "id_produk" => $request->input("id_produk"),
	            "id_user" => $request->input("id_user"),
	            "id_toko" => $request->input("id_toko"),
	            "tanggal" => $request->input("tanggal"),
	            "deskripsi" => $request->input("deskripsi"),
	            "total_barang" => $request->input("total_barang"),
	            "harga" => $request->input("harga"),
	            "status" => $request->input("status"),
	            "first_name" => $request->input("first_name"),
	            "last_name" => $request->input("last_name"),
	            "address" => $request->input("address"),
	            "city" => $request->input("city"),
	            "postal_code" => $request->input("postal_code"),
	            "phone" => $request->input("phone"),
	            "country_code" => $request->input("country_code"),
	            "snaptoken" => $snapToken,
	            "order_id" => $order_id,
	        ];
        	Checkout::create($datacheckout);
            // return response()->json($snapToken);
            return ['code' => 1 , 'message' => 'success' , 'result' => $snapToken, "redirect_url" => "http://app.sandbox.midtrans.com/snap/v2/vtweb/".$snapToken];
        } catch (\Exception $e) {
            dd($e);
            return ['code' => 0 , 'message' => 'failed'];
        }

    }
}