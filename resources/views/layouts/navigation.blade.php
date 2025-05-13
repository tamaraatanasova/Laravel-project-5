<nav class="bg-white border-b shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex space-x-4">
                <a href="{{ route('games.index') }}" class="text-gray-800 hover:text-blue-600 font-semibold">Matches</a>

                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('players.index') }}" class="text-gray-800 hover:text-blue-600 font-semibold">Players</a>
                        <a href="{{ route('teams.index') }}" class="text-gray-800 hover:text-blue-600 font-semibold">Teams</a>
                    @endif
                @endauth
            </div>

            <div class="flex items-center space-x-4">
                @auth
                    <span class="text-sm text-gray-600">Hi, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-red-500 hover:underline text-sm">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:underline">Login</a>
                    <a href="{{ route('register') }}" class="text-sm text-gray-600 hover:underline">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
