<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Notes\Index;
use App\Livewire\Notes\Form;

Route::get('/', Index::class)->name('notes.index');
Route::get('/notes/create', Form::class)->name('notes.create');
Route::get('/notes/{noteId}/edit', Form::class)->name('notes.edit');
