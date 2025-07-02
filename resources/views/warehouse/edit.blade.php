<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Header -->
                    <h1 class="text-2xl font-bold text-green-600 mb-8 underline">Wijzig Product Details Aardappel</h1>
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                            <span class="block sm:inline px-4">{{ session('success') }}</span>
                        </div>
                    @endif
                    @error('quantity')
                        <div class="bg-red-100 border border-red-400 text-red-700 px
                            -4 py-3 rounded relative mb-6" role="alert">
                            <span class="block sm:inline px-4">De productgegevens kunnen niet worden gewijzigd</span>
                        </div>
                    @enderror
                    <!-- Edit Form -->
                    <form action="{{ route('warehouse.update', $product->product_id ?? 1) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="space-y-4">
                            <div class="grid grid-cols-2 gap-4 py-3">
                                <label class="text-gray-700 font-medium">Productnaam</label>
                                <input type="text" value="{{ $product->product_name }}" 
                                       class="px-3 py-2 border border-gray-300 rounded-md bg-blue-50" readonly>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4 py-3">
                                <label class="text-gray-700 font-medium">Houdbaarheidsdatum</label>
                                <input type="text" value="{{ $product->expiration_date}}" 
                                       class="px-3 py-2 border border-gray-300 rounded-md bg-blue-50" readonly>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4 py-3">
                                <label class="text-gray-700 font-medium">Barcode</label>
                                <input type="text" value="{{ $product->barcode}}" 
                                       class="px-3 py-2 border border-gray-300 rounded-md bg-blue-50" readonly>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4 py-3">
                                <label class="text-gray-700 font-medium">Magazijn Locatie</label>
                                <select name="location" class="px-3 py-2 border border-gray-300 rounded-md bg-white">
                                    <option value="Berlicum" {{ old('location', $product->location ?? '') == 'Berlicum' ? 'selected' : '' }}>Berlicum</option>
                                    <option value="Rosmalen" {{ old('location', $product->location ?? '') == 'Rosmalen' ? 'selected' : '' }}>Rosmalen</option>
                                    <option value="Sint-MichelsGestel" {{ old('location', $product->location ?? '') == 'Sint-MichelsGestel' ? 'selected' : '' }}>Sint-MichelsGestel</option>
                                    <option value="Middelrode" {{ old('location', $product->location ?? '') == 'Middelrode' ? 'selected' : '' }}>Middelrode</option>
                                    <option value="Schijndel" {{ old('location', $product->location ?? '') == 'Schijndel' ? 'selected' : '' }}>Schijndel</option>
                                    <option value="Gemonde" {{ old('location', $product->location ?? '') == 'Gemonde' ? 'selected' : '' }}>Gemonde</option>
                                    <option value="Den Bosch" {{ old('location', $product->location ?? '') == 'Den Bosch' ? 'selected' : '' }}>Den Bosch</option>
                                    <option value="Heeswijk Dinther" {{ old('location', $product->location ?? '') == 'Heeswijk Dinther' ? 'selected' : '' }}>Heeswijk Dinther</option>
                                    <option value="Vught" {{ old('location', $product->location ?? '') == 'Vught' ? 'selected' : '' }}>Vught</option>

                                </select>
                                @error('location')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4 py-3">
                                <label class="text-gray-700 font-medium">Ontvangstdatum</label>
                                <input type="date"  value="{{ $product->receipt_date }}" 
                                       class="px-3 py-2 border border-gray-300 rounded-md bg-blue-50" readonly>
                           </div>
                            
                            <div class="grid grid-cols-2 gap-4 py-3">
                                <label class="text-gray-700 font-medium">Aantal uitgeleverde producten:</label>
                               <input type="number" name="quantity" value="{{ old('quantity') }}" 
                                       class="px-3 py-2 border border-gray-300 rounded-md bg-white">
                                        @error('quantity')
                                             <span class="text-red-500 text-xs">{{ $message }}</span>
                                         @enderror
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4 py-3">
                                <label class="text-gray-700 font-medium">Uitleveringsdatum</label>
                                <input type="date" name="delivery_date" value="{{ old('delivery_date') }}" 
                                       class="px-3 py-2 border border-gray-300 rounded-md bg-white">
                                       @error('delivery_date')
                                           <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4 py-3">
                                <label class="text-gray-700 font-medium">Aantal op voorraad</label>
                                <input type="number" value="{{ $product->quantity}}" 
                                 class="px-3 py-2 border border-gray-300 rounded-md bg-blue-50" readonly>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="flex justify-between mt-8">
                            <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                Wijzig Product Details
                            </button>
                            
                            <div class="flex gap-3">
                                <a href="{{ route('warehouse.show', $product->product_id ?? 1) }}" class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                    terug
                                </a>
                                <a href="{{ route('dashboard') }}" class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                    home
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if(session('redirect_to_show'))
<script>
    setTimeout(function() {
        window.location.href = "{{ route('warehouse.show', ['id' => $product->product_id]) }}";
    }, 3000);
</script>
@endif
</x-app-layout>