<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\todoController;
 
 
Route::get('/', function () {
    return view('login');
});
 
Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});
 
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index']);
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});
Route::get('/items', [todoController::class, 'index']);
Route::group(['middleware' => 'guest'], function(){
    Route::get('/todo', [todoController::class, 'index']);
    Route::get('/todo/{id}', [todoController::class, 'show']);
    Route::post('/todo/create',[todoController::class, 'store']);
    Route::patch('/todo/{id}' , [todoController::class, 'update']);
    Route::delete('/todo/{id}', [todoController::class, 'destroy'] );
});
