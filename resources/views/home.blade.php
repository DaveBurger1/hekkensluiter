<x-layout>
    <div class="min-h-screen bg-gray-100 flex flex-col items-center justify-center p-4">
        <div class="w-full max-w-4xl bg-white rounded-lg shadow-md p-6">
            <h1 class="text-3xl font-bold text-center mb-6">Gevangenis Locatie</h1>
            
            <!-- PHOTO CONTENT PLACEHOLDER START -->
            <!-- De foto-inhoud komt hier tussen deze commentaarblokken -->
            
            <div class="mb-8 p-4 border rounded-lg">
                <h2 class="text-xl font-semibold mb-4">Huidige Locatie</h2>
                <div class="space-y-4">
                    <p><span class="font-medium">Naam:</span> Penitentiaire Inrichting Hoornbeeck</p>
                    <p><span class="font-medium">Adres:</span> Van der Duyn van Maasdamweg 15</p>
                    <p><span class="font-medium">Plaats:</span> 2800 Gouda</p>
                    <div class="mt-4 h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                        <!-- PHOTO PLACEHOLDER -->
                        <p class="text-gray-500">Foto van het portaal komt hier</p>
                    </div>
                </div>
            </div>

            <!-- PHOTO CONTENT PLACEHOLDER END -->

            <div class="text-center mt-6">
                <p class="mb-4">Medewerkers kunnen hier inloggen:</p>
                    <a href="{{ url('/app/prisoners') }}" class="text-sm text-gray-700 underline hover:text-gray-900">
                        Inloggen
                    </a>
            </div>
        </div>
    </div>
</x-layout>
