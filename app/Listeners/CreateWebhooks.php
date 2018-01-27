<?php

namespace App\Listeners;

use App\Events\ShopCreate;
use App\Helpers\Shopify\Shopify;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateWebhooks
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ShopCreate  $event
     * @return void
     */
    public function handle(ShopCreate $event)
    {
        $shop = $event->shop;

        $shopify = new Shopify($shop->myshopify_domain, $shop->token);

        $address = env('APP_URL') . '/shopify/webhook';

        $webhooks = [
            "carts/create",
            "carts/update",
            "checkouts/create",
            "checkouts/delete",
            "checkouts/update",
            "customers/create",
            "customers/delete",
            "customers/disable",
            "customers/enable",
            "customers/update",
            "draft_orders/create",
            "draft_orders/delete",
            "draft_orders/update",
            "fulfillments/create",
            "fulfillments/update",
            "fulfillment_events/create",
            "fulfillment_events/delete",
            "orders/cancelled",
            "orders/create",
            "orders/delete",
            "orders/fulfilled",
            "orders/paid",
            "orders/partially_fulfilled",
            "orders/updated",
            "order_transactions/create",
            "refunds/create"
        ];

        foreach ($webhooks as $webhook) {

            try {
                $result = $shopify->webhook()->create([
                    'topic' => $webhook,
                    'address' => $address,
                    'format' => 'json'
                ]);
            }catch (ClientException $exception) {

                $errorName = substr($exception->getMessage(), strpos($exception->getMessage(), "{") + 1);

                $errorName = "{" . $errorName;

                $error = json_decode($errorName, true);

                if(!empty($error['errors']['address'])) {

                    $webhookFromShopify = $shopify->webhook()->all(['topic' => $webhook])[0];

                    $webhookUpdated = $shopify->webhook()->update($webhookFromShopify['id'], [
                       'topic' => $webhook,
                       'address' => $address,
                       'format' => 'json'
                    ]);

                    error_log(json_encode('updated'));

                }

            }

        }
    }
}
