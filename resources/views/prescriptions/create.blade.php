<x-layout>
    <div class="max-w-3xl mx-auto p-8 bg-white rounded-xl shadow-lg space-y-6">

        <!-- Header -->
        <div class="border-b pb-4">
            <h1 class="text-3xl font-bold text-gray-900">Upload Prescription</h1>
            <p class="text-gray-600 mt-1 text-sm">Submit your prescription and choose a delivery slot.</p>
        </div>

        <!-- Error messages -->
        @if ($errors->any())
            <div class="p-4 rounded-lg bg-red-50 border border-red-200">
                <h2 class="text-red-700 font-semibold mb-2">Please fix the following:</h2>
                <ul class="list-disc pl-5 space-y-1 text-red-600 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form class="space-y-6" action="{{ route('prescriptions.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- File Upload -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Prescription Images (1–5)</label>
                <input 
                    type="file" 
                    name="images[]" 
                    id="images" 
                    accept="image/*" 
                    multiple 
                    required
                    class="block w-full text-sm text-gray-600 border border-gray-300 rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 p-2"
                    onchange="if(this.files.length > 5){ alert('You can only upload up to 5 images.'); this.value=''; }"
                >
                <p class="text-xs text-gray-500 mt-1">Upload clear photos of your prescription (max 5 files).</p>
            </div>

            <!-- Note -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Note (optional)</label>
                <textarea 
                    name="note" 
                    id="note" 
                    rows="4"
                    placeholder="Add any special instructions or details..."
                    class="w-full border rounded-lg p-3 text-sm text-gray-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('note') }}</textarea>
            </div>

            <!-- Address -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Delivery Address</label>
                <input 
                    type="text" 
                    name="delivery_address" 
                    id="delivery_address" 
                    value="{{ old('delivery_address', Auth::user()->address ?? '') }}" 
                    required
                    class="w-full border rounded-lg p-3 text-sm text-gray-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
            </div>

            <!-- Delivery slot -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Delivery Slot (2 hours)</label>
                <select 
                    name="delivery_slot" 
                    id="delivery_slot" 
                    required
                    class="w-full border rounded-lg p-3 text-sm text-gray-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
                    <option value="">-- choose --</option>
                    @foreach(['08:00-10:00','10:00-12:00','12:00-14:00','14:00-16:00','16:00-18:00','18:00-20:00'] as $slot)
                        <option value="{{ $slot }}" {{ old('delivery_slot') == $slot ? 'selected' : '' }}>
                            {{ $slot }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Submit button -->
            <div class="pt-4">
                <button 
                    type="submit" 
                    class="w-full px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition"
                >
                    Upload Prescription
                </button>
            </div>
        </form>

        <!-- Back link -->
        <p class="text-center mt-6">
            <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:text-blue-600 transition">
                ← Back to dashboard
            </a>
        </p>
    </div>
</x-layout>
