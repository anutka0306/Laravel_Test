<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{

    /**
     * Check if id exists
     * @param $id int
     * @return object|null
     */
    private function checkId(int $id){
        return Category::query()->find($id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categories')->with('categories', Category::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create_edit_category')->with('category',new Category());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws ValidationException
     */
    public function store(Request $request)
    {

        $this->validate($request, Category::rules_create(), [], Category::attributeNames());

        $inputData = $request->except(['_token']);
        $image_url = null;
        if($request->file('image')){
            $path = \Storage::putFile('public/images', $request->file('image'));
            $image_url = Storage::url($path);
            $inputData['image'] = $image_url;
        }
        Category::query()->insert($inputData);
        return view('admin.categories')->with('categories',Category::all());
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
        if(!$this->checkId($id)){
            abort('404');
        }
        return view('admin.create_edit_category')->with('category', Category::query()->find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, Category::rules_update($id), [], Category::attributeNames());
        $inputData = $request->except(['_token','_method']);
        $image_url = null;
        if($request->file('image')){
            $path = \Storage::putFile('public/images', $request->file('image'));
            $image_url = Storage::url($path);
            $inputData['image'] = $image_url;
        }
        Category::query()->where('id',$id)->update($inputData);
        return view('admin.categories')->with('categories', Category::all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::query()->where('id',$id)->delete();
        return view('admin.categories')->with('categories', Category::all());

    }
}
