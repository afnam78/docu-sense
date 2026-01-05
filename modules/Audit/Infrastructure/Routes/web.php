<?php

use Illuminate\Support\Facades\Route;
use Modules\Audit\Presentation\Livewire\AuditDetail;

Route::get('audit/{hash}', AuditDetail::class)->middleware(['auth:web'])->name('audit.detail');
