<x-layout>
    <div class="max-w-5xl mx-auto p-8">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl p-6 shadow-lg mb-8">
            <h1 class="text-3xl font-bold">
                Welcome, {{ $user->name }}
                <span class="text-base font-normal text-gray-200">(Pharmacy)</span>
            </h1>
            <p class="mt-2 text-gray-100">This is your pharmacy dashboard.</p>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
            <a href="{{ route('pharmacy.prescriptions') }}" 
               class="group bg-white border border-gray-200 rounded-xl p-6 shadow hover:shadow-lg transition">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900">View Prescriptions</h2>
                    <span class="p-3 rounded-full bg-blue-100 text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition">
                        📄
                    </span>
                </div>
                <p class="mt-2 text-sm text-gray-500">Check all patient prescriptions and manage them easily.</p>
            </a>

            <a href="{{ route('pharmacy.quotations') }}" 
               class="group bg-white border border-gray-200 rounded-xl p-6 shadow hover:shadow-lg transition">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900">My Quotations</h2>
                    <span class="p-3 rounded-full bg-green-100 text-green-600 group-hover:bg-green-600 group-hover:text-white transition">
                        💰
                    </span>
                </div>
                <p class="mt-2 text-sm text-gray-500">View and manage your submitted quotations.</p>
            </a>
        </div>

        <!-- Logout Card -->
        <div class="bg-white rounded-xl shadow p-6">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                        class="w-full py-2 px-4 bg-red-600 text-white font-semibold rounded-lg shadow hover:bg-red-700 transition">
                    Logout
                </button>
            </form>
        </div>
    </div>
</x-layout>
