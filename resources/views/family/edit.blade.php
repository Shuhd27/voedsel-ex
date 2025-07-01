<x-app-layout>
    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Fout!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
        @endif
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px
        -4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Succes!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Formulier om status te wijzigen -->
                    <form method="POST" action="{{ route('family.update', $family->id) }}">
                        @csrf
                        @method('PUT')

                        <label for="status" class="block mb-2 font-semibold">Wijzig status voedselpakket:</label>
                        <select name="status" id="status" class="w-full border rounded p-2 mb-4">
                            <option value="Niet Uitgereikt" {{ (($family->Status ?? 'NietUitgereikt') === 'NietUitgereikt') ? 'selected' : '' }}>Niet Uitgereikt</option>
                            <option value="Uitgereikt" {{ ($family->Status ?? '') === 'Uitgereikt' ? 'selected' : '' }}>Uitgereikt</option>
                        </select>

                        @error('status')
                        <p class="text-red-500 text-xs mb-4">{{ $message }}</p>
                        @enderror

                        <button type="submit"
                            class="px-4 py-2 bg-green-600 text-black rounded hover:bg-green-700 transition">
                            Wijzig status voedselpakket
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>