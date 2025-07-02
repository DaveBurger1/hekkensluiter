
    @auth
        @unless(request()->is('/'))
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="px-4 py-2 bg-white text-[#5D3621] rounded-md font-medium hover:bg-gray-100 transition">
                    {{ __('Log out') }}
                </button>
            </form>
            <div class="flex space-x-4"> 
                <a href="{{ route('cells.status') }}" class="px-4 py-2 bg-white text-[#5D3621] rounded-md font-medium hover:bg-gray-100 transition">
                     Cell Status
                </a>
        @endunless
    @else
        @if(request()->is('/'))
            <button onclick="window.location.href='/login'" class="px-4 py-2 bg-white text-[#5D3621] rounded-md font-medium hover:bg-gray-100 transition">
            {{ __('Log in') }}
            </button>
        @endif
    @endauth
</div>
