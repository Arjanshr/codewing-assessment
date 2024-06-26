<?php

use App\Http\Controllers\GithubLoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Upload File Routes
    Route::post('/upload-json',[UploadController::class, 'uploadAction'])->name('upload_json');
});

Route::get('/auth/github',[GithubLoginController::class,'redirect'])->name('github.login');
Route::get('/auth/github/callback',[GithubLoginController::class,'callback']);

require __DIR__.'/auth.php';
