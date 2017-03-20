<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/28
 * Time: 0:00
 */

namespace App\Api\Transformer;


use App\Lesson;
use League\Fractal\TransformerAbstract;

class Lessontransform extends  TransformerAbstract
{

    public function transform(Lesson $lesson){

        return [
            'title' => $lesson['title'],
            'content' => $lesson['body'],
            'is_free' =>(boolean)$lesson['free'],
        ];
    }

}