<?php
/**
 * User: Zhanybek Seitaliev
 * Email: zhandev312@gmail.com
 * Date: 1/24/18
 * Time: 12:10 AM
 */

namespace App\Http\Controllers\Shopify;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\Webhook;
use Illuminate\Http\Request;
use App\Helpers\Shopify\Shopify;

class AuthController extends Controller
{

    protected $chargeTemplate;

    public function __construct()
    {
        $this->chargeTemplate = [
            "name" => "Super Duper Plan",
            "price" => "19.99",
            "test" => "true",
            "return_url" => route("chargeCheck")
        ];
    }

    public function install(Request $request)
    {
        return redirect(Shopify::getInstallUrl(
            $request->shop,
            env('SHOPIFY_API_KEY'),
            env('SHOPIFY_SCOPES'),
            $request->getHost().'/shopify/callback'
        ));
    }

    public function callback(Request $request)
    {
        $shopify = Shopify::auth(
            $request->shop,
            $request->code,
            env('SHOPIFY_API_KEY'),
            env('SHOPIFY_API_SECRET_KEY')
        );

        session([
            'shop' => $request->shop,
            'access_token' => $shopify->getToken()
        ]);

        $charges = $shopify->recurringApplicationCharges()->all();

        if(empty($charges)) {}

        $lastCharge = $charges[0];

        switch ($lastCharge['status']) {
            case "declined":
                return view('charge-declined', ['shop'=>$request->shop]);
                break;
            case "cancelled":
                $createdCharge = $shopify->recurringApplicationCharges()
                                         ->create($this->chargeTemplate);
                return redirect($createdCharge['confirmation_url']);
                break;
            case "accepted":
                $charge['status'] = 'active';
                $shopify->recurringApplicationCharges()->activate($charge);
                session(['login' => true]);
                break;
        }

        $shopData = $shopify->shop()->single();

        if(empty(Shop::find($shopData['id']))) {
            $shopData['token'] = $shopify->getToken();
            Shop::create($shopData);
            Webhook::create(['shop_id' => $shopData['id']]);
        }

        session([
            'shop_auth' => $shopify->getShopDomain(),
            'token_auth' => $shopify->getToken(),
            'shop_id' => $shopData['id'],
            'login' => true
        ]);

        return redirect()->route('dashboard');

    }

    public function chargeCreate(Request $request)
    {
        $shopify = new Shopify(
            $request->session()->get('shop'),
            $request->session()->get('access_token')
        );

        $createdCharge = $shopify->recurringApplicationCharges()->create($this->chargeTemplate);

        return redirect($createdCharge['confirmation_url']);
    }

    public function chargeCheck(Request $request)
    {
        $shopify = new Shopify(
            $request->session()->get('shop'),
            $request->session()->get('access_token')
        );

        $charge = $shopify
                    ->recurringApplicationCharges()
                    ->single($request->get("charge_id"));

        switch ($charge['status']) {
            case "declined":
                return view('charge-declined', [
                    'shop'=>$request->session()->get('shop')
                ]);
                break;
            case "accepted":
                $charge['status'] = 'active';
                $shopify->recurringApplicationCharges()->activate($charge);
                break;
        }

        return redirect()->route('install', [
            'shop' => $request->session()->get('shop')
        ]);

    }

    public function chargeCancel(Request $request)
    {
        $shopify = new Shopify(
            $request->session()->get('shop'),
            $request->session()->get('access_token')
        );

        $charges = $shopify->recurringApplicationCharges()->all();
        $lastCharge = $charges->first();

        $shopify->recurringApplicationCharges()->cancel($lastCharge['id']);

        return redirect()->route('install', [
            'shop' => $request->session()->get('shop')
        ]);

    }

    public function logout(Request $request)
    {

        $request->session()->flush();

        return redirect('/')->with('status', 'You have successfully logged out!');
    }
}