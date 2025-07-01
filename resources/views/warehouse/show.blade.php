<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Header -->
                    <h1 class="text-2xl font-bold text-green-600 mb-8">Product Details Aardappel</h1>
                    
                    <!-- Details Table -->
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 border-b border-gray-300 py-3">
                            <div class="text-gray-700 font-medium">Productnaam</div>
                            <div class="text-gray-900">{{ $product->product_name ?? '~' }}</div>
                        </div>
                        
                        <div class="grid grid-cols-2 border-b border-gray-300 py-3">
                            <div class="text-gray-700 font-medium">Houdbaarheidsdatum</div>
                            <div class="text-gray-900">{{ $product->expiration_date ?? '~' }}</div>
                        </div>
                        
                        <div class="grid grid-cols-2 border-b border-gray-300 py-3">
                            <div class="text-gray-700 font-medium">Barcode</div>
                            <div class="text-gray-900">{{ $product->barcode ?? '~' }}</div>
                        </div>
                        
                        <div class="grid grid-cols-2 border-b border-gray-300 py-3">
                            <div class="text-gray-700 font-medium">Magazijn locatie</div>
                            <div class="text-gray-900">{{ $product->location ?? '~' }}</div>
                        </div>
                        
                        <div class="grid grid-cols-2 border-b border-gray-300 py-3">
                            <div class="text-gray-700 font-medium">Ontvangstdatum</div>
                            <div class="text-gray-900">{{ $product->receipt_date ?? '~' }}</div>
                        </div>
                        
                        <div class="grid grid-cols-2 border-b border-gray-300 py-3">
                            <div class="text-gray-700 font-medium">Uitleveringsdatum</div>
                            <div class="text-gray-900">{{ $product->delivery_date ?? '~' }}</div>
                        </div>
                        
                        <div class="grid grid-cols-2 border-b border-gray-300 py-3">
                            <div class="text-gray-700 font-medium">Aantal op voorraad</div>
                            <div class="text-gray-900">{{ $product->quantity ?? '~' }}</div>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex justify-between mt-8">
                        <button class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            Wijzig
                        </button>
                        
                        <div class="flex gap-3">
                            <a href="{{ route('warehouse.index') }}" class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                terug
                            </a>
                            <a href="{{ route('dashboard') }}" class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>