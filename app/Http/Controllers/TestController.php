<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use App\Question;

class TestController extends Controller
{
    /**
     * Display the specified resource.
     * @param int $id
     */

    public function show($id){
        return view('Test.test')->with([
            'test' => Test::query()->find($id),
            'questions'=>Test::find($id)->questions,

        ]);
    }
}
