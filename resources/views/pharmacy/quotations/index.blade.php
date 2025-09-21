<x-layout>
    <div class="max-w-5xl mx-auto p-8 space-y-6">

        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">💼 My Quotations</h1>
            <p class="text-gray-500 mt-1">View all quotations you have prepared for prescriptions.</p>
        </div>

        <!-- Quotations List -->
        <div class="space-y-6">
            @forelse($quotations as $q)
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 hover:shadow-md transition">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-center">
                        <div class="space-y-1">
                            <p class="text-gray-900 font-semibold">Prescription ID: {{ $q->prescription->id }}</p>
                            <p class="text-sm text-gray-600">Customer: {{ $q->prescription->user->name }} ({{ $q->prescription->user->email }})</p>
                            <p class="text-sm">DOB: {{ $q->prescription->user->dob ?? 'N/A' }} | Contact: {{ $q->prescription->user->contact_no ?? 'N/A' }}</p>
                            <p class="text-sm">Timeslot: {{ $q->prescription->delivery_slot ?? 'N/A' }}</p>
                            <p class="text-sm">Status: <span class="font-medium text-indigo-600">{{ $q->status }}</span></p>
                        </div>
                        <div class="mt-3 md:mt-0">
                            <a href="{{ route('pharmacy.quotations.show', $q->id) }}"
                               class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition text-sm font-medium">
                                Open Quotation
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md">
                    <p class="text-yellow-800 text-sm">No quotations found.</p>
                </div>
            @endforelse
        </div>

        <!-- Back Link -->
        <div class="mt-8">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-gray-900 transition">
                ← Back to dashboard
            </a>
        </div>

    </div>
</x-layout>
