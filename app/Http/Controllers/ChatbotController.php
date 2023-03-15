<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Orhanerday\OpenAi\OpenAi;

class ChatbotController extends Controller
{
    public function create(Request $request){
        $open_ai_key = getenv('OPENAI_API_KEY');
        $open_ai = new OpenAi($open_ai_key);
        
        $complete = $open_ai->chat([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    "role" => "system",
                    "content" => "You are a helpful assistant of Zainik Labs."
                ],
                [
                    "role" => "user",
                    "content" => "What type of products you have?"
                ],
                [
                    "role" => "assistant",
                    "content" => "We provide the web, android, ios application system"
                ],
                [
                    "role" => "user",
                    "content" => "What is your best product?"
                ],
            ],
            'temperature' => 1.0,
            'max_tokens' => 4000,
            'frequency_penalty' => 0,
            'presence_penalty' => 0,
         ]);
         
         return ($complete);

        if($request->isMethod('POST')){
            
            
            // $open_ai = new OpenAi($open_ai_key);
        }
        return view('welcome');
    }
}
