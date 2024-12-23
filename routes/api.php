<?php

// routes/api.php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Route::prefix('api')->group(function () {
// Route for creating a new user
Route::post('/users', [UserController::class, 'create']);

// Route for getting the list of users
Route::get('/users', [UserController::class, 'index']);
//});
