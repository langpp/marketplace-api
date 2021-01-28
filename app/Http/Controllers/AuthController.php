<?php

namespace App\Http\Controllers;
use App\Models\Users;
use Validator;
use Illuminate\Support\Facades\Hash;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Firebase\JWT\ExpiredException;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function jwt($id, $role)
    {
        $payload = [
            'iss' => "marketplace-api",     // Issuer of the token.
            'sub' => $id,               // Subject of the token.
            'iat' => time(),            // Time when JWT was issued. 
            'exp' => time() + 60*60*60,    // Expiration time.
            'role' => $role             // Role.
        ];
        
        /*
        |--------------------------------------------------------------------------
        | As you can see we are passing `JWT_SECRET` as the second parameter that
        | will be used to decode the token in the future.
        |--------------------------------------------------------------------------
        */

        return JWT::encode($payload, env('JWT_SECRET'));
    }

    public function login(Request $request)
    {
        $input  = $request->only("email", "password"); //Specify Request

        /*
        |--------------------------------------------------------------------------
        | Validation request.
        |--------------------------------------------------------------------------
        */

        $validation = Validator::make($input, [
            "email" => "required|string",
            "password" => "required|string|min:6",
        ]);

        if ($validation->fails()) {
            return response($validation->errors()->toJson(), 400);
        }

        /*
        |--------------------------------------------------------------------------
        | Find Emial.
        |--------------------------------------------------------------------------
        */

        $user = Users::where('email', $input['email'])->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => "Email does not exist."
            ], 400);
        }

        /*
        |--------------------------------------------------------------------------
        | Verify the password and generate the token.
        |--------------------------------------------------------------------------
        */

        if (Hash::check($input['password'], $user->password)) {
            return response()->json([
                'success' => true,
                'message' => "Login success.",
                'data'  => [
                    "email" => $user->email,
                    "username" => $user->username,
                    "role" => $user->role,
                    "no_telp" => $user->no_telp,
                    "id_user" => $user->id_user,
                ],
                'token' => $this->jwt($user->id_user, $user->role)
            ], 200);
        }

        /*
        |--------------------------------------------------------------------------
        | Bad Request response.
        |--------------------------------------------------------------------------
        */

        return response()->json([
            'success' => false,
            'message' => "Email or password is wrong."
        ], 400);
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|unique:users|max:255',
            'email' => 'required|max:255',
            'role' => 'required',
            'no_telp' => 'required',
            'password' => 'required|min:6'
        ]);
 
        $email = $request->input("email");
        $password = $request->input("password");
        $role = $request->input("role");
        $no_telp = $request->input("no_telp");
        $username = $request->input("username");
 
        $hashPwd = Hash::make($password);
 
        $data = [
            "email" => $email,
            "role" => $role,
            "no_telp" => $no_telp,
            "username" => $username,
            "password" => $hashPwd
        ];
        
 
        if (Users::create($data)) {
            $out = [
                "message" => "register_success",
                "code"    => 200,
                "data" => $data
            ];
        } else {
            $out = [
                "message" => "failed_register",
                "code"   => 401,
            ];
        }
 
        return response()->json($out, $out['code']);
    }

    public function allbuyer()
    {

        $user = Users::where("id_user", '1')->get();

        if ($user->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => "Data not found."
            ], 400);
        }
        return response()->json([
            'success' => true,
            'message' => "Data found.",
            'data' => $user
        ], 200);
    }
}
