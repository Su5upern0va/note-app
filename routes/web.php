<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Notes\Index;
use App\Livewire\Notes\Form;

Route::get('/', function () {
    return redirect()->route('notes.index');
});

Route::get('/notes', Index::class)->name('notes.index');

Route::get('notes/create', function () {
    return view('notes.create');
})->name('notes.create');

Route::get('notes/{noteId}/edit', function ($noteId) {
    return view('notes.edit', ['noteId' => $noteId]);
})->name('notes.edit');
