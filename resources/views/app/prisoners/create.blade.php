<x-layout>
    <x-header></x-header>
    <x-content>
        <x-sidebar>
            @include('components.parts.sidebar-items')
        </x-sidebar>
        <x-main>
            <form action="{{ route('prisoners.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <x-viewtable>
                    <x-slot name="head">
                        <tr>
                            <th>Veld</th>
                            <th>Waarde</th>
                        </tr>
                    </x-slot>
                    <tr>
                        <td>Foto</td>
                        <td><input type="file" name="photo" accept="image/*"></td>
                    </tr>
                    <tr>
                        <td>Voornaam</td>
                        <td><input type="text" name="first_name" required></td>
                    </tr>
                    <tr>
                        <td>Tussenvoegsel</td>
                        <td><input type="text" name="tussenvoegsel"></td>
                    </tr>
                    <tr>
                        <td>Achternaam</td>
                        <td><input type="text" name="last_name" required></td>
                    </tr>
                    <tr>
                        <td>Vleugel</td>
                        <td>
                            <select name="wing" required>
                                <option value="A">Vleugel A</option>
                                <option value="B">Vleugel B</option>
                                <option value="C">Vleugel C</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Celnummer</td>
                        <td>
                            <input type="text" name="cell_number" required>
                            @error('cell_number')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td>BSN-nummer</td>
                        <td><input type="text" name="bsn" required size="9"></td>
                    </tr>
                    <tr>
                        <td>Straat + postcode</td>
                        <td><input type="text" name="address"></td>
                    </tr>
                    <tr>
                        <td>Woonplaats</td>
                        <td><input type="text" name="city"></td>
                    </tr>
                    <tr>
                        <td>Geboortedatum</td>
                        <td>
                            <input type="text" name="date_of_birth" placeholder="DD/MM/YYYY" required>
                            @error('date_of_birth')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td>Geboorteplaats</td>
                        <td><input type="text" name="place_of_birth"></td>
                    </tr>
                    <tr>
                        <td>Delict</td>
                        <td><input type="text" name="delict"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Opslaan"></td>
                    </tr>
                </x-viewtable>
            </form>
        </x-main>
    </x-content>
</x-layout>
