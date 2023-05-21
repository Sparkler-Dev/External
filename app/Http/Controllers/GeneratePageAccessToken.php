<?php

namespace App\Http\Controllers;

use App\Models\StoreFacebookAccessToken;
use Illuminate\Http\Request;

class GeneratePageAccessToken extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {  
        $facebook_long_access_token = StoreFacebookAccessToken::latest('id')->first();

        // return response()->json([
        //     "info" => $facebook_long_access_token 
        // ]);

        $long_lived_access_token = $facebook_long_access_token->access_token;
        $php_curl = curl_init();

        curl_setopt_array($php_curl, array(
            CURLOPT_URL => "https://graph.facebook.com/v6.0/me?access_token=$long_lived_access_token",
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
                $user_info = @$room;
                $error = @$room->message;


            //    return response()->json([
            //      "user_page_info"=> json_decode($final_results)
            //    ],200);
            }
        }

         $user_page_info = json_decode($final_results);

          return $this->store( $user_page_info, $facebook_long_access_token, $request);
         
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($user_page_info, $facebook_long_access_token, $request)
    {


        //    return response()->json([
        //      'user_info' => $user_page_info,
        //      "facebook_long_access_token" => $facebook_long_access_token
        //  ]);

           $client_id = env('CLIENT_ID');
        $code =  $request->code;
        $client_secret = env('CLIENT_SECRET');
        $redirect_uri = env('REDIRECT_URI');
        $user_page_info_id = $user_page_info->id;
        $facebook_long_access_token = $facebook_long_access_token->access_token;
        $php_curl = curl_init();

        curl_setopt_array($php_curl, array(
            CURLOPT_URL => "https://graph.facebook.com/$user_page_info_id/accounts?access_token=$facebook_long_access_token",
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
                $token_data = @$room;
                $error = @$room->message;
                // PASS THE RESULT AS A PARAMETER TO A NEW FUNCTION
                // return $this->StoreAccessToken($token_data, $error, $request);
                // return response()->json([
                //     "token"=> $token_data
                // ]);
            //    return $this->StoreAccessToken($token_data, $error, $request);
               return response()->json([
                 'user_page_information'=>$user_page_info,
                 "facebook_instagram_page_access_token"=> $token_data,
               ],200);
            }
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
