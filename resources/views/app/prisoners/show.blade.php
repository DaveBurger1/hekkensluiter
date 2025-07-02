<x-layout>
    <x-header></x-header>
    <x-content>
        <x-sidebar>
            @include('components.parts.sidebar-items')
        </x-sidebar>
        <x-main>
            <div class="tabs">
                <button class="tab-button active" onclick="openTab(event, 'info')">Informatie</button>
                <button class="tab-button" onclick="openTab(event, 'actions')">Acties</button>
            </div>

            <div id="info" class="tab-content" style="display: block;">
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> a9619c76d7468250b94d107373c043f5ce25d05c
                <div style="position: relative;">
                    <div class="prisoner-image" style="position: absolute; top: 30px; right: 0; max-width: 200px; margin: 0;">
                        @php
                            $photoPath = $profile && $profile->photo ? asset('storage/' . $profile->photo) : Vite::asset('resources/icons/app/Afbeelding' . ($prisoner->id % 2 + 1) . '.png');
                        @endphp
                        <img src="{{ $photoPath }}" 
                             alt="Prisoner Image" 
                             style="width: 100%; height: auto; display: block;">
                    </div>
                    <x-viewtable style="padding-top: 10px;">
                    <x-slot name="head">
                        <tr>
                            <th>Veld</th>
                            <th>Waarde</th>
                        </tr>
                    </x-slot>
<<<<<<< HEAD
=======
=======
                <div class="prisoner-image">
                    @php
                        $photoPath = 'resources/icons/app/Afbeelding' . ($prisoner->id % 2 + 1) . '.png';
                    @endphp
                    <img src="{{ Vite::asset($photoPath) }}" 
                         alt="Prisoner Image" 
                         style="max-width: 200px; margin-bottom: 20px; right: 20px; position:absolute; top: 150px;">
                </div>
                <x-viewtable>
                <x-slot name="head">
>>>>>>> c827a1adedba7fb1a66272d44689c45e15fb8fe1
>>>>>>> a9619c76d7468250b94d107373c043f5ce25d05c
                    <tr>
                        <td>Voornaam</td>
                        <td>{{ $profile?->first_name ?? 'Niet beschikbaar' }}</td>
                    </tr>
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> a9619c76d7468250b94d107373c043f5ce25d05c
                    <tr>
                        <td>Tussenvoegsel</td>
                        <td>{{ $profile?->tussenvoegsel }}</td>
                    </tr>
                    <tr>
                        <td>Achternaam</td>
                        <td>{{ $profile?->last_name ?? 'Niet beschikbaar' }}</td>
                    </tr>
                    <tr>
                        <td>Cel</td>
                        <td>{{ $prisoner->currentCell ? $prisoner->currentCell->wing.$prisoner->currentCell->cell_number : 'Niet toegewezen' }}</td>
                    </tr>
                    <tr>
                        <td>BSN-nummer</td>
                        <td>{{ $profile?->bsn ?? 'Niet beschikbaar' }}</td>
                    </tr>
                    <tr>
                        <td>Adres</td>
                        <td>{{ $profile ? ($profile->address . ', ' . $profile->city) : 'Niet beschikbaar' }}</td>
                    </tr>
                    <tr>
                        <td>Geboortedatum</td>
                        <td>{{ $profile?->date_of_birth ? \Carbon\Carbon::parse($profile->date_of_birth)->format('d/m/Y') : 'Niet beschikbaar' }}</td>
                    </tr>
                    <tr>
                        <td>Geboorteplaats</td>
                        <td>{{ $profile?->place_of_birth ?? 'Niet beschikbaar' }}</td>
                    </tr>
                    <tr>
                        <td>Delict</td>
                        <td>{{ $profile?->delict ?? 'Niet beschikbaar' }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <a href="{{ route('prisoners.edit', $prisoner->id) }}">Bewerken</a>
                        </td>
                    </tr>
                    </x-viewtable>
                </div>
<<<<<<< HEAD
=======
=======
                </x-slot>
                <tr>
                    <td>Voornaam</td>
                    <td>{{ $profile?->first_name ?? 'Niet beschikbaar' }}</td>
                </tr>
                <tr>
                    <td>Tussenvoegsel</td>
                    <td>{{ $profile?->tussenvoegsel }}</td>
                </tr>
                <tr>
                    <td>Achternaam</td>
                    <td>{{ $profile?->last_name ?? 'Niet beschikbaar' }}</td>
                </tr>
                <tr>
                    <td>Cel</td>
                    <td>{{ $prisoner->currentCell ? $prisoner->currentCell->wing.$prisoner->currentCell->cell_number : 'Niet toegewezen' }}</td>
                </tr>
                <tr>
                    <td>BSN-nummer</td>
                    <td>{{ $profile?->bsn ?? 'Niet beschikbaar' }}</td>
                </tr>
                <tr>
                    <td>Adres</td>
                    <td>{{ $profile ? ($profile->address . ', ' . $profile->city) : 'Niet beschikbaar' }}</td>
                </tr>
                <tr>
                    <td>Geboortedatum</td>
                    <td>{{ $profile?->date_of_birth ? \Carbon\Carbon::parse($profile->date_of_birth)->format('d/m/Y') : 'Niet beschikbaar' }}</td>
                </tr>
                <tr>
                    <td>Geboorteplaats</td>
                    <td>{{ $profile?->place_of_birth ?? 'Niet beschikbaar' }}</td>
                </tr>
                <tr>
                    <td>Delict</td>
                    <td>{{ $profile?->delict ?? 'Niet beschikbaar' }}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <a href="{{ route('prisoners.edit', $prisoner->id) }}">Bewerken</a>
                    </td>
                </tr>
                </x-viewtable>
>>>>>>> c827a1adedba7fb1a66272d44689c45e15fb8fe1
>>>>>>> a9619c76d7468250b94d107373c043f5ce25d05c
            </div>

            <div id="actions" class="tab-content" style="display: none;">
                <div style="margin-bottom: 20px;">
                    <form method="POST" action="{{ route('prisoners.move-cell', $prisoner->id) }}">
                        @csrf
                        <h3>Verplaats naar andere cel</h3>
                        <div style="display: flex; gap: 10px; margin-bottom: 20px;">
                            <select name="wing" required style="flex: 1;">
                                <option value="A">Vleugel A</option>
                                <option value="B">Vleugel B</option>
                                <option value="C">Vleugel C</option>
                            </select>
                            <input type="number" name="cell_number" placeholder="Celnummer" required 
                                   style="flex: 1;"
                                   min="1"
                                   title="Voer een celnummer in (alleen cijfers)">
                            <button type="submit" style="padding: 8px 16px;">Verplaatsen</button>
                        </div>
                        @if(session('success'))
                            <div style="color: green;">{{ session('success') }}</div>
                        @endif
                        @error('cell_number')
                            <div style="color: red;">{{ $message }}</div>
                        @enderror
                    </form>
                </div>
                <div style="margin-bottom: 20px;">
                    <form method="POST" action="{{ route('logs.store') }}">
                        @csrf
                        <input type="hidden" name="prisoner_id" value="{{ $prisoner->id }}">
                        <div style="display: flex; gap: 10px;">
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> a9619c76d7468250b94d107373c043f5ce25d05c
                            <select name="user_id" required style="flex: 1;">
                                <option value="">Selecteer gebruiker</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->profile->first_name ?? $user->name }}</option>
                                @endforeach
                            </select>
