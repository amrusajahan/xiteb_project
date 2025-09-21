<x-layout>
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-2xl font-semibold mb-4">Quotations</h1>

        <div class="space-y-4">
            @foreach($quotations as $q)
            <div class="p-4 border rounded shadow-sm">
                <p class="text-sm">From Pharmacy: {{ $q->pharmacy->name }} ({{ $q->pharmacy->email }})</p>
                <p class="text-sm">Status: <span class="font-medium">{{ $q->status }}</span></p>
                <p class="mt-2"><strong>Items:</strong></p>
                <ul class="list-disc pl-6">
                    @foreach($q->items as $item)
                    <li>{{ $item->drug_name }} — {{ $item->quantity }} × {{ $item->unit_price }} = {{ $item->total_price }}</li>
                    @endforeach
                </ul>

                @if($q->status === 'pending')
                <div class="mt-3 flex gap-3">
                    <form action="{{ route('user.quotations.respond', $q->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="action" value="accept">
                        <button class="px-3 py-2 bg-green-600 text-white rounded" type="submit">Accept</button>
                    </form>

                    <form action="{{ route('user.quotations.respond', $q->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="action" value="reject">
                        <button class="px-3 py-2 bg-red-600 text-white rounded" type="submit">Reject</button>
                    </form>
                </div>
                @else
                <p class="mt-3 text-sm text-gray-600"><em>You already {{ $q->status }} this quotation.</em></p>
                @endif
            </div>
            @endforeach
        </div>

        <p class="mt-6"><a class="text-sm text-gray-600" href="{{ route('dashboard') }}">Back to dashboard</a></p>
    </div>
</x-layout>