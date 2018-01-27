<?php
/**
 * User: Zhanybek Seitaliev
 * Email: zhandev312@gmail.com
 * Date: 1/13/18
 * Time: 4:55 PM
 */

namespace App\Helpers\Messenger;

use GuzzleHttp\Client;

class ApiUserProfile
{
    public static function getProfile($psid)
    {
        $client = new Client();

        $response = $client->get("https://graph.facebook.com/v2.6/$psid?access_token=".env('MESSENGER_MARKER'));

        return json_decode($response->getBody()->getContents(), true);

    }
}