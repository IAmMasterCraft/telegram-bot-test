<?php

namespace App\Api\V1\Controllers;
use App\Telegram;
use App\Users;

class MessageSubscribersController extends Controller
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
     * @OA\Get(
     *     path="/message/{id}/{message}",
     *     operationId="/message/id/message",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The user id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="message",
     *         in="path",
     *         description="The message to be sent",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Returns status of message",
     *         @OA\JsonContent()
     *     ),
     * )
     */
    public function MessageOneSubscribers($id, $message) {
        $bot  = new Telegram();

        $user = Users::find($id);

        $bot->SendMessage($user->chat_id, $message);
        return response()->json(["status" => true, "info" => "message sent successfully"]);
    }

    /**
     * @OA\Get(
     *     path="/message/all",
     *     operationId="/message/all",
     *     @OA\Response(
     *         response="200",
     *         description="Returns status of message",
     *         @OA\JsonContent()
     *     ),
     * )
     */
    public function MessageAllSubscribers(Request $request) {
        $bot  = new Telegram();

        $users = Users::all();
        
        $message = $request->message;
        
        foreach ($users as $user) {
            # code...
            $bot->SendMessage($user->chat_id, $message);
        }

        return response()->json(["status" => true, "info" => "message sent successfully"]);
    }
}
