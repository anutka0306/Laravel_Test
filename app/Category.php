<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Category extends Model
{
    //
    protected $table = 'categories';

    public static function rules_create(){
        return[
            'name'=>'required|unique:categories,name|min:3',
            'slug'=>'required|unique:categories,slug|min:3',
            'image'=>'mimes:jpeg,png,jpg|max:1000',
        ];
    }

    public static function rules_update($id){

        return[
            'name'=>'required|min:3',
            'slug'=>['required','min:3',Rule::unique('categories')->ignore($id)],
            'image'=>'mimes:jpeg,png,jpg|max:1000',
        ];
    }

    public static function attributeNames(){
        return [
            'name'=>'Название',
            'slug'=>'Слаг'
        ];
    }
}
