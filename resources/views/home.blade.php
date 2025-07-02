<x-layout>
    <x-header>
        <div class="flex items-center space-x-4">
            <div class="flex-grow"></div>
        </div>
    </x-header>

    <div class="min-h-[calc(100vh-10rem)] bg-gray-100 flex flex-col items-center p-4 pt-8">
                    
                    <!-- PHOTO PLACEHOLDER -->
                    <img id="gevang" src="{{ Vite::asset('resources/icons/app/Afbeelding2.png') }}" 
                         class="w-full max-w-4xl h-auto mt-4">
                </div>
            </div>
        </div>
    </div>
    <body>
    @include('components.footer')
    </body>


</x-layout>