<<<<<<< HEAD
=======
=======
>>>>>>> c827a1adedba7fb1a66272d44689c45e15fb8fe1
>>>>>>> a9619c76d7468250b94d107373c043f5ce25d05c
                            <select name="action_id" required style="flex: 1;">
                                @foreach(App\Models\Action::all() as $action)
                                    <option value="{{ $action->id }}">{{ $action->name }}</option>
                                @endforeach
                            </select>
                            <input type="text" name="change" placeholder="Beschrijving" style="flex: 2;">
                            <button type="submit" style="padding: 8px 16px;">Toevoegen</button>
                        </div>
                        @if(session('success'))
                            <div style="color: green; margin-top: 10px;">{{ session('success') }}</div>
                        @endif
                        @error('action_id')
                            <div style="color: red; margin-top: 10px;">{{ $message }}</div>
                        @enderror
                        @error('prisoner_id')
                            <div style="color: red; margin-top: 10px;">{{ $message }}</div>
                        @enderror
                    </form>
                </div>
                <x-viewtable>
                    <x-slot name="head">
                        <tr>
                            <th>Gebruiker</th>
                            <th>Actie</th>
                            <th>Beschrijving</th>
                            <th>Tijd</th>
                        </tr>
                    </x-slot>
                    @foreach ($logs as $log)
                        <tr>
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> a9619c76d7468250b94d107373c043f5ce25d05c
                            <td>
                                @if($log->user)
                                    {{ $log->user->profile->first_name ?? $log->user->name ?? 'Onbekend' }}
                                @else
                                    Onbekend
                                @endif
                            </td>
                            <td>{{ $log->action->name_past }}</td>
                            <td>{{ $log->change ?? '' }}</td>
                            <td>{{ $log->created_at ? \Carbon\Carbon::parse($log->created_at)->format('d-m-Y H:i') : 'Onbekend' }}</td>
<<<<<<< HEAD
=======
=======
                            <td>{{ $log->user->profile->first_name }}</td>
                            <td>{{ $log->action->name_past }}</td>
                            <td>{{ $log->change ?? '' }}</td>
                            <td>{{ $log->created_at ? $log->created_at->format('d-m-Y H:i') : 'Onbekend' }}</td>
>>>>>>> c827a1adedba7fb1a66272d44689c45e15fb8fe1
>>>>>>> a9619c76d7468250b94d107373c043f5ce25d05c
                        </tr>
                    @endforeach
                </x-viewtable>
            </div>

            <style>
                .tabs {
                    margin-bottom: 1rem;
                }
                .tab-button {
                    padding: 0.5rem 1rem;
                    background: #f0f0f0;
                    border: none;
                    cursor: pointer;
                }
                .tab-button.active {
                    background: #ddd;
                    font-weight: bold;
                }
                .tab-content {
                    display: none;
                }
            </style>

            <script>
                function openTab(evt, tabName) {
                    const tabContents = document.getElementsByClassName("tab-content");
                    for (let i = 0; i < tabContents.length; i++) {
                        tabContents[i].style.display = "none";
                    }
                    
                    const tabButtons = document.getElementsByClassName("tab-button");
                    for (let i = 0; i < tabButtons.length; i++) {
                        tabButtons[i].className = tabButtons[i].className.replace(" active", "");
                    }
                    
                    document.getElementById(tabName).style.display = "block";
                    evt.currentTarget.className += " active";
                }
            </script>
        </x-main>
    </x-content>
</x-layout>
