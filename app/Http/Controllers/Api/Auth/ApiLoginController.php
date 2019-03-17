<?php

namespace App\Http\Controllers\Api\Auth;

use App\ApiScopes;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class ApiLoginController extends Controller
{
    use AuthenticatesUsers;

    protected function login(Request $request)
    {
        // implement your user role retrieval logic, for example retrieve from `roles` database table
//        $role = $user->checkRole();
//
//        // grant scopes based on the role that we get previously
//        if ($role == 'admin') {
//            $request->request->add([
//                'scope' => 'manage-order' // grant manage order scope for user with admin role
//            ]);
//        } else {
//            $request->request->add([
//                'scope' => 'read-only-order' // read-only order scope for other user role
//            ]);
//        }


//        dd("hello");

        if(ApiScopes::where('app_id','=',$request->app)->count()){
            $scopes='';
//            $availableScopes = array();
            ApiScopes::where('app_id','=',$request->app)->get()->map(function($item) use(&$scopes) {
//                $availableScopes[$item->name] = $item->title;
                $scopes.=$item->name.' ';
            });
//            dd($scopes);
            $request->request->add([
                'scope' => $scopes // read-only order scope for other user role
            ]);
//            $request->request->add(['username' => $request->email]);
        }

//        else{
//
//            $request->request->add([
//                'scope' => 'read-only-order' // read-only order scope for other user role
//            ]);
//        }

        // forward the request to the oauth token request endpoint
        $tokenRequest = Request::create(
            '/oauth/token',
            'post'
        );
//        dd($tokenRequest);
        return Route::dispatch($tokenRequest);
    }
}
