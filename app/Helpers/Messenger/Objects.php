<?php
/**
 * User: Zhanybek Seitaliev
 * Email: zhandev312@gmail.com
 * Date: 1/13/18
 * Time: 6:10 PM
 */

namespace App\Helpers\Messenger;

class Objects
{
    public static function getObject($name)
    {
         $objects = array(
            "welcome_message" => "Hi!) I have successfully connected with you. Now i will send you important events of your store. For your convenience, I have a menu where you can set me up or contact my creator. More information about my functions can be found in the menu - 'Help'.",
        );

        return $objects[$name];
    }
}