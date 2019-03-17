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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::group(['namespace' => 'Api\Auth'], function () {

//    dd("api.php stage 10");
    Route::post('login', 'ApiLoginController@login');

});


Route::group(['middleware' => ['auth:api']],function(){

    Route::get('get-posts',function(){
        return \App\Post::all();
    })->middleware('scope:get-posts');

    Route::get('get-two-post',function(){
        try{
            return \App\Post::limit(2)->get();
        }
        catch(Exception $ex){
            dd("exc ");
        }
    })->middleware('scope:get-two-post');



});

Route::post('create-client', function (Request $request){
    $aa=new \Laravel\Passport\Client() ;
    $aa->name='test';
    $aa->redirect='http://localhost:1030/callback';
    $aa->user_id=1;
    $aa->secret='Vu9CbPm1sIwhmpqf4sso0ccXbKwtILpNLFYvnWSg';
    $aa->personal_access_client=0;
    $aa->password_client=0;
    $aa->revoked=0;
//    $aa->setAttribute('name','test');
//    $aa->setAttribute('redirect','http://localhost:1030/callback');
//    $aa->setAttribute('user_id',1);
//    $aa->setAttribute('secret','Vu9CbPm1sIwhmpqf4sso0ccXbKwtILpNLFYvnWSg');
//    $aa->se
    $aa->save();

});




