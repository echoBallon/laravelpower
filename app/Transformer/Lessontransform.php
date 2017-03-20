<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/27
 * Time: 19:28
 */

namespace App\Transformer;


class Lessontransform extends Transform
{

    public function transform($lessons){

        return [

            'title' => $lessons['title'],
            'content' => $lessons['body'],
            'is_free' =>(boolean)$lessons['free'],
        ];
    }

}