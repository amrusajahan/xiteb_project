<x-layout>
    <div class="max-w-4xl mx-auto p-8 space-y-6">

        <!-- Header -->
        <div class="bg-white rounded-xl shadow p-6">
            <h1 class="text-3xl font-bold mb-2">💊 Quotation #{{ $quotation->id }}</h1>
            <p class="text-gray-600 text-sm">Prescription ID: {{ $quotation->prescription->id }}</p>
            <p class="text-gray-600 text-sm">Customer: {{ $quotation->prescription->user->name }} ({{ $quotation->prescription->user->email }})</p>
            <p class="text-gray-600 text-sm">DOB: {{ $quotation->prescription->user->dob ?? 'N/A' }} | Contact: {{ $quotation->prescription->user->contact_no ?? 'N/A' }}</p>
            <p class="text-gray-600 text-sm">Timeslot: {{ $quotation->prescription->delivery_slot ?? 'N/A' }}</p>
            @php
                $statusClass = 'text-gray-600';
                if (strtolower($quotation->status) === 'pending') { $statusClass = 'text-yellow-600'; }
                if (strtolower($quotation->status) === 'sent') { $statusClass = 'text-blue-600'; }
                if (strtolower($quotation->status) === 'accepted') { $statusClass = 'text-green-600'; }
                if (strtolower($quotation->status) === 'rejected') { $statusClass = 'text-red-600'; }
            @endphp
            <p class="mt-2 mb-4">Status: <span class="font-semibold {{ $statusClass }}">{{ $quotation->status }}</span></p>
        </div>

        <!-- Items Table -->
        <div class="bg-white rounded-xl shadow p-6 overflow-x-auto">
            <h3 class="font-semibold text-lg mb-4">Items</h3>
            <table class="w-full table-auto border-collapse text-left">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="px-4 py-2">Drug</th>
                        <th class="px-4 py-2">Quantity</th>
                        <th class="px-4 py-2">Unit Price</th>
                        <th class="px-4 py-2">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php $overall = 0; @endphp
                    @foreach($quotation->items as $it)
                        @php $overall += $it->total_price; @endphp
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="px-4 py-2">{{ $it->drug_name }}</td>
                            <td class="px-4 py-2">{{ $it->quantity }}</td>
                            <td class="px-4 py-2">{{ number_format($it->unit_price, 2) }}</td>
                            <td class="px-4 py-2">{{ number_format($it->total_price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <p class="mt-4 text-lg font-semibold text-gray-800">Overall total: {{ number_format($overall, 2) }}</p>
        </div>

        <!-- Back Link -->
        <div>
            <a href="{{ route('pharmacy.quotations') }}" class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-gray-900 transition">
                ← Back to my quotations
            </a>
        </div>

    </div>
</x-layout>
