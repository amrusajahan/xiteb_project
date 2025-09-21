<nav class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="text-xl font-bold text-blue-600">Xiteb</a>
                </div>
                <div class="hidden sm:-my-px sm:ml-6 sm:flex sm:space-x-8">
                    @auth
                        @if(auth()->user()->role === 'pharmacy')
                            <a href="{{ route('dashboard.pharmacy') }}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium text-gray-700 hover:text-gray-900">Dashboard</a>
                            <a href="{{ route('pharmacy.prescriptions') }}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium text-gray-700 hover:text-gray-900">Prescriptions</a>
                            <a href="{{ route('pharmacy.quotations') }}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium text-gray-700 hover:text-gray-900">My Quotations</a>
                        @else
                            <a href="{{ route('dashboard.user') }}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium text-gray-700 hover:text-gray-900">Dashboard</a>
                            <a href="{{ route('prescriptions.create') }}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium text-gray-700 hover:text-gray-900">Upload Prescription</a>
                            <a href="{{ route('user.quotations') }}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium text-gray-700 hover:text-gray-900">My Quotations</a>
                        @endif
                    @endauth
                </div>
            </div>

            <div class="hidden sm:ml-6 sm:flex sm:items-center">
                @guest
                    <a href="{{ route('login.show') }}" class="text-sm text-gray-700 px-4">Login</a>
                    <a href="{{ route('register.show') }}" class="text-sm text-gray-700 px-4">Register</a>
                @else
                    <div class="mr-4 text-sm text-gray-700">Hello, {{ auth()->user()->name }}</div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Logout</button>
                    </form>
                @endguest
            </div>

            <!-- Mobile menu button -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100" aria-controls="mobile-menu" aria-expanded="false" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                    <span class="sr-only">Open main menu</span>
                    <!-- Icon -->
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="sm:hidden hidden" id="mobile-menu">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                @if(auth()->user()->role === 'pharmacy')
                    <a href="{{ route('dashboard.pharmacy') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700">Dashboard</a>
                    <a href="{{ route('pharmacy.prescriptions') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700">Prescriptions</a>
                    <a href="{{ route('pharmacy.quotations') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700">My Quotations</a>
                @else
                    <a href="{{ route('dashboard.user') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700">Dashboard</a>
                    <a href="{{ route('prescriptions.create') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700">Upload Prescription</a>
                    <a href="{{ route('user.quotations') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700">My Quotations</a>
                @endif

                <div class="border-t mt-2 pt-2">
                    <div class="px-4 py-2 text-sm text-gray-700">Hello, {{ auth()->user()->name }}</div>
                    <form method="POST" action="{{ route('logout') }}" class="px-4 py-2">
                        @csrf
                        <button type="submit" class="w-full px-3 py-2 bg-red-600 text-white rounded">Logout</button>
                    </form>
                </div>
            @else
                <a href="{{ route('login.show') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700">Login</a>
                <a href="{{ route('register.show') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700">Register</a>
            @endauth
        </div>
    </div>
</nav>