<?php

namespace App;

require '../vendor/autoload.php';

use Telegram\Bot\Api;

class Telegram 
{
    protected $bot_token;
    protected $telegram;
    protected $environment;

    /**
     * Create a new instance
     * 
     * @return void
     */

    public function __construct()
    {
        $this->bot_token = env('BOT_TOKEN');
        $this->environment = env('APP_ENV');
        $this->telegram = new Api($this->bot_token);
    }

    public function SetUp()
    {
        switch ($this->environment) {
            case 'local':
                # code...
                $response = $this->telegram->getUpdates();
                break;

            case 'staging':
                # code...
                break;

            case 'production':
                # code...
                $response = $this->telegram->setWebhook([
                    'url' => env('APP_URL') . '/' . $this->bot_token . '/webhook',
                    'certificate' => '/path/to/public_key_certificate.pub'
                ]);
                break;
            
            default:
                # code...
                break;
        }

        return $response;
    }

    public function SendMessage($chat_id, $message)
    {
        $response = $this->telegram->sendMessage([
            'chat_id' => $chat_id, 
            'text' => $message,
        ]);
        
        return $response;
    }
}