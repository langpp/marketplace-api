<?php

namespace App\Http\Controllers;
use App\Models\Toko;
use Validator;
use Illuminate\Support\Facades\Hash;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Firebase\JWT\ExpiredException;

class TokoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function tokobyid($id_toko)
    {
        $toko = Toko::where("id_toko", $id_toko)->get();

        if ($toko->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => "Data not found."
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => "Data found.",
            'data' => $toko
        ], 200);
    }

    public function tokoall()
    {

        $toko = Toko::all();

        if ($toko->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => "Data not found."
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => "Data found.",
            'data' => $toko
        ], 200);
    }

    public function create(Request $request){
        $input  = $request->only("nama_toko", "deskripsi", "id_user", "logo", "background"); //Specify Request

        /*
        |--------------------------------------------------------------------------
        | Validation request.
        |--------------------------------------------------------------------------
        */

        $validation = Validator::make($input, [
            "nama_toko" => "required|string|min:6",
            "deskripsi" => "required|string",
            "id_user" => "required|integer",
            "logo" => "image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "background" => "image|mimes:jpeg,png,jpg,gif,svg|max:2048",
        ]);

        if ($validation->fails()) {
            return response($validation->errors()->toJson(), 400);
        }

        /*
        |--------------------------------------------------------------------------
        | Image request upload.
        |--------------------------------------------------------------------------
        */

        $input['logo'] = "";
        $input['background'] = "";

        if ($request->hasFile('logo')) {
            $file_ext = $request->file('logo')->extension();                         // Get an extension of image.

            $destination_path = './uploads/toko/';                               // Define path.
            $image = 'logo-'.time().'.'.$file_ext;                                     // Make random new name of image.


            /*
            |--------------------------------------------------------------------------
            | Move the image to folder on server.
            |--------------------------------------------------------------------------
            */

            if (!$request->file('logo')->move($destination_path, $image)) {
                return response()->json([
                    'success' => false,
                    'message' => "Cannot upload image."
                ], 400);
            }

            $input['logo'] = $image;
        }

        if ($request->hasFile('background')) {
            $file_ext = $request->file('background')->extension();                         // Get an extension of image.

            $destination_path = './uploads/toko/';                               // Define path.
            $image = 'background-'.time().'.'.$file_ext;                                     // Make random new name of image.


            /*
            |--------------------------------------------------------------------------
            | Move the image to folder on server.
            |--------------------------------------------------------------------------
            */

            if (!$request->file('background')->move($destination_path, $image)) {
                return response()->json([
                    'success' => false,
                    'message' => "Cannot upload image."
                ], 400);
            }

            $input['background'] = $image;
        }

        /*
        |--------------------------------------------------------------------------
        | Add data or update data sekolah.
        |--------------------------------------------------------------------------
        */

        $data = Toko::create($input);

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
        $input  = $request->only("nama_toko", "deskripsi", "id_toko", "logo", "background"); //Specify Request

        /*
        |--------------------------------------------------------------------------
        | Validation request.
        |--------------------------------------------------------------------------
        */

        $validation = Validator::make($input, [
            "nama_toko" => "required|string|min:6",
            "deskripsi" => "required|string",
            "logo" => "image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "background" => "image|mimes:jpeg,png,jpg,gif,svg|max:2048",
        ]);
        $id_toko = $request->input("id_toko");
        if ($validation->fails()) {
            return response($validation->errors()->toJson(), 400);
        }

        /*
        |--------------------------------------------------------------------------
        | Image request upload.
        |--------------------------------------------------------------------------
        */

        $input['logo'] = "";
        $input['background'] = "";

        if ($request->hasFile('logo')) {
            $file_ext = $request->file('logo')->extension();                         // Get an extension of image.

            $destination_path = './uploads/toko/';                               // Define path.
            $image = 'logo-'.time().'.'.$file_ext;                                     // Make random new name of image.


            /*
            |--------------------------------------------------------------------------
            | Move the image to folder on server.
            |--------------------------------------------------------------------------
            */

            if (!$request->file('logo')->move($destination_path, $image)) {
                return response()->json([
                    'success' => false,
                    'message' => "Cannot upload image."
                ], 400);
            }

            $input['logo'] = $image;
        }

        if ($request->hasFile('background')) {
            $file_ext = $request->file('background')->extension();                         // Get an extension of image.

            $destination_path = './uploads/toko/';                               // Define path.
            $image = 'background-'.time().'.'.$file_ext;                                     // Make random new name of image.


            /*
            |--------------------------------------------------------------------------
            | Move the image to folder on server.
            |--------------------------------------------------------------------------
            */

            if (!$request->file('background')->move($destination_path, $image)) {
                return response()->json([
                    'success' => false,
                    'message' => "Cannot upload image."
                ], 400);
            }

            $input['background'] = $image;
        }

        /*
        |--------------------------------------------------------------------------
        | Add data or update data sekolah.
        |--------------------------------------------------------------------------
        */

        $data = Toko::where("id_toko", $id_toko)->update($input);

        if ($data) {
            $message = "Data successfully updated.";
        } else {
            $message = "Data failed updated.";
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $input,
        ], 200);
    }

}