<?php
/**
 * User: Zhanybek Seitaliev
 * Email: zhandev312@gmail.com
 * Date: 1/27/18
 * Time: 5:49 PM
 */

namespace App\Http\Controllers\Messenger;

use App\Http\Controllers\Controller;
use App\Models\MessagePayload;
use Illuminate\Http\Request;

class WebViewController extends Controller
{
    public function cartCreate(Request $request)
    {
        $payloadData = MessagePayload::find($$request->get('payload_id'));

        if(empty($$request->get('payload_id')) || empty($payloadData)) {
            return view('webviews.exist');
        }
        $data = $payloadData['payload'];

        return view('webviews.cart-create', [
            'line_items' => $data['line_items']
        ]);
    }

    public function cartUpdate(Request $request)
    {

        $payloadData = MessagePayload::find($$request->get('payload_id'));

        if(empty($$request->get('payload_id')) || empty($payloadData)) {
            return view('webviews.exist');
        }
        $data = $payloadData['payload'];

        return view('webviews.cart-update', [
            'line_items' => $data['line_items']
        ]);
    }

    public function checkoutCreate(Request $request)
    {
        $payloadData = MessagePayload::find($$request->get('payload_id'));

        if(empty($$request->get('payload_id')) || empty($payloadData)) {
            return view('webviews.exist');
        }
        $data = $payloadData['payload'];

        return view('webviews.checkout-create', [
            'line_items' => $data['line_items'],
            'data' => $data
        ]);
    }

    public function checkoutUpdate(Request $request)
    {
        $payloadData = MessagePayload::find($$request->get('payload_id'));

        if(empty($$request->get('payload_id')) || empty($payloadData)) {
            return view('webviews.exist');
        }
        $data = $payloadData['payload'];

        return view('webviews.checkout-update', [
            'line_items' => $data['line_items'],
            'data' => $data
        ]);
    }
}