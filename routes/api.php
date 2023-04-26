<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::middleware('auth:sanctum')->get(
    '/user',
    function (Request $request) {
        return $request->user();
    }
);


Route::get('/users', [PageController::class, 'getUsers']);
Route::post('/users', [PageController::class, 'postUser']);
Route::get('/users/{id}', [PageController::class, 'getUsersById']);
Route::post('/users/login', [PageController::class, 'userLogin']);



Route::get('/messages', [PageController::class, 'getMessages']);
Route::get('/messages/{id}', [PageController::class, 'getMessagesById']);
Route::get('/messages/users/{user_one_id}&&{user_two_id}', [PageController::class, 'getRecentMessages'])
->withoutMiddleware('throttle:api')
    ->middleware('throttle:500:1');
Route::post('/messages', [PageController::class, 'postMessage']);

    

?>