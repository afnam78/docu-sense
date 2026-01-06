<?php

use Illuminate\Support\Facades\Route;
use Modules\Audit\Presentation\Livewire\AuditList;

Route::get('audit/{hash}', AuditList::class)->middleware(['auth:web'])->name('audit.detail');
