<?php

namespace App\Http\Controllers;

use App\Models\StoreFBInstaPageAccessToken;
use App\Models\StoreFBMessages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostToFaceBookInsta extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::user();
        $data = StoreFBInstaPageAccessToken::where('page_id' , '104975525718827')->first();

        

        return response()->json([
            'user_info'=>$user_id,
            "fb_insta_page_access_token"=>$data,
        ]);

    }

    public function PostToFaceBook(Request $request ){

    //    $request->validated($request->all());



        // $product = new StoreFBMessages;
        // $product->long_lived_access_token = $request->long_lived_access_token;
        $products_data = [
            'message' => $request->message,
            'access_token' => $request->access_token,
            // 'client_secret' => $product->client_secret = env('CLIENT_SECRET'),
            // 'fb_exchange_token' => $access_token,
        ];
        // return print_r($products_data);
        $php_curl = curl_init();
        curl_setopt_array($php_curl, array(
            CURLOPT_URL => "https://graph.facebook.com/104975525718827/feed?",
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
                return response()->json([
                    $token_data,  
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
