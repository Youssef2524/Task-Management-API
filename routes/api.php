
<?php 
  
use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
  
Route::group([ 
    'middleware' => 'api', 
    'prefix' => 'auth' 
], function ($router) { 
    Route::post('/register', [AuthController::class, 'register'])->name('register'); 
    Route::post('/login', [AuthController::class, 'login'])->name('login'); 
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout'); 
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh'); 
    Route::post('/me', [AuthController::class, 'me'])->middleware('auth:api')
    ->name('me'); 
}); 
// User routes
Route::apiResource('users', UserController::class);
Route::post('users/{user}/restoreUser', [UserController::class, 'restoreUser']);
Route::delete('users/{user}/forceDelete', [UserController::class, 'forceDelete']);

// Task routes

Route::apiResource('tasks', TaskController::class);
Route::post('tasks/{task}/assign', [TaskController::class, 'assign']);
Route::post('tasks/{task}/restore', [TaskController::class, 'restoreTask']);
Route::delete('tasks/{task}/forceDelete', [TaskController::class, 'forceDeleteTask']);
