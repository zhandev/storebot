<?php
/**
 * User: Zhanybek Seitaliev
 * Email: zhandev312@gmail.com
 * Date: 1/24/18
 * Time: 2:35 PM
 */

namespace App\Http\Controllers\Messenger;

use App\Helpers\Messenger\ApiUserProfile;
use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;

class MessengerController extends Controller
{
    public function webhook(Request $request)
    {

        $mode = $request->get('hub_mode');
        $token = $request->get('hub_verify_token');
        $challenge = $request->get('hub_challenge');

        if(empty($mode) && empty($token)) {

            return response('Empty mode and token', 403);

        }

        if($mode === "subscribe" && $token === env('MESSENGER_MARKER')) {

            error_log('webhook verified');
            return response($challenge, 200);

        }else {

            return response('Verify tokens do not match', 403);

        }

    }

    public function handle(Request $request)
    {

        if($request->get('object') !== 'page') {
            return response('Not found', 404);
        }

        foreach ($request->get('entry') as $entry) {

            $messaging = $entry['messaging'];

            $recipientId = $messaging[0]['sender']['id'];

            if(!empty($messaging[0]['optin'])) {

                $this->optinHandler($recipientId, $messaging[0]['optin']['ref']);

            }

        }
    }

    protected function optinHandler($recId, $ref)
    {
        $profile = ApiUserProfile::getProfile($recId);

        $messengers = Shop::where('myshopify_domain', $ref)->first()->messengers;

        if(empty($messengers->all())) {

            Shop::where('myshopify_domain', $ref)->first()->messengers()->create($profile);

        }

    }
}