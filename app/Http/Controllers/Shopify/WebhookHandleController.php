<?php
/**
 * User: Zhanybek Seitaliev
 * Email: zhandev312@gmail.com
 * Date: 1/26/18
 * Time: 2:01 PM
 */

namespace App\Http\Controllers\Shopify;

use App\Helpers\Messenger\ApiSend;
use App\Http\Controllers\Controller;
use App\Models\MessagePayload;
use App\Models\Shop;
use Illuminate\Http\Request;
use Mixpanel;

class WebhookHandleController extends Controller
{
    public function handle(Request $request)
    {
        $mp = Mixpanel::getInstance(env('MIXPANEL_PROJECT_TOKEN'));

        $domain = $request->header('x-shopify-shop-domain');
        $topic  = $request->header('x-shopify-topic');

        $method = str_replace('/', '_', $topic);

        $shop = Shop::where('myshopify_domain', $domain)->first();

        $mp->track("Fire webhook: " . $method);

        if(empty($shop)) {
            error_log('Shop exist');
            return response('Shop exist', 422);
        }

        if(empty($shop->messengers)) {
            return response('Messengers exist', 422);
        }

        if(!method_exists($this, $method)) {
            return response('Method exist', 422);
        }

        $separateMethod = explode('_', $method);

        $webhookName = $separateMethod[0];

        $webhooksStatus = $shop->webhooks->first();

        if($webhooksStatus[mb_substr($webhookName, 0, -1)]) {

            foreach ($shop->messengers as $messenger) {

                $this->$method($request->all(), $messenger);

            }

        }else {


            error_log('Event disabled');

        }

    }

    public function carts_update($body, $messenger)
    {

        $apiSend = new ApiSend($messenger->id);

        $messagePayload = MessagePayload::create([
            'type' => 'carts_update',
            'payload' => json_encode($body)
        ]);

        $apiSend->sendMessage([
            'attachment' => [
                'type' => 'template',
                'payload' => [
                    'template_type' => 'generic',
                    'elements' => [
                        [
                            'title' => 'Cart Updated',
                            'subtitle' => 'Someone from your customers has updated their Cart',
                            'buttons' => [
                                [
                                    'type' => 'web_url',
                                    'url' => route('webview-cart-update', ['payload_id' => $messagePayload->id]),
                                    'title' => 'View Cart'
                                ]
                            ]
                        ],
                    ]
                ]
            ]
        ]);
    }

    public function carts_create($body, $messenger)
    {

        $apiSend = new ApiSend($messenger->id);

        $messagePayload = MessagePayload::create([
            'type' => 'carts_create',
            'payload' => json_encode($body)
        ]);

        $apiSend->sendMessage([
            'attachment' => [
                'type' => 'template',
                'payload' => [
                    'template_type' => 'generic',
                    'elements' => [
                        [
                            'title' => 'Cart Create',
                            'subtitle' => 'Someone from your customers created Cart',
                            'buttons' => [
                                [
                                    'type' => 'web_url',
                                    'url' => route('webview-cart-create', ['payload_id' => $messagePayload->id]),
                                    'title' => 'View Cart'
                                ]
                            ]
                        ],
                    ]
                ]
            ]
        ]);
    }

    public function checkouts_create($body, $messenger)
    {
        $apiSend = new ApiSend($messenger->id);
        $messagePayload = MessagePayload::create([
            'type' => 'checkouts_create',
            'payload' => json_encode($body)
        ]);


        $apiSend->sendMessage([
            'attachment' => [
                'type' => 'template',
                'payload' => [
                    'template_type' => 'generic',
                    'elements' => [
                        [
                            'title' => 'Checkout Create',
                            'subtitle' => 'Someone from your customers created Checkout',
                            'buttons' => [
                                [
                                    'type' => 'web_url',
                                    'url' => route('webview-checkout-create', ['payload_id' => $messagePayload->id]),
                                    'title' => 'View Checkout'
                                ]
                            ]
                        ],
                    ]
                ]
            ]
        ]);
    }

    public function checkouts_update($body, $messenger)
    {
        $apiSend = new ApiSend($messenger->id);
        $messagePayload = MessagePayload::create([
            'type' => 'checkouts_update',
            'payload' => json_encode($body)
        ]);


        $apiSend->sendMessage([
            'attachment' => [
                'type' => 'template',
                'payload' => [
                    'template_type' => 'generic',
                    'elements' => [
                        [
                            'title' => 'Checkout Updated',
                            'subtitle' => 'Someone from your customers updated Checkout',
                            'buttons' => [
                                [
                                    'type' => 'web_url',
                                    'url' => route('webview-checkout-update', ['payload_id' => $messagePayload->id]),
                                    'title' => 'View Checkout'
                                ]
                            ]
                        ],
                    ]
                ]
            ]
        ]);
    }

}