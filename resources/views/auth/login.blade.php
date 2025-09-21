<x-layout>
    <div class="flex min-h-screen items-center justify-center bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8 rounded-2xl bg-white/90 backdrop-blur p-10 shadow-xl">
            
            <!-- Logo / Title -->
            <div class="text-center">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-indigo-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 1.104.896 2 2 2s2-.896 2-2-.896-2-2-2-2 .896-2 2zM12 11V7m0 4h4" />
                    </svg>
                </div>
                <h2 class="mt-6 text-3xl font-bold tracking-tight text-gray-900">
                    Sign in to your account
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Or <a href="{{ route('register.show') }}" class="font-medium text-indigo-600 hover:text-indigo-500">create a new account</a>
                </p>
            </div>

            <!-- Login Form -->
            <form action="{{ route('login.process') }}" method="POST" class="mt-8 space-y-6">
                @csrf
                <div class="space-y-4">
                    <!-- Email -->
                    <div>
                        <label for="email" class="sr-only">Email address</label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            autocomplete="email"
                            required
                            class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="Email address"
                        />
                    </div>
                    <!-- Password -->
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            autocomplete="current-password"
                            required
                            class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="Password"
                        />
                    </div>
                </div>

                <!-- Submit Button -->
                <div>
                    <button
                        type="submit"
                        class="group relative flex w-full justify-center rounded-lg bg-indigo-600 py-3 px-4 text-sm font-semibold text-white shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all"
                    >
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
