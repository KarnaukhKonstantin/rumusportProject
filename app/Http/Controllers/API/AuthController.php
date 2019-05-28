<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;
use Auth;
use Carbon\Carbon;
use Validator;

class AuthController extends Controller
{
    // public function register(Request $request){
    //     $request->validate([
    //         'email'=>'required',
    //         'name'=>'required',
    //         'password'=>'required'
    //     ]);

    //     $user = User::firstOrNew(['email'=>$request->email]);
    //     $user->email = $request->email;
    //     $user->name = $request->name;
    //     $user->password = bcrypt($request->password);
    //     $user->save();
    //    // Auth::login($user);
    //     $http = new Client;

    //     $response = $http->post(url('oauth/token'), [
    //         'form_params' => [
    //             'grant_type' => 'password',
    //             'client_id' => '2',
    //             'client_secret' => '6tN0PVzdAID3XIp0HT4fZ3gWx0uB1cwBFScx5Seg',
    //             'username' => $request->email,
    //             'password' => $request->password,
    //             'scope' => '',
    //         ],
    //     ]);

    //     return response(['data'=>json_decode((string) $response->getBody(), true)]);

    // }

    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $user->save();
        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }


    public function login(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            
            return response()->json($validator->errors(), 417);
        }
        $credentials = $request->only(['email', 'password']);
        if (Auth::attempt($credentials)) {
            
            $user = Auth::user();
            $token = $user->createToken('MyApp')->accessToken;
            
            return response()->json(['token' => $token], 200);
        }
        else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    // public function login(Request $request){
    //     $request->validate([
    //         'email'=>'required',
    //         'password'=>'required'
    //     ]);        

    //     $user = User::where('email', $request->email)->first();
    //     //Auth::login($user);
    //     if(!$user){
    //         return response(['status' => 'error', 'message' => 'User not found']);
    //     }

    //     try{
    //         if(Hash::check($request->password, $user->password)){
    //         $http = new Client;

    //         $response = $http->post(url('oauth/token'), [
    //             'form_params' => [
    //                 'grant_type' => 'password',
    //                 'client_id' => env('PASSWORD_CLIENT_ID'),
    //                 'client_secret' => env('PASSWORD_CLIENT_SECRET'),
    //                 'username' => $request->email,
    //                 'password' => $request->password,
    //                 'scope' => '',
    //             ],
    //         ]);
    
    //         return response(['data'=>json_decode((string) $response->getBody(), true)]);
    //     }
    //         }catch (Exception $e) {
    //     return $e;
    //     }
        
    // }


    public function logout(Request $request)
    {
        Auth::logout();       
    }

}
