<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
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

Route::get('/validate-postcode',function(Request $request){
    $response = Http::get('https://postcodes.io/postcodes/'.$request->input('code').'/validate');
    return $response->json();
});

Route::get('/nearest-postcodes',function(Request $request){
    $response = Http::get('https://postcodes.io/postcodes/'.$request->input('code').'/nearest');
    return $response->json();
});

Route::get('/nearest-outward-codes',function(Request $request){
    $response = Http::get('https://postcodes.io/outcodes?lon='.$request->input('long').'&lat='.$request->input('lat'));
    return $response->json();
});
