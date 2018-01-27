<?php
/**
 * User: Zhanybek Seitaliev
 * Email: zhandev312@gmail.com
 * Date: 1/12/18
 * Time: 11:06 PM
 */

namespace App\Helpers\Messenger;

use GuzzleHttp\Client;

class ApiMessengerProfile
{

    protected $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => "https://graph.facebook.com/v2.6/me/messenger_profile",
            'query' => ['access_token' => env('MESSENGER_MARKER')]
        ]);
    }

    public function get($fields)
    {

        $response = $this->client->request('GET', '', ['query' => [
            'access_token' => env('MESSENGER_MARKER'),
            'fields' => implode(",", $fields)
        ]]);


        return json_decode($response->getBody()->getContents(), true);

    }

    public function update($properties)
    {
        $response = $this->client->request('post', '', [
            'json' => $properties
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function delete($fields)
    {
        $response = $this->client->request('delete', '', [
            'json' => [
                'fields' => $fields
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

}