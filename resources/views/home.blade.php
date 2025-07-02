<x-layout>
    <x-header>
        <div class="flex items-center space-x-4">
            <div class="flex-grow"></div>
        </div>
    </x-header>

    <div class="min-h-[calc(100vh-10rem)] bg-gray-100 flex flex-col items-center p-4 pt-8">
<<<<<<< HEAD
=======
        <div class="w-full max-w-4xl">
            <h1 class="text-3xl font-bold text-center mb-6">Gevangenis Locatie</h1>
            
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4">Huidige Locatie</h2>
                <div class="space-y-4">
                    <p><span class="font-medium">Naam:</span> Penitentiaire Inrichting Hoornbeeck</p>
                    <p><span class="font-medium">Adres:</span> Van der Duyn van Maasdamweg 15</p>
                    <p><span class="font-medium">Plaats:</span> 2800 Gouda</p>
>>>>>>> c827a1adedba7fb1a66272d44689c45e15fb8fe1
                    
                    <!-- PHOTO PLACEHOLDER -->
                    <img id="gevang" src="{{ Vite::asset('resources/icons/app/Afbeelding2.png') }}" 
                         class="w-full max-w-4xl h-auto mt-4">
                </div>
            </div>
        </div>
    </div>
<<<<<<< HEAD
    <body>
    @include('components.footer')
    </body>


=======

    <footer class="bg-[#5D3621] text-white h-16 w-full flex items-center justify-center">
        &copy; {{ date('Y') }} Penitentiaire Inrichting Hoornbeeck
    </footer>
>>>>>>> c827a1adedba7fb1a66272d44689c45e15fb8fe1
</x-layout>
