<x-layout>
    <x-header></x-header>
    <x-content>
        <x-sidebar>
            @include('components.parts.sidebar-items')
        </x-sidebar>
        <x-main>
            <form action=" {{ route('prisoners.store') }} " method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $prisoner->id }}">
                <x-viewtable>
                    <x-slot name="head">
                        <tr>
                            <th>Veld</th>
                            <th>Waarde</th>
                        </tr>
                    </x-slot>
                    <tr>
                        <td>Voornaam</td>
                        <td><input type="text" name="first_name" value="{{ $profile->first_name ?? '' }}"></td>
                    </tr>
                    <tr>
                        <td>Achternaam</td>
                        <td><input type="text" name="last_name" value="{{ $profile->last_name ?? '' }}"></td>
                    </tr>
                    <tr>
                        <td>BSN-nummer</td>
                        <td><input type="text" name="bsn" value="{{ $profile->bsn ?? '' }}"></td>
                    </tr>
                    <tr>
                        <td>Straat + postcode</td>
                        <td><input type="text" name="address" value="{{ $profile->address ?? '' }}"></td>
                    </tr>
                    <tr>
                        <td>Woonplaats</td>
                        <td><input type="text" name="city" value="{{ $profile->city ?? '' }}"></td>
                    </tr>
                    <tr>
                        <td>Geboortedatum</td>
                        <td><input type="text" name="date_of_birth" value="{{ $profile->date_of_birth ?? '' }}"></td>
                    </tr>
                    <tr>
                        <td>Geboorteplaats</td>
                        <td><input type="text" name="place_of_birth" value="{{ $profile->place_of_birth ?? '' }}">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"> <input type="submit" value="Opslaan">
                        </td>
                    </tr>
                </x-viewtable>
            </form>
        </x-main>
    </x-content>
</x-layout>