<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
class MailController{
    public function send()
    {
        $name = '王宝花';
        $flag = Mail::send('emails.test',['name'=>$name],function($message){
            $to = '695607679@qq.com';
            $message ->to($to)->subject('邮件测试');
        });
        if($flag){
            echo '发送邮件成功，请查收！';
        }else{
            echo '发送邮件失败，请重试！';
        }
    }
}