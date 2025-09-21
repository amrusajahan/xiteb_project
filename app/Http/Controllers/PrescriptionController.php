<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\PrescriptionImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PrescriptionController extends Controller
{
    public function create()
    {
        // Only authenticated users
        if (!Auth::check()) {
            return redirect()->route('login.show')->with('error', 'Please login to upload a prescription.');
        }

        // Only normal users (role = 'user') allowed here
        if (Auth::user()->role !== 'user') {
            abort(403, 'Only normal users can upload prescriptions.');
        }

        return view('prescriptions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'note' => 'nullable|string|max:2000',
            'delivery_address' => 'required|string|max:255',
            'delivery_slot' => 'required|in:08:00-10:00,10:00-12:00,12:00-14:00,14:00-16:00,16:00-18:00,18:00-20:00',
            'images' => 'required|array|min:1|max:5',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // max 5MB per image
        ]);

        $user = Auth::user();

        // Create prescription record
        $prescription = Prescription::create([
            'user_id' => $user->id,
            'note' => $request->input('note'),
            'delivery_address' => $request->input('delivery_address'),
            'delivery_slot' => $request->input('delivery_slot'),
        ]);

        // Store images
        foreach ($request->file('images') as $image) {
            $path = $image->store('prescriptions', 'public');

            PrescriptionImage::create([
                'prescription_id' => $prescription->id,
                'image_path' => $path,
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Prescription uploaded successfully.');
    }
}
