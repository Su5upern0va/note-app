<?php

namespace Tests\Feature;

use App\Livewire\Notes\Form;
use App\Livewire\Notes\Index;
use App\Models\Note;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class NoteManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_see_notes_on_index_page()
    {
        $note = Note::factory()->create(['title' => 'Test Notiz']);

        Livewire::test(Index::class)
            ->assertSee('Test Notiz');
    }

    public function test_notes_are_sorted_by_importance()
    {
        $normalNote = Note::factory()->create(['is_important' => false, 'title' => 'Normal Note']);
        $importantNote = Note::factory()->create(['is_important' => true, 'title' => 'Important Note']);

        Livewire::test(Index::class)
            ->assertSeeInOrder(['Important Note', 'Normal Note']);
    }

    public function test_can_create_note()
    {
        Livewire::test(Form::class)
            ->set('title', 'Neue Notiz')
            ->set('content', 'Inhalt der neuen Notiz')
            ->set('is_important', true)
            ->call('save')
            ->assertRedirect(route('notes.index'));

        $this->assertTrue(Note::whereTitle('Neue Notiz')->exists());
        $this->assertTrue(Note::whereTitle('Neue Notiz')->first()->is_important);
    }

    public function test_validation_works_for_creating_notes()
    {
        Livewire::test(Form::class)
            ->set('title', 'ab') // Zu kurz
            ->set('content', '') // Erforderlich
            ->call('save')
            ->assertHasErrors(['title' => 'min', 'content' => 'required']);
    }

    public function test_can_edit_note()
    {
        $note = Note::factory()->create(['title' => 'Alte Notiz']);

        Livewire::test(Form::class, ['noteId' => $note->id])
            ->assertSet('title', 'Alte Notiz')
            ->set('title', 'Geänderte Notiz')
            ->call('save')
            ->assertRedirect(route('notes.index'));

        $this->assertEquals('Geänderte Notiz', $note->refresh()->title);
    }

    public function test_can_delete_note()
    {
        $note = Note::factory()->create();

        Livewire::test(Index::class)
            ->call('delete', $note->id);

        $this->assertDatabaseMissing('notes', ['id' => $note->id]);
    }
}
