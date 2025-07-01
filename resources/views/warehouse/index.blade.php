<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Header Section -->
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold text-green-600">Overzicht Productvoorraden</h1>
                        <div class="flex gap-3">
                            <form action="{{ route('warehouse.index') }}" method="GET" class="flex items-center gap-3">
                                <select class="px-4 py-2 border border-gray-300 rounded-md bg-white text-gray-700" name="category">
                                    <option value="" selected>Selecteer Categorie</option>
                                    <option value="AGF" {{ request('category') == 'AGF' ? 'selected' : '' }}>AGF</option>
                                    <option value="KV" {{ request('category') == 'KV' ? 'selected' : '' }}>KV</option>
                                    <option value="ZPE" {{ request('category') == 'ZPE' ? 'selected' : '' }}>ZPE</option>
                                    <option value="BB" {{ request('category') == 'BB' ? 'selected' : '' }}>BB</option>
                                    <option value="FSKT" {{ request('category') == 'FSKT' ? 'selected' : '' }}>FSKT</option>
                                    <option value="PRW" {{ request('category') == 'PRW' ? 'selected' : '' }}>PRW</option>
                                    <option value="SSKO" {{ request('category') == 'SSKO' ? 'selected' : '' }}>SSKO</option>
                                    <option value="SKCC" {{ request('category') == 'SKCC' ? 'selected' : '' }}>SKCC</option>
                                    <option value="BVH" {{ request('category') == 'BVH' ? 'selected' : '' }}>BVH</option>
                                </select>
                                <button type="submit" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                                    Toon Voorraad
                                </button>
                                @error('category')
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
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border-b">Productnaam</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border-b">Categorie</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border-b">Eenheid</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border-b">Aantal</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border-b">Houdbaarheidsdatum</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border-b">Magazijn</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border-b">Voorraad Details</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @if($products == [])

                                <tr class="bg-[#ffaa0080]">
                                    <td class="px-6 py-4 text-gray-900 border-b text-center" colspan="7">Er zijn geeen producten gevonden</td>
                                </tr>
                                @else
                                @foreach($products as $product)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-900 border-b">{{ $product->product_name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 border-b">{{ $product->category}}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 border-b">{{ $product->packaging_unit}}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 border-b">{{ $product->quantity}}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 border-b">{{ $product->expiration_date }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 border-b">{{ $product->location}}</td>
                                    <td class="px-6 py-4 text-sm border-b">
                                        <button class="w-1/2 h-8 bg-blue-500 text-white rounded hover:bg-blue-600 text-xs">
                                            Details
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>