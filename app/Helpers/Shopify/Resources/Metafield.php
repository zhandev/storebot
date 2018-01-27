<?php
/**
 * User: Zhanybek Seitaliev
 * Email: zhandev312@gmail.com
 * Date: 12/24/17
 * Time: 1:07 PM
 */

namespace App\Helpers\Shopify\Resources;

use App\Helpers\Shopify\Base;

class Metafield extends Base
{
    public function productsAll($productId, $parameters = [])
    {
        $parameters = http_build_query($parameters);
        $metafields = $this->get("/admin/products/$productId/metafields.json?$parameters")['metafields'];

        return collect($metafields);
    }

    public function productsCreate($productId, $metafield = [])
    {
        $createdMetafield = $this->post("/admin/products/$productId/metafields.json", [
            'metafield' => $metafield
        ]);

        return $createdMetafield;
    }

    public function productsSingle($productId, $metafieldId)
    {
        $metafield = $this->get("/admin/products/$productId/metafields/$metafieldId.json")['metafield'];
        return $metafield;
    }

    public function productsDelete($productId, $metafieldId)
    {
        $status = $this->delete("/admin/products/$productId/metafields/$metafieldId.json");
        return $status;
    }

    public function all($parameters = [])
    {

        $parameters = http_build_query($parameters);

        $metafields = $this->get("/admin/metafields.json?$parameters")['metafields'];

        return collect($metafields);

    }

    public function create($metafield)
    {
        $createdMetafield = $this->post("/admin/metafields.json", [
            'metafield' => $metafield
        ]);

        return $createdMetafield;
    }

    public function deleteSingle($metafieldId)
    {
        $status = $this->delete("/admin/metafields/$metafieldId.json");

        return $status;
    }
}