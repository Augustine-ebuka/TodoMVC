<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\todoController;
 
 


// Routes for API (no guest middleware)
Route::group(['prefix' => 'api'], function () {
    Route::post('/register', [AuthController::class, 'registerPost'])->name('api.register');
    Route::post('/login', [AuthController::class, 'loginPost']);
    // Add other API routes as needed
});

 
Route::group(['middleware' => 'auth'], function () {
    // Route::get('/home', [HomeController::class, 'index']);
    Route::delete('/api/logout', [AuthController::class, 'logout'])->name('api.logout');
});



// Routes for API TODO
Route::group(['prefix' => 'api', 'middleware' => []], function () {
    Route::get('/todo', [TodoController::class, 'index']);
    Route::get('/todo/{id}', [TodoController::class, 'show']);
    Route::post('/todo/create', [TodoController::class, 'store']);
    Route::patch('/todo/{id}', [TodoController::class, 'update']);
    Route::delete('/todo/{id}', [TodoController::class, 'destroy']);
});
