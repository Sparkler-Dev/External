<?php

namespace App\Http\Controllers;

use App\Http\Resources\StoreFacebookAccessTokenResource;
use App\Models\StoreFacebookAccessToken;
use App\Models\StoreFacebookLongAccessToken;
use App\Models\StoreFacebookUserDetails;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GenerateFacebookTokenController extends Controller
{
    // GET ACCESS TOKEN
    public function generatetoken( Request $request)
    {
        
         if(auth('sanctum')->check()){

         $user_id = auth('sanctum')->user();
        //   return response()->json([
        //     $user_id,
        //   ],200);

        $client_id = env('CLIENT_ID');
        $code =  $request->code;
        $client_secret = env('CLIENT_SECRET');
        $redirect_uri = env('REDIRECT_URI');
        $php_curl = curl_init();

        curl_setopt_array($php_curl, array(
            CURLOPT_URL => "https://graph.facebook.com/v15.0/oauth/access_token?client_id=$client_id&redirect_uri=$redirect_uri&client_secret=$client_secret&code=$code",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 1000,

            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Laravel curl Requesred Headers
                'Content-Type: application/json',
            ),
        ));
        $final_results = curl_exec($php_curl);
        $err = curl_error($php_curl);
        $err = curl_error($php_curl);
        curl_close($php_curl);

        if ($err) {
            echo "Laravel cURL Error #:" . $err;
        } else {
             // GET THE RESULT AND RUN INSIDE A FOREACH LOOP
            foreach (json_decode($final_results) as $room_name => $room) {
                $token_data = @$room ;
                $error = @$room->message;

               return $this->StoreAccessToken($user_id, $token_data, $error, $request);
            }
        }


         }else{
            return response()->json([
             throw new NotFoundHttpException()   
            ],404);
         }
    }

       public function StoreAccessToken( $user_id, $token_data,  $error,  Request $request)
    {

        
         // IF ERROR RUN THIS LINE AND KILL THE FUNCTION
        if($error)  {
             return response()->json(['message' => $error], 400);
        }

        if($token_data){
            $task = StoreFacebookAccessToken::create([
          'user_id'=>  Auth::user()->id,
          'client_id'=> Auth::user()->client_id,
          'access_token'=>$token_data,
        ]);


        return $this->GenerateLongLifeAccessToken($task, $request);
        }

         
    }


    // GENERATE FACEBOOK LIFE LONG ACCESS TOKEN
    public function GenerateLongLifeAccessToken( $task, Request $request){


        $temp_token = StoreFacebookAccessToken::latest('id')->first();


         $grant_type = "fb_exchange_token";
         $client_id = env('CLIENT_ID');
         $client_secret = env('CLIENT_SECRET');
         $access_token = $temp_token->access_token;

        $product = new StoreFacebookLongAccessToken;
        $product->long_lived_access_token = $request->long_lived_access_token;
        $product->long_lived_access_token = $access_token;
        $products_data = [
            'grant_type' => $product->grant_type = "fb_exchange_token",
            'client_id' => $product->client_id = env('CLIENT_ID'),
            'client_secret' => $product->client_secret = env('CLIENT_SECRET'),
            'fb_exchange_token' => $access_token,
        ];
        // return print_r($products_data);
        $php_curl = curl_init();
        curl_setopt_array($php_curl, array(
            CURLOPT_URL => "https://graph.facebook.com/v6.0/oauth/access_token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 1000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($products_data),
            CURLOPT_HTTPHEADER => array(
                // Set POST here requred headers
                "accept: */*",
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
            ),
        ));

        $final_results = curl_exec($php_curl);
        $err = curl_error($php_curl);

        curl_close($php_curl);

        if ($err) {
            echo "Laravel cURL Error #:" . $err;
        } else {
            foreach (json_decode($final_results) as $room_name => $room) {
                $token_data = @$room ;
                return $this->StoreLongLifeAccessToken($token_data,  $request);
            }
            // return response()->json(['message' => 'Post added successfully'], 200);
        }
     


     }

     

     // STORE FACEBOOM LONG ACCESS LIFE TOKEN
     public function StoreLongLifeAccessToken($token_data,  $request){
            $user_id = auth('sanctum')->user();
            $store_long_lived_access_token = new StoreFacebookLongAccessToken; 
            $store_long_lived_access_token->client_id = $user_id->client_id;  
            $store_long_lived_access_token->user_id = $user_id->id;  
            $store_long_lived_access_token->long_lived_access_token = $token_data;    
            $store_long_lived_access_token->save();    
             return $this->facebook_userdetails($store_long_lived_access_token, $request);

     }
     // STORE FACEBOOK USER DETAILS
     public function facebook_userdetails($store_long_lived_access_token,  $request){
         $user_id = auth('sanctum')->user();
         $user_details = StoreFacebookLongAccessToken::where('client_id', $user_id->client_id)->first();

         $facebook_long_access_token = $user_details->long_lived_access_token;
        $php_curl = curl_init();

        curl_setopt_array($php_curl, array(
            CURLOPT_URL => "https://graph.facebook.com/v6.0/me?access_token=$facebook_long_access_token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 1000,

            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
            ),
        ));
        $final_results = curl_exec($php_curl);
        $err = curl_error($php_curl);
        $err = curl_error($php_curl);
        curl_close($php_curl);

        if ($err) {
            echo "Laravel cURL Error #:" . $err;
        } else {
            $user_id = auth('sanctum')->user();
            $fb_user_details = json_decode($final_results);
            $store_user_facebook_details = new StoreFacebookUserDetails; 
            $store_user_facebook_details->client_id  = $user_id->client_id;  
            $store_user_facebook_details->user_id = $user_id->id;    
            $store_user_facebook_details->facebook_username = $fb_user_details->name;    
            $store_user_facebook_details->	facebook_user_id = $fb_user_details->id;    
            $store_user_facebook_details->save();  
            return response()->json([
             'status'=>200,
              'user_details' => json_decode($final_results),

            ]);

        }

         

     }

         // GET FACEBOOK USER DETAILS
     public function get_facebook_userdetails(){
        $user_id = auth('sanctum')->user();
        $user_details = StoreFacebookUserDetails::where('client_id', $user_id->client_id)->first();
        
              return response()->json([
             'status'=>200,
              'message'=>"Account linked successfully",
              'facebook_user_details_table' => $user_details,

        ]);

     }

}
