<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Use App\Models\Contact;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/contacts', function (Request $request) {
    $validator = Validator::make($request->all(),[
        'name' => 'required',
        'phone' => 'required',
        'email' => 'required',
        'streetNumber' => 'required',
        'streetName' => 'required',
        'city' => 'required',
        'state' => 'required',
        'country' => 'required',
    ]);

    if ($validator->fails()) {
        $response = [
            'success' => false,
            'error' => $validator->messages()
        ];
        return response()->json($response, 500);
    }

    Contact::create($request->all());

    return [ "success" => true ];
});

Route::get('/contacts', function (Request $request) {
    return Contact::all();
});