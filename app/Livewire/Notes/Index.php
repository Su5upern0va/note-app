<?php

namespace App\Livewire\Notes;

use Livewire\Component;
use App\Models\Note;

class Index extends Component
{
    public function render()
    {
        return view('livewire.notes.index', [
            'notes' => Note::orderBy('is_important', 'desc')->latest()->get()
        ]);
    }

    public function delete($id)
    {
        Note::find($id)->delete();
        session()->flash('message', 'Notiz erfolgreich gelöscht');
    }
}
