<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Test;
use App\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.tests')->with([
            'tests'=> Test::all(),
            'category'=> Category::query()->pluck('name','id'),
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
        return view('admin.create_edit_test')->with([
          'test'=> Test::query()->find($id),
          'cats'=> Category::query()->select(['id','name'])->get(),
            'questions'=> Test::find($id)->questions,

        ]);
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

       $inputData = $request->except('_token','_method','questionIds','questions');
       $questions = array_combine($request->questionIds, $request->questions);
        $image_url = null;
        if($request->file('image')){
            $path = \Storage::putFile('public/images', $request->file('image'));
            $image_url = Storage::url($path);
            $inputData['image'] = $image_url;
        }
        Test::query()->where('id', $id)->update($inputData);
        foreach ($questions as $question){
            Question::query()->where('id', key($questions))->update(['question'=>$question]);
            next($questions);
        }
       return view('admin.tests')->with([
           'success'=> 'Тест успешно обновлен',
           'tests' => Test::all(),
           'category'=> Category::query()->pluck('name','id'),
           ]);
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
