<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'categories';

    public static function rules(){
        return[
            'name'=>'required|unique:categories,name|min:3',
            'slug'=>'required|unique:categories,slug|min:3',
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
