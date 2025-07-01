<x-app-layout>
    <main class="mt-10">
        <section class="w-full">
            <div class="bg-[#838383] w-1/3 p-4 rounded-r-lg">
                <h3 class="w-full text-end text-2xl text-white">
                    Voedselpakketten beheren
                </h3>
            </div>

            @if(session('success'))
            <div class="bg-[#B5D2AA] w-1/3 p-4 rounded-r-lg mt-4">
                <h3 class="w-full text-end text-2xl text-white">
                    {{ session('success') }}
                </h3>
            </div>
            @elseif(session('error'))
            <div class="bg-[#F88080] w-1/3 p-4 rounded-r-lg mt-4">
                <h3 class="w-full text-end text-2xl text-white">
                    {{ session('error') }}
                </h3>
            </div>
            @endif
        </section>

        <section class="my-10" id="tableSQL">
            <table class="bg-[#FFF8E6] rounded-2xl table m-auto w-3/4 text-[#4F4F4F]">
                <thead class="bg-[#CEEFC1]">
                    <tr>
                        <th class="border-r-2 border-[#D0D0D0]">Gezinsnaam</th>
                        <th class="border-r-2 border-[#D0D0D0]">Omschrijving</th>
                        <th class="border-r-2 border-[#D0D0D0]">Volwassenen</th>
                        <th class="border-r-2 border-[#D0D0D0]">Kinderen</th>
                        <th class="border-r-2 border-[#D0D0D0]">Babys</th>
                        <th class="border-r-2 border-[#D0D0D0]">Vertegenwoordiger</th>
                        <th class="border-r-2 border-[#D0D0D0]">Voedselpakket details</th>
                    </tr>
                </thead>
                <tbody>
                    @if($foodpackages->isEmpty())
                    <tr>
                        <td colspan="5" class="bg-[#F88080] text-center p-4">
                            Geen voedselpakketten gevonden.
                        </td>
                    </tr>
                    @else
                    @foreach($foodpackages as $package)
                    <tr>
                        <td class="p-2 border-t-2 border-[#D0D0D0]">
                            <a class="underline" href="{{ route('foodpackages.show', $package->id) }}">
                                {{ $package->name }}
                            </a>
                        </td>
                        <td class="p-2 border-t-2 border-l-2 border-[#D0D0D0]">{{ $package->item_count }}</td>
                        <td class="p-2 border-t-2 border-l-2 border-[#D0D0D0]">{{ $package->updated_at->format('d-m-Y') }}</td>
                        <td class="p-2 border-t-2 border-x-2 border-[#D0D0D0] text-white">
                            <a href="{{ route('foodpackages.edit', $package->id) }}"
                                class="p-1 bg-[#9BC8F2] block text-center rounded">Wijzigen</a>
                        </td>
                        <td class="p-2 border-t-2 border-[#D0D0D0] text-white">
                            <button type="button"
                                class="p-1 bg-[#F88080] block text-center w-full rounded delete-btn"
                                data-package-id="{{ $package->id }}"
                                data-package-name="{{ $package->name }}">
                                Verwijderen
                            </button>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </section>

        <section class="m-10">
            {{ $foodpackages->links() }}
        </section>
    </main>

    <!-- Verwijder Bevestiging Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-8 max-w-md w-full">
            <div class="flex flex-col">
                <h2 class="text-xl font-bold mb-4 text-[#4F4F4F]">Voedselpakket verwijderen</h2>
                <p class="mb-6 text-gray-700">
                    Weet je zeker dat je <span id="packageName" class="font-semibold"></span> wilt verwijderen?
                    Deze actie kan niet ongedaan gemaakt worden.
                </p>

                <div class="flex justify-end space-x-4">
                    <button type="button" id="cancelDelete"
                        class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">
                        Annuleren
                    </button>

                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-[#F88080] text-white px-4 py-2 rounded hover:bg-red-700">
                            Verwijderen
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const deleteModal = document.getElementById('deleteModal');
        const deleteButtons = document.querySelectorAll('.delete-btn');
        const cancelDelete = document.getElementById('cancelDelete');
        const deleteForm = document.getElementById('deleteForm');
        const packageNameSpan = document.getElementById('packageName');

        deleteButtons.forEach(button => {
            button.addEventListener('click', () => {
                const packageId = button.getAttribute('data-package-id');
                const packageName = button.getAttribute('data-package-name');
                packageNameSpan.textContent = packageName;
                deleteForm.action = `/foodpackages/${packageId}/delete`;
                deleteModal.classList.remove('hidden');
            });
        });

        cancelDelete.addEventListener('click', () => {
            deleteModal.classList.add('hidden');
        });

        deleteModal.addEventListener('click', (e) => {
            if (e.target === deleteModal) {
                deleteModal.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>