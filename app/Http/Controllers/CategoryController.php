<?php

namespace App\Http\Controllers;

use App\Category;
use App\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    /**
     * Check if id exists
     * @param $slug string
     * @return object|null
     */
    private function checkSlug(string $slug){
        return Category::query()->where('slug',$slug)->value('slug');
    }

    public function index(){
        return view('Categories.categories')->with('categories', Category::all());
    }

    public function show($slug){
        if(!$this->checkSlug($slug)){
            abort('404');
        }
        $cat_id = Category::query()->where('slug',$slug)->value('id');
        return view('Categories.category')->with([
            'tests'=>Test::query()->where('cat',$cat_id)->get(),
            'category'=>Category::query()->find($cat_id),
        ]);
    }
}
