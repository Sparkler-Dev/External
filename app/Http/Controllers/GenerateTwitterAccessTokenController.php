<?php

namespace App\Http\Controllers;

use App\Models\StoreFacebookLongAccessToken;
use App\Models\StoreFBInstaPageAccessToken;
use DOMDocument;
use DOMXPath;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use Illuminate\Pagination\UrlWindow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;

class GenerateTwitterAccessTokenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        

// $php_curl = curl_init();

//         //  $access_token = $temp_token->access_token;

//         $product = new StoreFacebookLongAccessToken;
//         $products_data = [
//             'oauth_callback' => $product->grant_type = env('TWITTER_OAUTH_CALLBACK'),
//             'oauth_consumer_key' => $product->client_id = env('TWITTER_OAUTH_CONSUMER_KEY'),
//         ];
//         //  return response()->json([
//         //     $products_data
//         // ]);
//         // return print_r($products_data);
//         $php_curl = curl_init();
//         curl_setopt_array($php_curl, array(
//             CURLOPT_URL => "https://api.twitter.com/oauth/request_token?",
//             CURLOPT_RETURNTRANSFER => true,
//             CURLOPT_ENCODING => "",
//             CURLOPT_HEADER =>false,
//             CURLOPT_MAXREDIRS => 10,
//             CURLOPT_TIMEOUT => 1000,
//             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//             CURLOPT_CUSTOMREQUEST => "POST",
//             // CURLOPT_POSTFIELDS => json_encode($products_data),
//             CURLOPT_HTTPHEADER => array(
//                 // Set POST here requred headers
//                  'Accept: application/vnd.api+json',
//     'Content-Type: application/vnd.api+json',
//     ': ',
//     'Authorization: OAuth oauth_consumer_key="E5iMsfG3RbZLUPMWeOhYX4OAl",oauth_token="1513132729360998401-uNr50McGWITP5GkuhQEzaFYywLPQVs",oauth_signature_method="HMAC-SHA1",oauth_nonce="Jll8xUbqW3w",oauth_version="1.0",oauth_signature="vZiQ%2FYNY%2BSDUJmCkmhZ9ORNPI%2FM%3D"',
//     'Cookie: guest_id=v1%3A167541078306846013; guest_id_ads=v1%3A167541078306846013; guest_id_marketing=v1%3A167541078306846013; personalization_id="v1_ydaMqRM3GGjHVIIkJeUFLQ=="'
//   ),
//         ),);
 

//         $final_results = curl_exec($php_curl);
//         $err = curl_error($php_curl);

        
        
        
//         curl_close($php_curl);

        
//         echo($final_results) ;
//         return response()->json([
//             "response"=> json_encode($final_results, JSON_NUMERIC_CHECK)
//         ]);


          $response = Http::get('https://api.twitter.com/oauth/request_token?oauth_callback=https://graph-api-one.vercel.app/&oauth_consumer_key=E5iMsfG3RbZLUPMWeOhYX4OAl',[
              'Accept: application/vnd.api+json',
              'Content-Type: application/vnd.api+json',
              'Authorization: OAuth oauth_consumer_key="E5iMsfG3RbZLUPMWeOhYX4OAl",oauth_token="1513132729360998401-uNr50McGWITP5GkuhQEzaFYywLPQVs",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1685622236",oauth_nonce="P9lTo7mbSOL",oauth_version="1.0",oauth_signature="WjHpvdjGveWqhMyqKyPSqLytFiM%3D"',
              'Cookie: guest_id=v1%3A167541078306846013; guest_id_ads=v1%3A167541078306846013; guest_id_marketing=v1%3A167541078306846013; personalization_id="v1_ydaMqRM3GGjHVIIkJeUFLQ=="; lang=en'
          ]);

          return response()->json([
             "response"=> $response->body()
         ]);
       
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
