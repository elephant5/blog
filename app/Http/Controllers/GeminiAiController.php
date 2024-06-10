<?php

namespace App\Http\Controllers;

use Gemini\Laravel\Facades\Gemini;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class GeminiAiController extends Controller
{
    //
    public function index(){
        $result = Gemini::geminiPro()->generateContent('Hello');
        return $this->response($result->text());
    }

    public function requestGeminiForFree(Request $request): mixed
    {
        $body_ewr =$request->input('params');
        $result = Gemini::geminiPro()->generateContent($body_ewr);
        return $this->response($result->text());
    }

    public function requestGeminiForPay(Request $request): mixed
    {
        $body_ewr =$request->input('params');
        $result = Gemini::geminiPro()->generateContent($body_ewr);
        return $this->response($result->text());
    }

    public function requestGeminiForFreeFlash(Request $request) {

        $api_key = config('constants.GEMINIAI_FLASH_KEY');
        $api_url = config('constants.GEMINIAI_FLASH_URL') . $api_key;
        //$body_ewr = '{"contents": [{"parts": [{"text": "Write a story about a magic backpack"}]}]}';
        $body_ewr =$request->input('params');
        //$body_ewr = '{"contents": [{"parts": [{"text": "'+ $body_ewr +'"}]}]}';
        $client = new Client();

        $headers=['Content-Type'=>"application/json",
            'Accept'=>"*/*",
            'Connection'=>"keep-alive"];
        $response=$client->post($api_url,[
            'headers'=>$headers,
            'body'=>$body_ewr]);
        $data = json_decode($response->getBody());
//        $data = $response->getBody()->getContents();
        //return $this->response( );
        //return $data->candidates[0]->content->parts[0]->text;
        return $this->response($data->candidates[0]->content->parts[0]->text);
    }

    public function requestGeminiForFreeFlashForContent(Request $request) {
        $api_key = config('constants.GEMINIAI_FLASH_KEY');
        $api_url = config('constants.GEMINIAI_FLASH_URL') . $api_key;
        //$body_ewr = '{"contents": [{"parts": [{"text": "Write a story about a magic backpack"}]}]}';
        $params =$request->input('params');
        $body_ewr = '{"contents": [{"parts": [{"text": "'+ $params +'"}]}]}';
        $client = new Client();

        $headers=['Content-Type'=>"application/json",
            'Accept'=>"*/*",

            'Connection'=>"keep-alive"];
        $response=$client->post($api_url,[
            'headers'=>$headers,
            'body'=>$body_ewr]);
        $data = json_decode($response->getBody());
//        $data = $response->getBody()->getContents();
        //return $this->response( );
        //return $data->candidates[0]->content->parts[0]->text;
        return $this->response($data->candidates[0]->content->parts[0]->text);
    }

}
