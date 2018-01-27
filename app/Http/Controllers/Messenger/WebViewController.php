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
    public function cart(Request $request)
    {

        $payloadId = $request->get('payload_id');

        if(empty($payloadId)) {

            return view('webviews.exist');

        }

        $payloadData = MessagePayload::find($payloadId);

        if(empty($payloadData)) {

            return view('webviews.exist');

        }

        $type = $payloadData['type'];
        $data = $payloadData['payload'];

        return view('webviews.cart', [
            'line_items' => $data['line_items']
        ]);
    }
}