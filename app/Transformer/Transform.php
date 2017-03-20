<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/27
 * Time: 19:25
 */

namespace App\Transformer;


abstract class Transform
{
    public function tranformChange($items){
        return array_map([$this,'transform'],$items);
    }
   public abstract function transform($items);

}