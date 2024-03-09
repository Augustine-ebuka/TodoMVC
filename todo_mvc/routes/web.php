<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\todoController;
 
 
Route::get('/', function () {
    return view('login');
});
 
// Routes for web (guest middleware is applied)
Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});

// Routes for API (no guest middleware)
Route::group(['prefix' => 'api'], function () {
    Route::post('/register', [AuthController::class, 'registerPost'])->name('api.register');
    Route::post('/login', [AuthController::class, 'loginPost']);
    // Add other API routes as needed
});

 
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index']);
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
