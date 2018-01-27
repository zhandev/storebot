<?php
/**
 * User: Zhanybek Seitaliev
 * Email: zhandev312@gmail.com
 * Date: 1/24/18
 * Time: 11:45 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Webhook extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    public $primaryKey = 'shop_id';
}