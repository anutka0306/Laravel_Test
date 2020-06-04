<?php
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/categories','CategoryController@index')->name('Categories');
Route::get('/category/{category}', 'CategoryController@show')->name('Category');
Route::get('/test/{test}', 'TestController@show')->name('Test');


Route::group([
    'prefix'=>'admin',
    'namespace'=>'Admin',
    'as'=>'admin.'
],
    function (){
Route::get('/','HomeController@index')->name('Admin');
Route::resource('/categories','CategoryController')->except('show');
Route::resource('/tests', 'TestController')->except('show');
    }
);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
