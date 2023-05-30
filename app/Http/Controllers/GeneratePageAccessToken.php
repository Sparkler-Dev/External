<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFBInstPageAccessToken;
use App\Models\StoreFacebookAccessToken;
use App\Models\StoreFacebookLongAccessToken;
use App\Models\StoreFBInstaPageAccessToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeneratePageAccessToken extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getfacebookpageaccesstoken()
    
    {  

        $user_id = auth('sanctum')->user();
        $facebook_long_access_token = StoreFacebookLongAccessToken::where('client_id', $user_id->client_id)->first();
        //   return response()->json([
        //     $facebook_long_access_token
        // ]);
        $user_page_info_id = $facebook_long_access_token->facebook_userdetails->facebook_user_id;
        $facebook_long_access_token = $facebook_long_access_token->long_lived_access_token;
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

               $page_data = json_decode($final_results);

            return response()->json([
                   'facebook_page_access_token' => $page_data->data
                 ]);

                
        }

          
            
        
    }

    public function StoreFBPageAccessToken(StoreFBInstPageAccessToken $request) {
          $request->validated($request->all());
           
           $store_page_access_token =  StoreFBInstaPageAccessToken::create([
          'user_id'=> Auth::user()->id,
          'client_id'=> Auth::user()->client_id,
          'page_name'=>$request->page_name,
          'access_token'=>$request->access_token,
          'page_category'=>$request->page_category,
          'page_id'=>$request->page_id,
        ]);

        return response()->json([
            'response' => $store_page_access_token
        ]);

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
