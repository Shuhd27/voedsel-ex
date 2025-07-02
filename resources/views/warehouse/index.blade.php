<x-app-layout>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 w-3/4 m-auto rounded relative my-6"
        role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif
    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 w-3/4 m-auto  rounded relative my-6"
        role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Header Section -->
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold text-green-600 underline">Overzicht Productvoorraden</h1>
                        <div class="flex w-1/3">
                            <form action="{{ route('warehouse.index') }}" method="GET"
                                class="flex items-center gap-3 w-full">
                                <select class="px-4 py-2 border border-gray-300 rounded-md bg-white text-gray-700 w-1/2"
                                    name="category">
                                    <option value="Nothing" selected>Selecteer Categorie</option>
                                    <option value="AGF" {{ request('category')=='AGF' ? 'selected' : '' }}>AGF</option>
                                    <option value="KV" {{ request('category')=='KV' ? 'selected' : '' }}>KV</option>
                                    <option value="ZPE" {{ request('category')=='ZPE' ? 'selected' : '' }}>ZPE</option>
                                    <option value="BB" {{ request('category')=='BB' ? 'selected' : '' }}>BB</option>
                                    <option value="FSKT" {{ request('category')=='FSKT' ? 'selected' : '' }}>FSKT
                                    </option>
                                    <option value="PRW" {{ request('category')=='PRW' ? 'selected' : '' }}>PRW</option>
                                    <option value="SSKO" {{ request('category')=='SSKO' ? 'selected' : '' }}>SSKO
                                    </option>
                                    <option value="SKCC" {{ request('category')=='SKCC' ? 'selected' : '' }}>SKCC
                                    </option>
                                    <option value="BVH" {{ request('category')=='BVH' ? 'selected' : '' }}>BVH</option>
                                </select>
                                <button type="submit"
                                    class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
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
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border-b">
                                        Productnaam</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border-b">Categorie
                                    </th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border-b">Eenheid
                                    </th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border-b">Aantal
                                    </th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border-b">
                                        Houdbaarheidsdatum</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border-b">Magazijn
                                    </th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border-b">Voorraad
                                        Details</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @if($products == [])

                                <tr class="bg-[#ffaa00ab]">
                                    <td class="px-6 py-4 text-gray-900 border-b text-center" colspan="7">Er zijn geen
                                        producten bekent die behoren bij de geselecteerde productcategorie.</td>
                                </tr>
                                @else
                                @foreach($products as $product)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-900 border-b">{{ $product->product_name }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 border-b">{{ $product->category}}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 border-b">{{ $product->packaging_unit}}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 border-b">{{ $product->quantity}}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 border-b">{{ $product->expiration_date }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 border-b">{{ $product->location}}</td>
                                    <td class="px-6 py-4 text-sm border-b">
                                        <a href="{{route('warehouse.show', $product->product_id)}}"
                                            class="p-3 text-blue-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-journal-text" viewBox="0 0 16 16">
                                                <path
                                                    d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5" />
                                                <path
                                                    d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2" />
                                                <path
                                                    d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="flex justify-end">
                    <div class="flex gap-3 m-4 right-0">

                        <a href="{{ route('dashboard') }}"
                            class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>