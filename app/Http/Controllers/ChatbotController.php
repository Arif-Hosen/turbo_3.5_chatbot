<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Orhanerday\OpenAi\OpenAi;

class ChatbotController extends Controller
{
    public function create(Request $request){
        

        if($request->isMethod('POST')){
            return ($request->inputValue);
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
                    "content" => "Tell me about Zainik Labs?"
                ],
                [
                    "role" => "assistant",
                    "content" => "Zainik Lab started its journey in 2015 as an individual endeavor. In 2017, Zainik Lab took the form of a full-fledged UI/UX agency."
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
         
         return json_decode($complete)?->choices[0]->message->content;
            // $open_ai = new OpenAi($open_ai_key);
        }
        return view('chatbot.index');
    }
}
