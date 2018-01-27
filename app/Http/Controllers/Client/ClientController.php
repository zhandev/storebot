<?php
/**
 * User: Zhanybek Seitaliev
 * Email: zhandev312@gmail.com
 * Date: 1/24/18
 * Time: 4:13 AM
 */

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\Webhook;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $shopObj = Shop::find($request->session()->get('shop_id'));
        $messengers = $shopObj->messengers;
        $webhooks = $shopObj->webhooks;
//        var_dump($request->session()->get('access_token'));
        return view('dashboard', [
            'messengers' => $messengers,
            'webhooks' => $webhooks->first()
        ]);
    }

    public function updateWebhooks(Request $request)
    {

        $webhooks = Webhook::find($request->session()->get('shop_id'));

        $webhooks->update($request->get('webhooks'));

        return response()->json($request->get('webhooks'));
    }
}