<?php

use Illuminate\Support\Facades\Route;
use Modules\File\Presentation\Livewire\FileList;

Route::middleware(['auth:web'])->prefix('files')->group(function () {
    Route::get('/', FileList::class)->name('files.list');
});
