<?php
/**
 * User: Zhanybek Seitaliev
 * Email: zhandev312@gmail.com
 * Date: 1/25/18
 * Time: 10:39 PM
 */

namespace App\Helpers\Shopify\Resources;

use App\Helpers\Shopify\Base;

class Webhook extends Base
{

    public function create($webhook)
    {
        $createdWebhook = $this->post("/admin/webhooks.json", [
            'webhook' => $webhook
        ]);

        return $createdWebhook;
    }

    public function update($id, $webhook)
    {
        $updatedWebhook = $this->put("/admin/webhooks/$id.json", [
            'webhook' => $webhook
        ]);

        return $updatedWebhook;
    }

    public function all($parameters = [])
    {
        $parameters = http_build_query($parameters);

        $webhooks = $this->get("/admin/webhooks.json?".$parameters);

        return $webhooks['webhooks'];
    }

}