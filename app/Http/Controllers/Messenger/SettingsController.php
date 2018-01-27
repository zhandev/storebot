<?php
/**
 * User: Zhanybek Seitaliev
 * Email: zhandev312@gmail.com
 * Date: 1/27/18
 * Time: 5:38 PM
 */

namespace App\Http\Controllers\Messenger;

use App\Helpers\Messenger\ApiMessengerProfile;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function init()
    {
        $apiMessengerProfile = new ApiMessengerProfile();

        $whitelisted_domains = $apiMessengerProfile->get(['whitelisted_domains']);

        $result = $apiMessengerProfile->update(['whitelisted_domains' => [
            env('APP_URL')
        ]]);

        var_dump($result);
    }
}