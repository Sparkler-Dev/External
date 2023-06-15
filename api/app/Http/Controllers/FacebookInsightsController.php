<?php

namespace App\Http\Controllers;

use App\Models\StoreFacebookPageAccessToken;
use Illuminate\Http\Request;

class FacebookInsightsController extends Controller
{
    public function get_single_facebook_page_impressions(){
        if(auth('sanctum')->check()){

         $user_id = auth('sanctum')->user();
        $php_curl = curl_init();

         $get_page_access_token = StoreFacebookPageAccessToken::where('client_id', $user_id->client_id)->first();
        //  return response()->json([
        //        $get_page_access_token
        //        ]);

        $page_id = $get_page_access_token->page_id;      
        $access_token = $get_page_access_token->access_token;       

        curl_setopt_array($php_curl, array(
            CURLOPT_URL => "https://graph.facebook.com/$page_id/insights/page_impressions_unique?access_token=$access_token",
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
              $final_data = json_decode($final_results);
              return response()->json([
                   'single_facebook_page_impressions' => $final_data->data
               ]);
        }
    }
}

    public function get_facebook_page_feed(){
         $user_id = auth('sanctum')->user();
         $get_page_access_token = StoreFacebookPageAccessToken::where('client_id', $user_id->client_id)->first();
         $page_id = $get_page_access_token->page_id;      
        $access_token = $get_page_access_token->access_token;  
         $php_curl = curl_init();
        curl_setopt_array($php_curl, array(
            CURLOPT_URL => "https://graph.facebook.com/$page_id/feed?access_token=$access_token",
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
              $final_data = json_decode($final_results);
              return response()->json([
                   'facebook_feed' => $final_data->data
               ]);
        }
    }

    public function get_facebook_feed_by_id($id) {
         $user_id = auth('sanctum')->user();
         $get_page_access_token = StoreFacebookPageAccessToken::where('client_id', $user_id->client_id)->latest("id")->first();
         $feed_id = $id;      
        $access_token = $get_page_access_token->access_token;  

          $php_curl = curl_init();
        curl_setopt_array($php_curl, array(
            CURLOPT_URL => "https://graph.facebook.com/$feed_id/insights?metric=post_reactions_like_total,post_reactions_love_total,post_reactions_wow_total&access_token=$access_token",
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
              $final_data = json_decode($final_results);
              return response()->json([
                   'facebook_feed_by_id' => $final_data->data
               ]);
        }


    }

    public function get_facebook_matrics(){
         $user_id = auth('sanctum')->user();
         $get_page_access_token = StoreFacebookPageAccessToken::where('client_id', $user_id->client_id)->latest("id")->first();
         $page_id = $get_page_access_token->page_id;          
        $access_token = $get_page_access_token->access_token;  

          $php_curl = curl_init();
        curl_setopt_array($php_curl, array(
            CURLOPT_URL => "https://graph.facebook.com/$page_id/insights?metric=page_impressions_unique,page_engaged_users&access_token=$access_token",
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
              $final_data = json_decode($final_results);
              return response()->json([
                   'facebook_page_impressions_28' => $final_data->data['4'],
                   'facebook_page_engaged_users_28' => $final_data->data['5'],
                   'facebook_page_impressions_weekly' => $final_data->data['2'],
                   'facebook_page_engaged_users_weekly' => $final_data->data['3'],
                   'facebook_page_impressions_daily' => $final_data->data['0'],
                   'facebook_page_engaged_users_daily' => $final_data->data['1'],
               ]);
        }
    }
    

}