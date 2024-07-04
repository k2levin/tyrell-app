<?php

Route::get('info', [\App\Http\Controllers\Api\MainController::class, 'getInfo'])->name('main.info');
Route::post('shuffle-card', [\App\Http\Controllers\Api\MainController::class, 'shuffleCard'])->name('main.shuffle.card');
