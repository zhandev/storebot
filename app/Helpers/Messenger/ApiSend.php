<?php
/**
 * User: Zhanybek Seitaliev
 * Email: zhandev312@gmail.com
 * Date: 1/12/18
 * Time: 5:15 PM
 */

namespace App\Helpers\Messenger;

use GuzzleHttp\Client;

class ApiSend
{

    protected $client, $psid;

    public function __construct($psid)
    {
        $this->psid = $psid;
        $this->client = new Client(['base_uri' => "https://graph.facebook.com/"]);
    }

    public function sendMessage($message)
    {

        $this->client->request('post', "v2.6/me/messages?access_token=".env('MESSENGER_MARKER'), [
            'json' => [
                'messaging_type' => 'RESPONSE',
                'recipient' => ['id' => $this->psid],
                'message' => $message
            ]
        ]);

    }

    public function markSeen()
    {
        $this->client->request('post', "v2.6/me/messages?access_token=".env('MESSENGER_MARKER'), [
            'json' => [
                'sender_action' => 'mark_seen',
                'recipient' => ['id' => $this->psid]
            ]
        ]);
    }

    public function typingOn()
    {
        $this->client->request('post', "v2.6/me/messages?access_token=".env('MESSENGER_MARKER'), [
            'json' => [
                'sender_action' => 'typing_on',
                'recipient' => ['id' => $this->psid]
            ]
        ]);
    }

    public function typingOff()
    {
        $this->client->request('post', "v2.6/me/messages?access_token=".env('MESSENGER_MARKER'), [
            'json' => [
                'sender_action' => 'typing_off',
                'recipient' => ['id' => $this->psid]
            ]
        ]);
    }
}