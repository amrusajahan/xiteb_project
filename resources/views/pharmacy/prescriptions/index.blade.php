<x-layout>
    <div class="max-w-5xl mx-auto p-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">📋 Incoming Prescriptions</h1>
            <p class="text-gray-500 mt-1">Review and manage prescriptions submitted by users.</p>
        </div>

        <!-- Prescription List -->
        <div class="space-y-6">
            @forelse($prescriptions as $pres)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-lg font-semibold text-gray-900">
                                From: {{ $pres->user->name }}
                                <span class="text-sm font-normal text-gray-500">({{ $pres->user->email }})</span>
                            </p>
                                <p class="text-sm">DOB: {{ $pres->user->dob ?? 'N/A' }} | Contact: {{ $pres->user->contact_no ?? 'N/A' }}</p>
                                <p class="text-sm">Timeslot: {{ $pres->delivery_slot ?? 'N/A' }}</p>
                            <p class="mt-1 text-sm text-gray-600">
                                🏠 Delivery Address: <span class="font-medium">{{ $pres->delivery_address }}</span>
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('pharmacy.prescriptions.show', $pres->id) }}"
                               class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 shadow transition">
                                View
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md">
                    <p class="text-sm text-yellow-800">No incoming prescriptions at the moment.</p>
                </div>
            @endforelse
        </div>

        <!-- Back Link -->
        <div class="mt-8">
            <a href="{{ route('dashboard') }}" 
               class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-gray-900 transition">
                ← Back to dashboard
            </a>
        </div>
    </div>
</x-layout>
