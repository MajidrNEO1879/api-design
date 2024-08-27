<?php

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Route::get('/testing', function(){
//     $items = ["name":"smith",
//     "last name":"samuel"
//     ];
// });


Route::get('/tickets', function (){
    return Ticket::all();
});