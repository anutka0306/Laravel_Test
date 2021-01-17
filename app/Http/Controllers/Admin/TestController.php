<?php

namespace App\Http\Controllers\Admin;

use App\Answer;
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
        $answers = [];
        $questionIds = Question::query()->where('test_id', $id)->get('id')->toArray();
        foreach ($questionIds as $questionId){

            $answers[$questionId['id']] = Question::find($questionId['id'])->answers->toArray();
        }
        //dd($answers);
        return view('admin.create_edit_test')->with([
          'test'=> Test::query()->find($id),
          'cats'=> Category::query()->select(['id','name'])->get(),
            'questions'=> Test::find($id)->questions,
            'answers'=> $answers,

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
 //dd($request);
       $inputData = $request->except('_token','_method','questionIds','questions', 'answerIds', 'answers', 'answerPoints');
       $questions = array_combine($request->questionIds, $request->questions);

       if($request->answerIds) {
           $answers = [];
           for ($i = 0; $i < count($request->answerIds); $i++) {
               $answers[] = [
                   'id' => $request->answerIds[$i],
                   'answer' => $request->answers[$i],
                   'point' => $request->answerPoints[$i],
               ];
           }
       }

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

        if(isset($answers)) {
            foreach ($answers as $answer) {
                Answer::query()->where('id', $answer['id'])->update([
                    'answer' => $answer['answer'],
                    'point' => $answer['point']
                ]);
            }
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
