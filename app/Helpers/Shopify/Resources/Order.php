<?php
/**
 * User: Zhanybek Seitaliev
 * Email: zhandev312@gmail.com
 * Date: 12/23/17
 * Time: 12:47 PM
 */

namespace App\Helpers\Shopify\Resources;

use App\Helpers\Shopify\Base;

class Order extends Base
{
    public function all()
    {
        $orders = $this->get("/admin/orders.json")["orders"];

        return collect($orders);
    }
}