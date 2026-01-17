<?php

namespace App\Livewire\Notes;

use Livewire\Component;
use App\Models\Note;

class Form extends Component
{
    public $noteId = null;
    public $title = '';
    public $content = '';
    public $is_important = false;

    // Festlegen von Validierungsregeln
    protected $rules = [
        'title' => 'required|min:3',
        'content' => 'required|min:5',
        'is_important' => 'boolean'
    ];

    public function mount($noteId = null)
    {
        if ($noteId)
        {
            $note = Note::findOrFail($noteId);
            $this->noteId = $note->id;
            $this->title = $note->title;
            $this->content = $note->content;
            $this->is_important = $note->is_important;
        }
    }

    public function save()
    {
        $this->validate();

        if ($this->noteId)
        {
            // Update wenn existiert
            $note = Note::find($this->noteId);
            $note->update([
               'title' => $this->title,
               'content' => $this->content,
               'is_important' => $this->is_important
            ]);
            session()->flash('message', 'Notiz wurde aktuallisiert');
        }
        else
        {
            // erstellen, wenn neu
            Note::create([
                'title' => $this->title,
                'content' => $this->content,
                'is_important' => $this->is_important
            ]);
            session()->flash('message', 'Notiz wurde erstellt');
        }

        return redirect()->route('notes.index');
    }

    public function render()
    {
        return view('livewire.notes.form');
    }
}
