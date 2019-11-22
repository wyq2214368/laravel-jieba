<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any('/test/{action}', 'TestController@index');

//结巴分词
//分词
Route::any('/cut', 'Api\\JiebaController@cut');
//关键词提取
Route::any('/analyse', 'Api\\JiebaController@analyse');
//分词位置标注
Route::any('/tokenize', 'Api\\JiebaController@tokenize');
//分词词性标注
Route::any('/posseg', 'Api\\JiebaController@posseg');