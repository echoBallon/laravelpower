<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Http\Requests\StoreBlogPostRequest;
use App\MakeDown\MakeDown;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use EndaEditor;

class IndexController extends Controller
{
    /**
     * IndexController constructor.
     */
    protected  $makedown;
    public function __construct(MakeDown $makedown)
    {

        $this->middleware('auth',['only'=>['create','store','update','edit']]);

        $this->makedown= $makedown;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $discussions = Discussion::all();
        return view('form.index',compact('discussions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('form.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogPostRequest $request)
    {
        //
        $data = [
            'user_id' => Auth::user()->id,
            'last_user_id' =>  Auth::user()->id,
        ];
       $discussion = Discussion::create(array_merge( $request->all(),$data));
        return redirect()->action('IndexController@show',['id'=>$discussion->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $discussion = Discussion::findOrFail($id);
        $html = $this->makedown->makedown($discussion->body);
        return view('form.show',compact('discussion','html'));
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
        $discussion = Discussion::findOrFail($id);
        if(Auth::user()->id !==$discussion->user_id){
            return redirect('/');
        }
        return view('form.edit',compact('discussion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBlogPostRequest $request, $id)
    {
        //
          $discussion = Discussion::findOrFail($id);
        $discussion->update($request->all());
        return redirect()->action('IndexController@show',['id'=>$discussion->id]);

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
    public function upload(){
        $data = EndaEditor::uploadImgFile('upload');

        return json_encode($data);
    }
}
