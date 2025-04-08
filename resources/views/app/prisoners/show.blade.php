<x-layout>
    <x-header></x-header>
    <x-content>
        <x-sidebar>
            @include('components.parts.sidebar-items')
        </x-sidebar>
        <x-main>
            <x-viewtable>
                <x-slot name="head">
                    <tr>
                        <th>Veld</th>
                        <th>Waarde</th>
                    </tr>
                </x-slot>
                <tr>
                    <td>Voornaam</td>
                    <td>{{ $profile->first_name }}</td>
                </tr>
                <tr>
                    <td>Achternaam</td>
                    <td>{{ $profile->last_name }}</td>
                </tr>
                <tr>
                    <td>BSN-nummer</td>
                    <td>{{ $profile->bsn }}</td>
                </tr>
                <tr>
                    <td>Adres</td>
                    <td>{{ $profile->address . ', ' . $profile->city }}</td>
                </tr>
                <tr>
                    <td>Geboortedatum</td>
                    <td>{{ $profile->date_of_birth }}</td>
                </tr>
                <tr>
                    <td>Geboorteplaats</td>
                    <td>{{ $profile->place_of_birth }}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <a href="{{ route('prisoners.edit', $prisoner->id) }}">Bewerken</a>
                    </td>
                </tr>
            </x-viewtable>
        </x-main>
    </x-content>
</x-layout>