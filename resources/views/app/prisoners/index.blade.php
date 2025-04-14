    <x-layout>
    <x-header></x-header>
    <x-content>
        <x-sidebar>
            @include('components.parts.sidebar-items')
        </x-sidebar>
        <x-main>
            <div class="mb-4">
                <a href="{{ route('prisoners.create') }}" class="btn btn-primary">
                    + Add Prisoner
                </a>
            </div>
            <x-viewtable>
                <x-slot name="head">
                    <tr>
                        <th>Naam</th>
                        <th>Geboortedatum</th>
                        <th>Woonplaats</th>
                        <th>Actie</th>
                    </tr>
                </x-slot>
                @foreach ($prisoners as $prisoner)
                    <tr>
                        <td>{{ $prisoner->profile?->first_name ?? '' }} {{ $prisoner->profile?->tussenvoegsel ?? '' }} {{ $prisoner->profile?->last_name ?? '' }}</td>
                        <td>{{ $prisoner->profile?->date_of_birth ?? 'Onbekend' }}</td>
                        <td>{{ $prisoner->profile?->city ?? 'Onbekend' }}</td>
                        <td>
                            <a href="{{ route('prisoners.show', $prisoner->id) }}">O</a>
                            <a href="{{ route('prisoners.edit', $prisoner->id) }}">I</a>
                        </td>
                    </tr>
                @endforeach
            </x-viewtable>
        </x-main>
    </x-content>
</x-layout>