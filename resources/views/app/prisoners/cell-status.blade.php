<x-layout>
    <x-header></x-header>
    <x-content>
        <x-sidebar>
            @include('components.parts.sidebar-items')
        </x-sidebar>
        <x-main>
            <h1 class="text-xl font-bold mb-4">Cell Status Overview</h1>
            
            <div class="grid grid-cols-3 gap-4">
                @foreach ($cells as $wing => $wingCells)
                    <div class="bg-white p-4 rounded shadow">
                        <h2 class="font-bold text-lg mb-2">Wing {{ $wing }}</h2>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach ($wingCells as $cellNumber => $occupation)
                                <div class="p-2 border rounded 
                                    {{ $occupation ? 'bg-red-100' : 'bg-green-100' }}">
                                    <div class="font-semibold">
                                        Cell {{ $wing }}{{ $cellNumber }}
                                    </div>
                                    <div>
                                        Status: {{ $occupation ? 'Occupied' : 'Available' }}
                                    </div>
                                    @if($occupation)
                                    <div class="text-sm">
                                        By: {{ $occupation->prisoner->profile->full_name }}
                                    </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </x-main>
    </x-content>
</x-layout>
