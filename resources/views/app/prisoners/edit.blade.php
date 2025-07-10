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
                        <td>Tussenvoegsel</td>
                        <td><input type="text" name="tussenvoegsel" value="{{ $profile->tussenvoegsel ?? '' }}"></td>
                    </tr>
                    <tr>
                        <td>Achternaam</td>
                        <td><input type="text" name="last_name" value="{{ $profile->last_name ?? '' }}"></td>
                    </tr>
                    <tr>
                        <td>Vleugel</td>
                        <td>
                            <select name="wing" >
                                <option value="A" {{ ($profile->currentCell->wing ?? '') == 'A' ? 'selected' : '' }}>Vleugel A</option>
                                <option value="B" {{ ($profile->currentCell->wing ?? '') == 'B' ? 'selected' : '' }}>Vleugel B</option>
                                <option value="C" {{ ($profile->currentCell->wing ?? '') == 'C' ? 'selected' : '' }}>Vleugel C</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Celnummer</td>
                        <td>
                            <input type="text" name="cell_number" value="{{ $profile->currentCell->cell_number ?? '' }}">
                            @error('cell_number')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </td>
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
                        <td>
                            <input type="text" name="date_of_birth" 
                                   value="{{ isset($profile->date_of_birth) ? \Carbon\Carbon::parse($profile->date_of_birth)->format('d/m/Y') : '' }}"
                                   placeholder="DD/MM/YYYY">
                            @error('date_of_birth')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td>Geboorteplaats</td>
                        <td><input type="text" name="place_of_birth" value="{{ $profile->place_of_birth ?? '' }}">
                        </td>
                    </tr>
                    <tr>
                        <td>Delict</td>
                        <td><input type="text" name="delict" value="{{ $profile->delict ?? '' }}"></td>
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
