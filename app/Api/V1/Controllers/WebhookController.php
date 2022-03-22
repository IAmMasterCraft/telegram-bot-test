<?php

namespace App\Api\V1\Controllers;
use App\Telegram;

class WebhookController extends Controller
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

    public function webhook() {
        $bot  = new Telegram();
        $webhook = $bot->SetUp();
        
        return response()->json($webhook);
    }
}
