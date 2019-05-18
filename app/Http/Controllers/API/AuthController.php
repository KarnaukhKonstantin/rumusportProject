<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'email'=>'required',
            'name'=>'required',
            'password'=>'required'
        ]);

        $user = User::firstOrNew(['email'=>$request->email]);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->save();
       // Auth::login($user);
        $http = new Client;

        $response = $http->post(url('oauth/token'), [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => '2',
                'client_secret' => '6tN0PVzdAID3XIp0HT4fZ3gWx0uB1cwBFScx5Seg',
                'username' => $request->email,
                'password' => $request->password,
                'scope' => '',
            ],
        ]);

        return response(['data'=>json_decode((string) $response->getBody(), true)]);

    }

    public function login(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);        

        $user = User::where('email', $request->email)->first();
        //Auth::login($user);
        if(!$user){
            return response(['status' => 'error', 'message' => 'User not found']);
        }

        if(Hash::check($request->password, $user->password)){
            $http = new Client;

            $response = $http->post(url('oauth/token'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => '2',
                    'client_secret' => '6tN0PVzdAID3XIp0HT4fZ3gWx0uB1cwBFScx5Seg',
                    'username' => $request->email,
                    'password' => $request->password,
                    'scope' => '',
                ],
            ]);
    
            return response(['data'=>json_decode((string) $response->getBody(), true)]);
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();       
    }

}
