<?php
/**
 * User: Zhanybek Seitaliev
 * Email: zhandev312@gmail.com
 * Date: 12/26/17
 * Time: 2:23 PM
 */

namespace App\Helpers\Shopify\Resources;

use App\Helpers\Shopify\Base;

class Theme extends Base
{
    public function all($parameters = [])
    {
        $parameters = http_build_query($parameters);

        $themes = $this->get("/admin/themes.json?$parameters")['themes'];

        return collect($themes);
    }

    public function getMain()
    {
        $themes = $this->all();

        $mainTheme = $themes->firstWhere('role', '=', 'main');

        return $mainTheme;
    }
}