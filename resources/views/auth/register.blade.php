<x-layout>
    <div class="flex min-h-screen items-center justify-center bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-lg space-y-8 rounded-2xl bg-white/95 backdrop-blur p-10 shadow-xl">
            
            <!-- Title -->
            <div class="text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900">
                    Create your account
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Already registered? 
                    <a href="{{ route('login.show') }}" class="font-medium text-indigo-600 hover:text-indigo-500">Login here</a>
                </p>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="rounded-lg bg-red-50 p-4 text-red-600 border border-red-200">
                    <ul class="list-disc pl-5 space-y-1 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('register.process') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input 
                        id="name" name="name" type="text" value="{{ old('name') }}" required
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="John Doe"
                    >
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                    <input 
                        id="email" name="email" type="email" value="{{ old('email') }}" required
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="you@example.com"
                    >
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input 
                        id="password" name="password" type="password" required
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="********"
                    >
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input 
                        id="password_confirmation" name="password_confirmation" type="password" required
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="********"
                    >
                </div>

                <!-- Date of Birth -->
                <div>
                    <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                    <input 
                        id="dob" name="dob" type="date" value="{{ old('dob') }}" required
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    >
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <input 
                        id="phone" name="phone" type="tel" value="{{ old('phone') }}" required
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="+94 77 123 4567"
                    >
                </div>

                <!-- Address -->
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <input 
                        id="address" name="address" type="text" value="{{ old('address') }}" required
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="123, Main Street, Colombo"
                    >
                </div>

                <!-- Submit Button -->
                <div>
                    <button 
                        type="submit"
                        class="w-full rounded-lg bg-indigo-600 py-3 px-4 text-sm font-semibold text-white shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all"
                    >
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
