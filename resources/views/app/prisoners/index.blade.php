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
                            <a href="{{ route('prisoners.show', $prisoner->id) }}" title="Show">
                                <svg xmlns="http://www.w3.org/2000/svg" style="height: 16px; width: 16px; vertical-align: middle;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2" fill="none" />
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 12c2-5 8-7 10-7s8 2 10 7c-2 5-8 7-10 7s-8-2-10-7z" />
                                </svg>
                            </a>
                            <a href="{{ route('prisoners.edit', $prisoner->id) }}" title="Edit" style="margin-left: 8px;">
                                <svg xmlns="http://www.w3.org/2000/svg" style="height: 16px; width: 16px; vertical-align: middle;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20h9" />
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4 12.5-12.5z" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </x-viewtable>
        </x-main>
    </x-content>
</x-layout>