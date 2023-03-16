<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Orhanerday\OpenAi\OpenAi;

class ChatbotController extends Controller
{
    public function create(Request $request)
    {
        

        // return json_decode($complete)->error->message;

        if ($request->isMethod('POST')) {
            // return ($request->inputValue);
            $open_ai_key = getenv('OPENAI_API_KEY');
            $open_ai = new OpenAi($open_ai_key);

            $userMessage = $request->inputValue;
            $complete = $open_ai->chat([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    [
                        "role" => "system",
                        "content" => "You are a helpful assistant."
                    ],
                    [
                        "role" => "user",
                        "content" => "Tell me about Zainik Labs"
                    ],
                    [
                        "role" => "assistant",
                        "content" => "Zainik Lab started its journey in 2015 as an individual endeavor.Zainik Lab took the form of a full-fledged UI/UX agency."
                    ],
                    [
                        "role" => "user",
                        "content" => "Founder"
                    ],
                    [
                        "role" => "assistant",
                        "content" => "Shaharuzzaman Sourav"
                    ],
                    
                    [
                        "role" => "user",
                        "content" => "$userMessage"
                    ],
                ],
                'temperature' => 1.0,
                'max_tokens' => 4000,
                'frequency_penalty' => 0,
                'presence_penalty' => 0,
            ]);

            return json_decode($complete);
            // $open_ai = new OpenAi($open_ai_key);
        }
        return view('chatbot.index');
    }
}
