<?php

namespace App\Http\Controllers;

use App\Category;
use App\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(){
        return view('Categories.categories')->with('categories', Category::all());
    }

    public function show($id){
        return view('Categories.category')->with([
            'tests'=>Test::query()->where('cat',$id)->get(),
        ]);
    }
}
