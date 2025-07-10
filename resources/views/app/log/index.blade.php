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
                        <th>Gebruiker</th>
                        <th>Actie</th>
                        <th>Beschrijving</th>
                        <th>Tijd</th>
                        <th>Actie</th>
                    </tr>
                </x-slot>
                @foreach ($logs as $log)
                    <tr>
                        <td>{{ $log->user->profile->first_name }}</td>
                        <td>{{ $log->action->name_past }}</td>
                        <td>{{ $log->change ?? '' }}</td>
                        <td>{{ $log->created_at }}</td>
                        <td></td>
                    </tr>
                @endforeach
            </x-viewtable>
        </x-main>
    </x-content>
</x-layout>