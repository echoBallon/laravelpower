<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Transformer\Lessontransform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class LessonController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $lessontransformer;

    /**
     * LessonController constructor.
     * @param $lessontransformer
     */
    public function __construct(Lessontransform $lessontransformer)
    {
        $this->lessontransformer = $lessontransformer;
        $this->middleware('auth.basic',['only'=>['store','update','create']]);
    }


    public function index()
    {
        //
        $lessons = Lesson::all();

        return Response::json([
            'status'=>'success',
            'status_code'=>200,
            'data'=>$this->lessontransformer->tranformChange($lessons->toArray()),
        ]);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        if(! $request->get('title') or ! $request->get('body')){
            return $this->setStatuscode(402)->responseNotFound('validate fails');
        }
//        dd($request->all());
        Lesson::create($request->all());
        return $this->response([
            'status'=>'success',
            'message'=>'lesson crated',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $lesson = Lesson::find($id);

        if(!  $lesson){

            return $this->setStatuscode(4342)->responseNotFound('Not Usersd');

        }

        return Response::json([
            'status_code'=>200,
            'status'=>'success',
            'data'=>$this->lessontransformer->transform($lesson),
        ]);
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



}
