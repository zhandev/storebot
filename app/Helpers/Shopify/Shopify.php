<?php
/**
 * User: Zhanybek Seitaliev
 * Email: zhandev312@gmail.com
 * Date: 12/22/17
 * Time: 11:19 AM
 */

namespace App\Helpers\Shopify;

use GuzzleHttp\Client;

class Shopify extends Base
{

    public function __construct($shop, $token)
    {
        parent::__construct($shop, $token);
    }

    /**
     *
     * Return install url
     *
     * @param $shop string
     * @param $apiKey
     * @param $scopes
     * @param $redirectUrl
     * @return string
     */
    public static function getInstallUrl($shop, $apiKey, $scopes, $redirectUrl)
    {
        return "https://$shop/admin/oauth/authorize?"
            ."client_id=".$apiKey
            ."&scope=".$scopes
            ."&redirect_uri=https://".$redirectUrl
            ."&state={nonce}"
            ."&grant_options[]={option}";

    }

    public static function auth($shop, $code, $apiKey, $secretKey)
    {

        $client = new Client(["base_url" => "https://$shop"]);

        $response = $client->post("https://$shop/admin/oauth/access_token", [
            "form_params" => [
                "client_id" =>  $apiKey,
                "client_secret" => $secretKey,
                "code" => $code
            ]
        ]);

        $token = json_decode($response->getBody()->getContents(), true)['access_token'];

        return new self($shop, $token);

    }

    public function recurringApplicationCharges()
    {

        return new Resources\RecurringApplicationCharges($this->shop, $this->token);

    }

    public function product()
    {

        return new Resources\Product($this->shop, $this->token);

    }

    public function shop()
    {

        return new Resources\Shop($this->shop, $this->token);

    }

    public function order()
    {

        return new Resources\Order($this->shop, $this->token);

    }

    public function customCollections()
    {
        return new Resources\CustomCollection($this->shop, $this->token);
    }

    public function metafield()
    {
        return new Resources\Metafield($this->shop, $this->token);
    }

    public function theme()
    {
        return new Resources\Theme($this->shop, $this->token);
    }

    public function asset()
    {
        return new Resources\Asset($this->shop, $this->token);
    }

    public function webhook()
    {
        return new Resources\Webhook($this->shop, $this->token);
    }

}