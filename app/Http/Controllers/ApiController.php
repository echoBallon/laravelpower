<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller
{
    //
    protected $statuscode = 200;

    /**
     * @return int
     */
    public function getStatuscode()
    {
        return $this->statuscode;
    }

    /**
     * @param int $statuscode
     */
    public function setStatuscode($statuscode)
    {
        $this->statuscode = $statuscode;
        return $this;
    }

    /**
     *
     */
    public function responseNotFound($message = 'NOT Found'){

        return  Response::json([
            'status_code'=>$this->getStatuscode(),
            'status'=>'false',
            'message'=>$message,

        ]);

    }
    public function response($data){
        return Response::json($data,$this->getStatuscode());
    }
}
