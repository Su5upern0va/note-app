<div>
    <div class="mb-6 flex jutify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800">Alle Notizen</h2>
        <a href="{{ route('notes.create') }}"
           class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
            + Neue Notiz
        </a>
    </div>

    @if($notes->isEmpty())
        <div class="bg-white rounded-lg shadow p-6 text-center text-gray-500">
            Aktuell gibt es noch keine Notiz. Erstelle deine erste Notiz!
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($notes as $note)
                <div class="bg-white rounded-lg shadow-md p-5 {{ $note->is_important ? 'border-l-4 border-yellow-400' : '' }}">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="text-lg font-semibold text-gray-800 flex-1">
                            {{ $note->title }}
                            @if($note->is_important)
                                <span class="text-yellow-400 ml-2">⭐</span>
                            @endif
                        </h3>
                    </div>

                    <p class="text-gray-600 mb-4 line-clamp-3">{{ $note->content }}</p>

                    <div class="text-xs text-gray-400 mb-3">
                        {{ $note->created_at->format('d.m.Y H:i') }}
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('notes.edit', $note->id) }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white text-sm py-1 px-3 rounded">
                            Bearbeiten
                        </a>
                        <button wire:click="delete({{ $note->id }})"
                                wire:confirm="Möchtest du die Notiz wirklich löschen?">
                                class="bg-red-500 hover:bg-red-600 text-white text-sm py-1 px-3 rounded"
                            Löschen
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
