<<<<<<< HEAD

=======
<<<<<<< HEAD

=======
<div class="flex space-x-4"> 
    <a href="{{ route('cells.status') }}" class="px-4 py-2 bg-white text-[#5D3621] rounded-md font-medium hover:bg-gray-100 transition">
        Cell Status
    </a>
>>>>>>> c827a1adedba7fb1a66272d44689c45e15fb8fe1
>>>>>>> a9619c76d7468250b94d107373c043f5ce25d05c
    @auth
        @unless(request()->is('/'))
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="px-4 py-2 bg-white text-[#5D3621] rounded-md font-medium hover:bg-gray-100 transition">
                    {{ __('Log out') }}
                </button>
            </form>
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> a9619c76d7468250b94d107373c043f5ce25d05c
            <div class="flex space-x-4"> 
                <a href="{{ route('cells.status') }}" class="px-4 py-2 bg-white text-[#5D3621] rounded-md font-medium hover:bg-gray-100 transition">
                     Cell Status
                </a>
<<<<<<< HEAD
=======
=======
>>>>>>> c827a1adedba7fb1a66272d44689c45e15fb8fe1
>>>>>>> a9619c76d7468250b94d107373c043f5ce25d05c
        @endunless
    @else
        @if(request()->is('/'))
            <button onclick="window.location.href='/login'" class="px-4 py-2 bg-white text-[#5D3621] rounded-md font-medium hover:bg-gray-100 transition">
            {{ __('Log in') }}
            </button>
        @endif
    @endauth
</div>
