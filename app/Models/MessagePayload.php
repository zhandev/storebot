<?php
/**
 * User: Zhanybek Seitaliev
 * Email: zhandev312@gmail.com
 * Date: 1/27/18
 * Time: 7:10 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessagePayload extends Model
{
    public $table = 'message_payload';

    protected $guarded = [];

    public function getPayloadAttribute($value)
    {
        return json_decode($value, true);
    }
}