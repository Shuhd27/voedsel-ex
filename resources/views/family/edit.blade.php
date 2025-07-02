<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Formulier om status te wijzigen -->
                    <form method="POST" action="{{ route('family.update', $family->id) }}">
                        @csrf
                        @method('PUT')

                        <label for="status" class="block mb-2 text-2xl font-bold text-green-600 underline">Wijzig voedselpakket status</label>
                        <select name="status" id="status" class="w-full border rounded p-2 mb-4">
                            <option value="Niet Uitgereikt" {{ (($family->Status ?? 'NietUitgereikt') === 'NietUitgereikt') ? 'selected' : '' }}>Niet Uitgereikt</option>
                            <option value="Uitgereikt" {{ ($family->Status ?? '') === 'Uitgereikt' ? 'selected' : '' }}>Uitgereikt</option>
                        </select>
                        @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                        @endif
                        @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                        @endif
                        <br>
                        @error('status')
                        <p class="text-red-500 text-xs mb-4">{{ $message }}</p>
                        @enderror

                        <button type="submit"
                            class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                            Wijzig status voedselpakket
                        </button>
                    </form>
                    <div class="px-6 py-4 text-right">
                        <a href="{{ route('family.show', $family->id) }}" class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Terug</a>
                        <a href="{{ route('dashboard') }}" class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
    <script>
        // Na 3 seconden terug naar overzicht
        setTimeout(() => {
            window.location.href = "{{ route('family.show', $family->id) }}";
        }, 3000);
    </script>
    @endif
    @if(session('error'))
    <script>
        // Na 3 seconden terug naar overzicht
        setTimeout(() => {
            window.location.href = "{{ route('family.show', $family->id) }}";
        }, 3000);
    </script>
    @endif
</x-app-layout>