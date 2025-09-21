<x-layout>
    <div class="max-w-5xl mx-auto p-8 space-y-6">

        <!-- Header -->
        <div class="bg-white rounded-xl shadow p-6">
            <h1 class="text-3xl font-bold mb-2">Create Quotation for Prescription #{{ $prescription->id }}</h1>
            <p class="text-gray-700 text-sm mb-2">
                <strong>User:</strong> {{ $prescription->user->name }} ({{ $prescription->user->email }})
            </p>
            <p class="text-gray-700 text-sm">DOB: {{ $prescription->user->dob ?? 'N/A' }} | Contact: {{ $prescription->user->contact_no ?? 'N/A' }}</p>
            <p class="text-gray-700 text-sm">Timeslot: {{ $prescription->delivery_slot ?? 'N/A' }}</p>

            <!-- Prescription Images -->
            @if($prescription->images->count())
            <h2 class="font-medium mb-2">Images</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                @foreach($prescription->images as $img)
                    <div class="border rounded-lg overflow-hidden hover:shadow-md transition">
                        <a href="{{ asset('storage/' . $img->image_path) }}" target="_blank">
                            <img src="{{ asset('storage/' . $img->image_path) }}" alt="Prescription Image" class="w-full h-48 object-cover">
                        </a>
                    </div>
                @endforeach
            </div>
            @endif
        </div>

        <!-- Quotation Form -->
        <div class="bg-white rounded-xl shadow p-6">
            <form action="{{ route('pharmacy.quotations.store', $prescription->id) }}" method="POST">
                @csrf

                <h2 class="text-xl font-semibold mb-4">Quotation Items</h2>
                <table class="w-full table-auto border border-gray-200 mb-4" id="items-table">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2 text-left">Drug Name</th>
                            <th class="border px-4 py-2 text-left">Quantity</th>
                            <th class="border px-4 py-2 text-left">Unit Price</th>
                            <th class="border px-4 py-2 text-left">Line Total</th>
                            <th class="border px-4 py-2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border px-4 py-2"><input name="items[0][drug_name]" required class="w-full rounded border px-2 py-1"></td>
                            <td class="border px-4 py-2"><input type="number" min="1" name="items[0][quantity]" class="qty w-20 rounded border px-2 py-1" value="1" required></td>
                            <td class="border px-4 py-2"><input type="number" step="0.01" min="0" name="items[0][unit_price]" class="unit w-32 rounded border px-2 py-1" value="0.00" required></td>
                            <td class="border px-4 py-2 line-total">0.00</td>
                            <td class="border px-4 py-2"><button type="button" class="remove px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition">Remove</button></td>
                        </tr>
                    </tbody>
                </table>

                <button type="button" id="add" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition mb-4">Add Row</button>

                <p class="text-lg font-semibold mb-4">Overall Total: <span id="overall">0.00</span></p>

                <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition">Send Quotation</button>
            </form>

            <p class="mt-6">
                <a href="{{ route('pharmacy.quotations') }}" class="text-sm text-gray-600 hover:text-gray-900 transition">
                    ← Back to my quotations
                </a>
            </p>
        </div>
    </div>

    <script>
        function recalc(){
            let overall = 0;
            document.querySelectorAll('#items-table tbody tr').forEach(function(row){
                const qty = parseFloat(row.querySelector('.qty').value) || 0;
                const unit = parseFloat(row.querySelector('.unit').value) || 0;
                const lt = (qty * unit).toFixed(2);
                row.querySelector('.line-total').innerText = lt;
                overall += parseFloat(lt);
            });
            document.getElementById('overall').innerText = overall.toFixed(2);
        }

        document.getElementById('add').addEventListener('click', function(){
            const tbody = document.querySelector('#items-table tbody');
            const index = tbody.querySelectorAll('tr').length;
            const tr = document.createElement('tr');
            tr.classList.add('border-b');
            tr.innerHTML = `
                <td class="border px-4 py-2"><input name="items[${index}][drug_name]" required class="w-full rounded border px-2 py-1"></td>
                <td class="border px-4 py-2"><input type="number" min="1" name="items[${index}][quantity]" class="qty w-20 rounded border px-2 py-1" value="1" required></td>
                <td class="border px-4 py-2"><input type="number" step="0.01" min="0" name="items[${index}][unit_price]" class="unit w-32 rounded border px-2 py-1" value="0.00" required></td>
                <td class="border px-4 py-2 line-total">0.00</td>
                <td class="border px-4 py-2"><button type="button" class="remove px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition">Remove</button></td>
            `;
            tbody.appendChild(tr);
            tr.querySelectorAll('.qty, .unit').forEach(el => el.addEventListener('input', recalc));
            tr.querySelector('.remove').addEventListener('click', function(){ tr.remove(); recalc(); });
            recalc();
        });

        document.querySelectorAll('.qty, .unit').forEach(el => el.addEventListener('input', recalc));
        document.querySelectorAll('.remove').forEach(btn => btn.addEventListener('click', function(){ btn.closest('tr').remove(); recalc(); }));
    </script>
</x-layout>
