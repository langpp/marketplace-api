<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use Validator;
use Illuminate\Support\Facades\Hash;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Firebase\JWT\ExpiredException;

class ProdukController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function produkbyid($id_produk)
    {
        $produk = Produk::where("id_produk", $id_produk)->get();

        if ($produk->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => "Data not found."
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => "Data found.",
            'data' => $produk
        ], 200);
    }

    public function produkbyidtoko($id_toko)
    {
        $produk = Produk::where("id_toko", $id_toko)->get();

        if ($produk->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => "Data not found."
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => "Data found.",
            'data' => $produk
        ], 200);
    }

    public function produkall()
    {

        $produk = Produk::all();

        if ($produk->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => "Data not found."
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => "Data found.",
            'data' => $produk
        ], 200);
    }

    public function create(Request $request){
        $input  = $request->only("nama_produk", "harga", "gambar", "id_toko", "user_beli", "gambar_lain"); //Specify Request

        /*
        |--------------------------------------------------------------------------
        | Validation request.
        |--------------------------------------------------------------------------
        */

        $validation = Validator::make($input, [
            "nama_produk" => "required|string|min:6",
            "harga" => "required|integer",
            "id_toko" => "required|string",
            "user_beli" => "required|string",
            "gambar" => "image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "gambar_lain" => "image|mimes:jpeg,png,jpg,gif,svg|max:2048",
        ]);

        if ($validation->fails()) {
            return response($validation->errors()->toJson(), 400);
        }

        /*
        |--------------------------------------------------------------------------
        | Image request upload.
        |--------------------------------------------------------------------------
        */

        $input['gambar'] = "";
        $input['gambar_lain'] = "";

        if ($request->hasFile('gambar')) {
            $file_ext = $request->file('gambar')->extension();                         // Get an extension of image.

            $destination_path = './uploads/produk/';                               // Define path.
            $image = 'produk-'.time().'.'.$file_ext;                                     // Make random new name of image.


            /*
            |--------------------------------------------------------------------------
            | Move the image to folder on server.
            |--------------------------------------------------------------------------
            */

            if (!$request->file('gambar')->move($destination_path, $image)) {
                return response()->json([
                    'success' => false,
                    'message' => "Cannot upload image."
                ], 400);
            }

            $input['gambar'] = $image;
        }

        if ($request->hasFile('gambar_lain')) {
            $file_ext = $request->file('gambar_lain')->extension();                         // Get an extension of image.

            $destination_path = './uploads/produk/';                               // Define path.
            $image = 'produk_lain-'.time().'.'.$file_ext;                                     // Make random new name of image.


            /*
            |--------------------------------------------------------------------------
            | Move the image to folder on server.
            |--------------------------------------------------------------------------
            */

            if (!$request->file('gambar_lain')->move($destination_path, $image)) {
                return response()->json([
                    'success' => false,
                    'message' => "Cannot upload image."
                ], 400);
            }

            $input['gambar_lain'] = $image;
        }

        $data = Produk::create($input);

        if ($data) {
            $message = "Data successfully created.";
        } else {
            $message = "Data failed created.";
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], 200);
    }

    public function update(Request $request){
        $input  = $request->only("nama_produk", "harga", "gambar", "user_beli", "gambar_lain", 'id_produk'); //Specify Request

        /*
        |--------------------------------------------------------------------------
        | Validation request.
        |--------------------------------------------------------------------------
        */

        $validation = Validator::make($input, [
            "nama_produk" => "required|string|min:6",
            "harga" => "required|integer",
            "user_beli" => "required|string",
            "gambar" => "image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "gambar_lain" => "image|mimes:jpeg,png,jpg,gif,svg|max:2048",
        ]);
        $id_produk = $request->input("id_produk");
        if ($validation->fails()) {
            return response($validation->errors()->toJson(), 400);
        }

        /*
        |--------------------------------------------------------------------------
        | Image request upload.
        |--------------------------------------------------------------------------
        */

        $input['gambar'] = "";
        $input['gambar_lain'] = "";

        if ($request->hasFile('gambar')) {
            $file_ext = $request->file('gambar')->extension();                         // Get an extension of image.

            $destination_path = './uploads/produk/';                               // Define path.
            $image = 'produk-'.time().'.'.$file_ext;                                     // Make random new name of image.


            /*
            |--------------------------------------------------------------------------
            | Move the image to folder on server.
            |--------------------------------------------------------------------------
            */

            if (!$request->file('gambar')->move($destination_path, $image)) {
                return response()->json([
                    'success' => false,
                    'message' => "Cannot upload image."
                ], 400);
            }

            $input['gambar'] = $image;
        }

        if ($request->hasFile('gambar_lain')) {
            $file_ext = $request->file('gambar_lain')->extension();                         // Get an extension of image.

            $destination_path = './uploads/produk/';                               // Define path.
            $image = 'produk_lain-'.time().'.'.$file_ext;                                     // Make random new name of image.


            /*
            |--------------------------------------------------------------------------
            | Move the image to folder on server.
            |--------------------------------------------------------------------------
            */

            if (!$request->file('gambar_lain')->move($destination_path, $image)) {
                return response()->json([
                    'success' => false,
                    'message' => "Cannot upload image."
                ], 400);
            }

            $input['gambar_lain'] = $image;
        }


        $data = Produk::where("id_produk", $id_produk)->update($input);

        if ($data) {
            $message = "Data successfully updated.";
        } else {
            $message = "Data failed updated.";
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], 200);
    }

    public function delete(Request $request)
    {
        $delete = Produk::where('id_produk', $request->id_produk)->delete();

        return response()->json([
            'success' => true,
            'message' => "Data successfully deleted.",
        ], 200);
    }

    public function find(Request $request)
    {
        $carian = $request->keyword;
        $find = Produk::where('nama_produk', 'like',"%".$carian."%")->orderby('id_produk', 'DESC')->get();
        if ($find->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => "Data not found."
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => "Data found.",
            'data' => $find
        ], 200);
    }
}
