<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
class UserController
{
    public function index(){
        return phpinfo();
    }

    public function addFoobar() {
        //$input = $_POST['input'];
        $api_key = "AIzaSyDsKdEA6-JzViEInrhdnLGj2q6Z54dBZSY";
        //const API_ENDPOINT = "us-central1-aiplatform.googleapis.com";
// 	$api_url = 'https://    us-central1-aiplatform.googleapis.com/v1beta1/projects/'.$api_key.'/locations/us-central1/publishers/google/models/gemini-pro:streamGenerateContent';

        $api_url = 'https://us-central1-aiplatform.googleapis.com/v1beta/models/gemini-pro:generateContent?key=' . $api_key ;
        $body_ewr = '{"contents": [{"parts": [{"text": "Write a story about a magic backpack"}]}]}';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $api_url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $body_ewr);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Accept: */*',
            'Host: generativelanguage.googleapis.com',
            'Connection: keep-alive'
        ]);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);

    }


    public function addGuzzle() {
        $api_key = "AIzaSyDsKdEA6-JzViEInrhdnLGj2q6Z54dBZSY";
        $api_url = 'https://us-central1-aiplatform.googleapis.com/v1beta/models/gemini-pro:generateContent?key=' . $api_key ;
        $body_ewr = '{"contents": [{"parts": [{"text": "Write a story about a magic backpack"}]}]}';

        $client = new Client();

        $headers=['Content-Type'=>"application/json",
            'Accept'=>"*/*",
            'Host'=>"generativelanguage.googleapis.com",
            'Connection'=>"keep-alive"];
        $response=$client->post($api_url,[
            'headers'=>$headers,
            'body'=>$body_ewr]);
        $data = json_decode($response->getBody());
//        $data = $response->getBody()->getContents();

        return $data->candidates[0]->content->parts[0]->text;
        //return $data;
    }
}
