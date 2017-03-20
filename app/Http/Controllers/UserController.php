<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\User;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Response;
use Validator;
use Session;
use Mail;
use Hash;


class UserController extends Controller
{


    /**
     * UserController constructor.
     */
    public function __construct()
    {

    }

    public function register(){

        return view('users.register');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function login(){
        return view('users.login');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function avatar(){

        return view('users.avatar');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function  changeavatar(Request $request){

          $file = $request->file('avatar');
        $input = array('image' => $file);
        $rules = array(
            'image' => 'image'
        );
        $validator = \Validator::make($input, $rules);

        if ( $validator->fails() ) {
            return \Response::json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ]);

        }
        $destinationPath = 'upload/';
        $filename = Auth::user()->id .'_'.time(). $file->getClientOriginalName();
        $file->move($destinationPath,$filename);
        \Intervention\Image\Facades\Image::make($destinationPath.$filename)->fit(200)->save();
//        $user= User::find(Auth::user()->id);
//        $user->avatar = '/'.$destinationPath .$filename;
//        $user->save();
        return \Response::json(
            [
                'success' => true,
                'avatar' => asset($destinationPath.$filename),
                'image' => $destinationPath.$filename,
            ]
        );

    }
    public function cropavatar(Request $request){

        $photo = $request->get('photo');
        $width =(int) $request->get('w');
        $height =(int) $request->get('h');
        $xAlign =(int) $request->get('x');
        $yAlign = (int)$request->get('y');
        \Intervention\Image\Facades\Image::make($photo)->crop($width,$height,$xAlign,$yAlign)->save();
        $user = Auth::user();
        $user->avatar =asset($photo);
        $user->save();
        return redirect('/user/avatar');


    }
    public function singin(UserLoginRequest $request){

      if(Auth::attempt([
          'email'=>$request->get('email'),
          'password'=>$request->get('password'),
          'is_confirmed'=>1
      ])){

          return redirect('/');
      }
        Session::flash('user_login_failed','密码不正确或者邮箱不存在');
//        dd(Session::get('user_login_failed'));
        return redirect('/user/login')->withInput();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */

    public  function storeSuccess(){
        return view('users.success');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRegisterRequest $request)
    {

        $data =[
            'confirm_code'=>str_random(48),
            'avatar'=>'/images/defult.png',
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'password'=>\Hash::make($request->input('password')) ,
        ];
      $user =  User::create($data);


        $subject = '验证你的邮件';
        $view = 'emails.register';

        $this->sendTo($user,$subject,$view,$data);
        //
        return redirect('success')->with('status', '注册成功');
    }

    /**
     * @param $confirm_code
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function confirmEmail($confirm_code){

        $user = User::where('confirm_code',$confirm_code)->first();
        if(is_null($user)){
            return redirect('/');
        }
        $user->is_confirmed = 1;
        $user->confirm_code = str_random(48);
        $user->save();
        return redirect('/user/login');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param $user
     * @param $subject
     * @param $view
     * @param $data
     */
    private function sendTo($user, $subject, $view, $data)
    {
       Mail::send($view,$data,function($message) use ($user,$subject){

            $message ->to($user->email)->subject($subject);
        });
    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function changepassword(){
        return view('users.changepassword');
    }
    public function postpassword(Request $request){

        $oldpassword = $request->input('oldpassword');
        $password = $request->input('password');
        $data = $request->all();
        $rules = [
            'oldpassword'=>'required|between:6,20',
            'password'=>'required|between:6,20|confirmed',
            'password_confirmation'=>'required',
        ];
        $messages = [
            'required' => '密码不能为空',
            'between' => '密码必须是6~20位之间',
            'confirmed' => '新密码和确认密码不匹配'
        ];
        $validator = \Validator::make($data, $rules, $messages);
        $user = \Auth::user();
        $validator->after(function($validator) use ($oldpassword, $user) {
            if (!\Hash::check($oldpassword, $user->password)) {
                $validator->errors()->add('oldpassword', '原密码错误');
            }
        });
        if ($validator->fails()) {
            return back()->withErrors($validator);  //返回一次性错误
        }
        $user->password = bcrypt($password);

        $user->save();
        Auth::logout();  //更改完这次密码后，退出这个用户
        return redirect('/login');
    }

}
