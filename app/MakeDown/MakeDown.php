<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/27
 * Time: 1:51
 */
namespace  App\MakeDown;
class  MakeDown{

    protected $parser;

    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }


    public function makedown($text){
        $html = $this->parser->makeHtml($text);
        return $html;
    }
}