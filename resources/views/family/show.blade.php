<x-app-layout>
    <div class="py-12 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-6 text-green-600">Voedselpakket Details: {{ $family->Gezinsnaam }}</h1>

            <!-- Feedbackmelding na statuswijziging -->
            @if(session('success'))
            <div id="success-message" class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
            @endif

            <table class="w-full mb-6 text-sm border-collapse">
                <tbody>
                    <tr>
                        <th class="text-left p-2 border-b">Gezinsnaam</th>
                        <td class="p-2 border-b">{{ $family->Gezinsnaam }}</td>
                    </tr>
                    <tr>
                        <th class="text-left p-2 border-b">Omschrijving</th>
                        <td class="p-2 border-b">{{ $family->Omschrijving }}</td>
                    </tr>
                    <tr>
                        <th class="text-left p-2 border-b">Volwassenen</th>
                        <td class="p-2 border-b">{{ $family->Volwassenen }}</td>
                    </tr>
                    <tr>
                        <th class="text-left p-2 border-b">Kinderen</th>
                        <td class="p-2 border-b">{{ $family->Kinderen }}</td>
                    </tr>
                    <tr>
                        <th class="text-left p-2 border-b">Babys</th>
                        <td class="p-2 border-b">{{ $family->Babys }}</td>
                    </tr>
                    <tr>
                        <th class="text-left p-2 border-b">Vertegenwoordiger</th>
                        <td class="p-2 border-b">{{ $family->Vertegenwoordiger }}</td>
                    </tr>
                    <tr>
                        <th class="text-left p-2 border-b">Status Voedselpakket</th>
                        <td class="p-2 border-b">
                            {{ 
                                ($family->Status === 'NietUitgereikt' || $family->Status === 'NietMeerIngeschreven') 
                                ? 'Niet uitgereikt' 
                                : ($family->Status === 'Uitgereikt' ? 'Uitgereikt' : 'Niet uitgereikt') 
                            }}
                        </td>
                    </tr>
                    <tr>
                        <th class="text-left p-2 border-b">Datum Uitgifte</th>
                        <td class="p-2 border-b">{{ $family->DatumUitgifte ?? '-' }}</td>
                    </tr>
                </tbody>
            </table>

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

            <div class="mt-6 text-right">
                <a href="{{ route('family.index') }}" class="text-blue-600 hover:underline">Terug naar overzicht</a>
            </div>
        </div>
    </div>

    @if(session('success'))
    <script>
        // Na 3 seconden terug naar overzicht
        setTimeout(() => {
            window.location.href = "{{ route('family.index') }}";
        }, 3000);
    </script>
    @endif
</x-app-layout>