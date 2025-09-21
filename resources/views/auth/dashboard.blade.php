<x-layout>
  <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="text-center space-y-6">
      <!-- Heading -->
      <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold tracking-tight">
        Welcome, 
        <span class="bg-gradient-to-r from-indigo-500 to-purple-600 bg-clip-text text-transparent">
          {{ Auth::user()->name }}
        </span>!
      </h1>

      <!-- Subtitle -->
      <p class="text-lg sm:text-xl text-gray-600 max-w-2xl mx-auto">
        This is your personalized dashboard.  
        Track prescriptions and stay updated at a glance.
      </p>

      <!-- Call-to-action buttons -->
      <div class="flex justify-center gap-4">
        <a href="{{ route('prescriptions.index') }}" 
           class="inline-flex items-center px-6 py-3 rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 shadow-md transition-all duration-200">
          View Prescriptions
        </a>
        <a href="{{ route('patients.index') }}" 
           class="inline-flex items-center px-6 py-3 rounded-xl text-indigo-600 bg-indigo-100 hover:bg-indigo-200 shadow-md transition-all duration-200">
          Manage Patients
        </a>
      </div>
    </div>
  </div>
</x-layout>
