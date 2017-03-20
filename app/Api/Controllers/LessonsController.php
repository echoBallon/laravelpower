<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/27
 * Time: 23:42
 */

namespace App\Api\Controllers;

use App\Api\Transformer\Lessontransform;
use App\Lesson;

class LessonsController extends  BaseController
{
  public function index(){

    $lesson =   Lesson::all();
      return $this->collection($lesson,new Lessontransform());
  }
    public function show($id){
        $lesson = Lesson::find($id);
        if(! $lesson){
            return $this->response->errorNotFound('NOT F');
        }
        return $this->item($lesson,new Lessontransform());
    }
}