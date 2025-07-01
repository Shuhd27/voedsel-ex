<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Header Section -->
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold text-green-600">Overzicht Productvoorraden</h1>
                        <div class="flex gap-3">
                            <select class="px-4 py-2 border border-gray-300 rounded-md bg-white text-gray-700">
                                <option>Selecteer Categorie</option>
                                <option>Groenten</option>
                                <option>Fruit</option>
                                <option>Zuivel</option>
                            </select>
                            <button class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                                Toon Voorraad
                            </button>
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