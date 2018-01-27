<?php
/**
 * User: Zhanybek Seitaliev
 * Email: zhandev312@gmail.com
 * Date: 12/22/17
 * Time: 12:03 PM
 */

namespace App\Helpers\Shopify\Resources;

use App\Helpers\Shopify\Base;

class Product extends Base
{
    /**
     * Get all products
     *
     * @param $parameters array
     * @return \Illuminate\Support\Collection
     */
    public function all($parameters = [])
    {
        $parameters = http_build_query($parameters);
        $products = $this->get("/admin/products.json?$parameters")["products"];

        return collect($products);
    }

    public function count()
    {
        return $this->get("/admin/products/count.json")['count'];
    }

    public function single($id)
    {
        return $this->get("/admin/products/$id.json")['product'];
    }
}