<div>
    <div class="mb-6">
       <h2 class="text-2xl font-bold text-gray-800">
           {{ $noteId ? 'Notiz bearbeiten' : 'Notiz erstellen' }}
       </h2>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form wire:submit="save">
            <!--Title-->
            <div class="mb-4">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">
                    Titel *
                </label>
                <input
                    type="text"
                    id="title"
                    wire:model="title"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') borser-red-500 @enderror"
                    placeholder="Titel der Notiz"
                >
                @error('title')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>
            <!--Content-->
            <div class="mb-4">
                <label for="content" class="block text-gray-700 text-sm font-bold mb-2">
                    Inhalt *
                </label>
                <textarea
                    id="content"
                    wire:model="content"
                    rown="6"
                    class="shadow appearance-none border rounded w-full py-2 px-3 texst-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 @error('content') border-red-500 @enderror"
                    placeholder="Inhalt der Notiz"
                ></textarea>
                @error('content')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!--Wichtig Checkbox-->
            <div class="mb-6">
                <label class="flex items-center">
                    <input
                        type="checkbox"
                        wire:model="is_important"
                        class="rounded border-gray300 text-blue-600 shadow-sm focus:ring-blue-500"
                    >
                    <span class="ml-2 text-gray-700">Als wichtig markieren ⭐</span>
                </label>
            </div>

            <!--Buttons-->
            <div class="flex gap-3">
                <button
                    type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                >
                    {{ $noteId ? 'Aktualisieren' : 'Erstellen' }}
                </button>

                <a
                    href="{{ route('notes.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                >
                    Abbrechen
                </a>
            </div>
        </form>
    </div>
</div>
