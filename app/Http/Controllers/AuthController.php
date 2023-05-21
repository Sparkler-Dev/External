<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;

     public function login(LoginUserRequest $request)
    {
        $request->validated($request->only(['email', 'password']));

        if(!Auth::attempt($request->only(['email', 'password']))) {
            return $this->error('', 'Credentials do not match', 401);
        }

        $user = User::where('email', $request->email)->first();

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token')->plainTextToken
        ]);
    }

     public function generate_clientID(){
        //User Registration
        $client_id = mt_rand(10000000000000,99999999999999);
        $timeparse = Carbon::now()->format('Ymdhms');
        return $client_id + intval($timeparse);
        // return $client_id;
    }

    public function register(StoreUserRequest $request){

        $client_id = $this->generate_clientID();

        // return response()->json([
        //     $client_id,

        // ], 200);
      
       $request->validated($request->all());
       $user = User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'client_id'=>$client_id,
        'password'=> Hash::make($request->password)
       ]);

       return $this->success([
         'user'=>$user,
         'token'=>$user->createToken('API Token of'. $user->name)->plainTextToken
       ]);
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();

        return $this->success([
            'message' => 'You have succesfully been logged out and your token has been removed'
        ]);
    }
}
