<?php
/**
 * User: Zhanybek Seitaliev
 * Email: zhandev312@gmail.com
 * Date: 12/26/17
 * Time: 2:34 PM
 */

namespace App\Helpers\Shopify\Resources;

use App\Helpers\Shopify\Base;

class Asset extends Base
{
    public function all($themeId)
    {
        $assets = $this->get("/admin/themes/$themeId/assets.json")['assets'];

        return collect($assets);
    }

    public function getLiquidSnippet($themeId ,$name)
    {
        try {
            $template = $this->get(
                "/admin/themes/$themeId/assets.json?asset[key]=snippets/$name.liquid&theme_id=$themeId"
            );
        }catch (\Exception $exception) {

            return null;

        }

        return $template;
    }

    public function getLiquidTemplate($themeId ,$name)
    {
        try {
            $template = $this->get(
                "/admin/themes/$themeId/assets.json?asset[key]=templates/$name.liquid&theme_id=$themeId"
            );
        }catch (\Exception $exception) {

            return null;

        }

        return $template;
    }

    public function create($themeId, $asset)
    {
        return $this->put(
            "/admin/themes/$themeId/assets.json",
            ['asset' => $asset]
        )['asset'];
    }
}