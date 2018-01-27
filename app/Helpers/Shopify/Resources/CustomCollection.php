<?php
/**
 * User: Zhanybek Seitaliev
 * Email: zhandev312@gmail.com
 * Date: 12/23/17
 * Time: 2:43 PM
 */

namespace App\Helpers\Shopify\Resources;

use App\Helpers\Shopify\Base;

class CustomCollection extends Base
{

    public function all()
    {
        $customCollections = $this->get("/admin/custom_collections.json")["custom_collections"];

        return collect($customCollections);
    }

}