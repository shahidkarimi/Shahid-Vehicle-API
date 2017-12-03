<?php
/**
 * Created by PhpStorm.
 * User: win8.1
 * Date: 12/2/2017
 * Time: 11:28 PM
 */

namespace App;


class ResponseChema
{
    public $Count = 0;
    public $message = "";
    public $Results = [];
    public function addItem()
    {
        $this->Results = [];
    }
}