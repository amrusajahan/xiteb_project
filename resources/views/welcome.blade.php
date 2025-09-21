<x-layout>
    <div class="min-h-screen bg-gradient-to-b from-gray-50 to-white py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <!-- Hero -->
            <div class="bg-white shadow-xl rounded-2xl p-10 flex flex-col md:flex-row items-center gap-10">
                <div class="flex-1">
                    <h1 class="text-5xl font-extrabold text-gray-900 leading-tight">
                        Xiteb — <span class="text-blue-600">Simple Prescription & Quotation Flow</span>
                    </h1>
                    <p class="mt-6 text-lg text-gray-600">
                        Upload prescriptions with images, receive quotations from pharmacies, and accept or reject quotations directly from your dashboard.  
                        Pharmacies can view prescriptions, prepare itemised quotations, and track responses seamlessly.
                    </p>

                    <!-- Actions -->
                    <div class="mt-8 flex flex-wrap gap-4">
                        <a href="{{ route('login.show') }}" 
                           class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg shadow hover:bg-blue-700 transition">
                            Login
                        </a>
                        <a href="{{ route('register.show') }}" 
                           class="px-6 py-3 bg-gray-200 text-gray-800 font-medium rounded-lg shadow hover:bg-gray-300 transition">
                            Register
                        </a>
                        <a href="{{ route('login.show') }}" 
                           class="px-6 py-3 bg-green-600 text-white font-medium rounded-lg shadow hover:bg-green-700 transition">
                            Upload Prescription
                        </a>
                    </div>
                </div>

                <!-- Quick features -->
                <div class="w-full md:w-1/3">
                    <div class="bg-gradient-to-br from-blue-50 to-white border rounded-xl p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-900">✨ Quick features</h3>
                        <ul class="mt-4 space-y-3 text-gray-700 text-sm">
                            <li class="flex items-start"><span class="mr-2 text-blue-600">✔</span> Upload 1–5 images per prescription</li>
                            <li class="flex items-start"><span class="mr-2 text-blue-600">✔</span> Pharmacies prepare itemised quotations</li>
                            <li class="flex items-start"><span class="mr-2 text-blue-600">✔</span> Users accept / reject quotations (single response)</li>
                            <li class="flex items-start"><span class="mr-2 text-blue-600">✔</span> Role-based dashboards</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Feature Cards -->
            <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition">
                    <div class="text-blue-600 text-3xl mb-3">👤</div>
                    <h4 class="text-xl font-bold text-gray-900">For Users</h4>
                    <p class="mt-3 text-gray-600 text-sm leading-relaxed">
                        Register, upload prescription images, add delivery details and receive quotations from pharmacies in real time.
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition">
                    <div class="text-green-600 text-3xl mb-3">🏥</div>
                    <h4 class="text-xl font-bold text-gray-900">For Pharmacies</h4>
                    <p class="mt-3 text-gray-600 text-sm leading-relaxed">
                        View incoming prescriptions, see patient contact info and timeslot, and send quotations with line items and pricing.
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition">
                    <div class="text-gray-700 text-3xl mb-3">🛠</div>
                    <h4 class="text-xl font-bold text-gray-900">Admin</h4>
                    <p class="mt-3 text-gray-600 text-sm leading-relaxed">
                        Admin pharmacy accounts can be added manually. Credentials are included in the README for testing purposes.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layout>
