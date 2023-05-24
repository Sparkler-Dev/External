<?php

namespace App\Http\Controllers;

use App\Models\StoreFacebookLongAccessToken;
use Illuminate\Http\Request;

class GenerateTwitterAccessToken extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {     
        // NOT WORKING
       
        $php_curl = curl_init();

        //  $access_token = $temp_token->access_token;

        $product = new StoreFacebookLongAccessToken;
        $products_data = [
            'oauth_callback' => $product->grant_type = env('TWITTER_OAUTH_CALLBACK'),
            'oauth_consumer_key' => $product->client_id = env('TWITTER_OAUTH_CONSUMER_KEY'),
        ];
         return response()->json([
            $products_data
        ]);
        // return print_r($products_data);
        $php_curl = curl_init();
        curl_setopt_array($php_curl, array(
            CURLOPT_URL => "https://api.twitter.com/oauth/request_token?",
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
               // STORE THE LONG LIFE ACCESS TOKEN IN $token_data variable
                $token_data = @$room ;
               
                return response()->json([
                    $token_data
                ]);
            }
      
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
