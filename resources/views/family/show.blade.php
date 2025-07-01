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
                        <th class="text-left p-2 border-b">Totaal aantaal personen</th>
                        <td class="p-2 border-b">{{ $family->TotaalAantalPersonen }}</td>
                    </tr>
                </tbody>
            </table>

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