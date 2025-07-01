<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Header Section -->
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold text-green-600">Overzicht Voedselpaketten</h1>
                        <div class="flex gap-3">
                            <form action="{{ route('family.index') }}" method="GET" class="flex items-center gap-3">
                                <select name="dietary_preference" id="dietary_preference">
                                    <option value=""> Selecteer eetwens </option>
                                    <option value="GeenVarken" {{ request('dietary_preference') == 'GeenVarken' ? 'selected' : '' }}>GeenVarken</option>
                                    <option value="Veganistisch" {{ request('dietary_preference') == 'Veganistisch' ? 'selected' : '' }}>Veganistisch</option>
                                    <option value="Vegetarisch" {{ request('dietary_preference') == 'Vegetarisch' ? 'selected' : '' }}>Vegetarisch</option>
                                    <option value="Omnivoor" {{ request('dietary_preference') == 'Omnivoor' ? 'selected' : '' }}>Omnivoor</option>
                                </select>

                                <button type="submit" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                                    Toon Gezinnen
                                </button>
                                @error('dietary_preferenc')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </form>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto border-collapse">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border-b">Gezinsnaam</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border-b">Omschrijving</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border-b">Volwassenen</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border-b">Kinderen</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border-b">Babys</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border-b">Vertegenwoordiger</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border-b">Voedselpakket Details</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @if(empty($families))
                                <tr class="bg-[#ffaa0080]">
                                    <td class="px-6 py-4 text-gray-900 border-b text-center" colspan="7">
                                        Er zijn geen gezinnen bekend die de geselecteerde eetwens hebben
                                    </td>
                                </tr>
                                @else
                                @foreach($families as $family)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-900 border-b">{{ $family->Gezinsnaam }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 border-b">{{ $family->Omschrijving}}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 border-b">{{ $family->Volwassenen}}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 border-b">{{ $family->Kinderen}}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 border-b">{{ $family->Babys }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 border-b">{{ $family->Vertegenwoordiger }}</td>
                                    <td class="px-6 py-4 text-sm border-b">
                                        <button class="w-1/2 h-8 bg-blue-500 text-white rounded hover:bg-blue-600 text-xs">
                                            Details
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>

                            <!-- home pagina knoop -->
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-right">
                                    <a href="{{ url('home') }}" class="text-blue-500 hover:underline">Home</a>
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>