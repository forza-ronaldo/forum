<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|re
*/


Route::group(["prefix" => "v1", "namespace" => "API"], function($router) {

    // below mention routes are public, user can access those without any restriction
    Route::group(["prefix" => "auth"], function () {

        // create new user
        Route::post("register", "AuthController@register");

        // login user
        Route::post("login", "AuthController@login");
    });
    // below mention routes are available only for the authenticated users.
    Route::group(["middleware" => "auth:api", "prefix" => "auth"], function () {
        // logout user from application
        Route::post('logout', "AuthController@logout");
        // get user info
        Route::get("user", "AuthController@user");
        // refresh JWt token
        Route::post("refresh", "AuthController@refresh");
    });
    Route::apiResource('channels','channelController');
    Route::apiResource('discussions','discussionController');
    Route::apiResource('replies','replyController');
});
