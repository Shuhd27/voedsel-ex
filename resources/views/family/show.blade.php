<x-app-layout>
    <div class="py-12 w-2/3 mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-6 text-green-600 underline">Overzicht voedselpakketten</h1>

            <!-- Feedbackmelding na statuswijziging -->
            @if(session('success'))
            <div id="success-message" class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
            @endif
            @if(session('error'))
            <div id="error-message" class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                {{ session('error') }}
            </div>
            @endif

            <table class="w-full mb-6 text-sm border-collapse">
                <tbody>
                    <tr>
                        <th class="text-left p-2 border-b">Naam:</th>
                        <td class="p-2 border-b">{{ $family->Gezinsnaam }}</td>
                    </tr>
                    <tr>
                        <th class="text-left p-2 border-b">Omschrijving:</th>
                        <td class="p-2 border-b">{{ $family->Omschrijving }}</td>
                    </tr>
                    <tr>
                        <th class="text-left p-2 border-b">Totaal aantaal personen:</th>
                        <td class="p-2 border-b">{{ $family->TotaalAantalPersonen }}</td>
                    </tr>
                </tbody>
            </table>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border-b">Pakketnummer</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border-b">Datum samenstelling</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border-b">Datum uitgifte</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border-b">Status</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border-b">Aantal prodcuten</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border-b">Wijzig status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @if(empty($food_packages))
                        <tr class="bg-[#ffaa0080]">
                            <td class="px-6 py-4 text-gray-900 border-b text-center" colspan="7">
                                Er zijn geen gezinnen bekend
                            </td>
                        </tr>
                        @else
                        @foreach($food_packages as $package)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-900 border-b">{{ $package->package_number }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900 border-b">{{ $package->DatumSamenstelling }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900 border-b">{{ $package->DatumUitgifte }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900 border-b">{{ $package->Status }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900 border-b">{{ $package->AantalProducten }}</td>
                            <td class="px-6 py-4 text-sm border-b">
                                <a href="{{ route('family.edit', $family->id) }}"
                                    class="w-1/2 h-8 flex justify-center items-center text-blue-500 text-xs">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                    </svg>
                                </a>

                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>

                <div class="px-6 py-4 text-right">
                    <a href="{{ route('family.index') }}" class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Terug</a>
                    <a href="{{ route('dashboard') }}" class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Home</a>
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
</x-app-layout>