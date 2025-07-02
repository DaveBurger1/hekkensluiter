<x-sidebar-action title="Data">
    <a href="{{ route('prisoners.index') }}">Gedetineerden</a>
    <a href="{{ route('logs.index') }}">Acties</a>
    @if(auth()->check() && auth()->user()->hasGroup('director'))
        <a href="{{ route('director.register', ['role' => 'bewaker']) }}" class="mt-2 inline-block px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">
            Bewaker Registreren
        </a>
        <a href="{{ route('director.register', ['role' => 'coordinator']) }}" class="mt-2 inline-block px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">
            Coördinator Registreren
        </a>
    @endif
</x-sidebar-action>
