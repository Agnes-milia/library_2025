<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;
use Laravel\Pail\File;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

require __DIR__.'/auth.php';
Route::get("/send-mail", [MailController::class, "index"]);
Route::get("/file-upload", [FileController::class, "index"]);
Route::post("/file-upload", [FileController::class, "store"])->name("file.store");
