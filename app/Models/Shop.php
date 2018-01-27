<?php
/**
 * User: Zhanybek Seitaliev
 * Email: zhandev312@gmail.com
 * Date: 1/24/18
 * Time: 1:32 AM
 */
namespace App\Models;

use App\Events\ShopCreate;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $guarded = [];

    public function messengers()
    {
        return $this->hasMany('App\Models\Messenger');
    }

    public function webhooks()
    {
        return $this->hasMany('App\Models\Webhook');
    }

    public function setCreatedAtAttribute($value)
    {

        $this->attributes['created_at'] = DateTime::createFromFormat('Y-m-d\TH:i:sP', $value)->format('Y-m-d H:i:s');
    }

    public function setUpdatedAtAttribute($value)
    {
        $this->attributes['updated_at'] = DateTime::createFromFormat('Y-m-d\TH:i:sP', $value)->format('Y-m-d H:i:s');
    }

    protected $dispatchesEvents = [
        'created' => ShopCreate::class,
    ];
}