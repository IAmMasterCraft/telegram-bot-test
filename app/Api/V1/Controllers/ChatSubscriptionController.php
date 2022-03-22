<?php

namespace App\Api\V1\Controllers;
use App\Telegram;
use App\Users;

class ChatSubscriptionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //
    /**
     * @OA\Post(
     *     path="/subscribe",
     *     operationId="/subscribe",
     *     @OA\Response(
     *         response="201",
     *         description="Returns subscribed user array",
     *         @OA\JsonContent()
     *     ),
     * )
     */
    public function subscribe() {
        $bot  = new Telegram();
        $webhook = $bot->SetUp();
        $user = [];
        foreach ($webhook as $hooks) {
            # code...
            if ($hooks->message->text == "/start") {
                $user = new Users;
                $user->chat_id= $hooks->message->chat->id;
                $user->save();
            }
        }
        
        return response()->json($user, 201);
    }
}
