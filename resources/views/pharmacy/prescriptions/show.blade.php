<x-layout>
    <div class="max-w-5xl mx-auto p-8 space-y-6">
        <!-- Header -->
        <div class="bg-white rounded-xl shadow p-6">
            <h1 class="text-3xl font-bold mb-2">Prescription #{{ $prescription->id }}</h1>
            <p class="text-gray-700"><strong>User:</strong> {{ $prescription->user->name }} ({{ $prescription->user->email }})</p>
            <p class="text-gray-700"><strong>DOB:</strong> {{ $prescription->user->dob ?? 'N/A' }} | <strong>Contact:</strong> {{ $prescription->user->contact_no ?? 'N/A' }}</p>
            <p class="text-gray-700 mt-2"><strong>Timeslot:</strong> {{ $prescription->delivery_slot ?? 'N/A' }}</p>
            <p class="text-gray-700 mt-2"><strong>Note:</strong> {{ $prescription->note ?? 'No additional notes' }}</p>
        </div>

        <!-- Prescription Images -->
        @if($prescription->images->count())
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-xl font-semibold mb-4">Images</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($prescription->images as $img)
                    <div class="border rounded-lg overflow-hidden hover:shadow-lg transition">
                        <a href="{{ asset('storage/' . $img->image_path) }}" target="_blank">
                            <img src="{{ asset('storage/' . $img->image_path) }}" alt="Prescription Image" class="w-full h-48 object-cover">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Action Buttons -->
        <div class="flex flex-wrap gap-4">
            <a href="{{ route('pharmacy.quotations.create', $prescription->id) }}"
               class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition">
               Prepare & Send Quotation
            </a>
            <a href="{{ route('pharmacy.prescriptions') }}"
               class="px-6 py-3 bg-gray-200 text-gray-800 font-semibold rounded-lg shadow hover:bg-gray-300 transition">
               Back to list
            </a>
        </div>
</x-layout>
