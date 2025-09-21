<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\Quotation;
use App\Models\QuotationItem;
use App\Notifications\QuotationCreated;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuotationController extends Controller
{
    // Pharmacy: list prescriptions from users
    public function prescriptions()
    {
        if (!Auth::check() || Auth::user()->role !== 'pharmacy') {
            abort(403);
        }

        // Show all prescriptions (you may paginate)
        $prescriptions = Prescription::with('images', 'user')->latest()->get();

        return view('pharmacy.prescriptions.index', compact('prescriptions'));
    }

    // Pharmacy: view a single prescription and prepare quotation
    public function showPrescription($id)
    {
        if (!Auth::check() || Auth::user()->role !== 'pharmacy') {
            abort(403);
        }

        $prescription = Prescription::with('images', 'user')->findOrFail($id);

        return view('pharmacy.prescriptions.show', compact('prescription'));
    }

    // Pharmacy: store quotation with items
    public function storeQuotation(Request $request, $prescriptionId)
    {
        if (!Auth::check() || Auth::user()->role !== 'pharmacy') {
            abort(403);
        }

        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.drug_name' => 'required|string|max:255',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        $prescription = Prescription::findOrFail($prescriptionId);

        $createdQuotation = null;

        DB::transaction(function () use ($request, $prescription, &$createdQuotation) {
            $quotation = Quotation::create([
                'prescription_id' => $prescription->id,
                'pharmacy_id' => Auth::id(),
                'status' => 'pending',
            ]);

            $total = 0;

            foreach ($request->input('items') as $item) {
                $lineTotal = $item['quantity'] * $item['unit_price'];
                $total += $lineTotal;

                QuotationItem::create([
                    'quotation_id' => $quotation->id,
                    'drug_name' => $item['drug_name'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'total_price' => $lineTotal,
                ]);
            }

            // optional: you could store overall total on quotation if you add a column
            $createdQuotation = $quotation;
        });

        // Notify the prescription owner that a quotation has been created
        if ($createdQuotation) {
            $user = $prescription->user;
            if ($user && method_exists($user, 'notify')) {
                $user->notify(new QuotationCreated($createdQuotation));
            }
        }

        return redirect()->route('pharmacy.prescriptions')->with('success', 'Quotation created and sent to user.');
    }

    // Show form to create a quotation (moved from prescription show)
    public function createQuotation($prescriptionId)
    {
        if (!Auth::check() || Auth::user()->role !== 'pharmacy') {
            abort(403);
        }

        $prescription = Prescription::with('images', 'user')->findOrFail($prescriptionId);

        return view('pharmacy.quotations.create', compact('prescription'));
    }

    // Read-only view of a created quotation for pharmacy
    public function showQuotation($id)
    {
        if (!Auth::check() || Auth::user()->role !== 'pharmacy') {
            abort(403);
        }

        $quotation = Quotation::with('items', 'prescription', 'prescription.user')->findOrFail($id);

        return view('pharmacy.quotations.show', compact('quotation'));
    }

    // Pharmacy: view quotations created by this pharmacy
    public function pharmacyQuotations()
    {
        if (!Auth::check() || Auth::user()->role !== 'pharmacy') {
            abort(403);
        }

        $quotations = Quotation::with('items', 'prescription', 'prescription.user')
            ->where('pharmacy_id', Auth::id())->latest()->get();

        return view('pharmacy.quotations.index', compact('quotations'));
    }

    // User: list quotations for current user
    public function userQuotations()
    {
        if (!Auth::check()) {
            return redirect()->route('login.show');
        }

        $quotations = Quotation::with('items', 'pharmacy', 'prescription')
            ->whereHas('prescription', function ($q) {
                $q->where('user_id', Auth::id());
            })->latest()->get();

        return view('user.quotations.index', compact('quotations'));
    }

    // User: accept/reject quotation
    public function respondQuotation(Request $request, $quotationId)
    {
        if (!Auth::check()) {
            abort(403);
        }

        $quotation = Quotation::findOrFail($quotationId);

        // ensure the quotation belongs to the user's prescription
        if ($quotation->prescription->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'action' => 'required|in:accept,reject',
        ]);

        if ($quotation->status !== 'pending') {
            return redirect()->route('user.quotations')->with('error', 'You have already responded to this quotation.');
        }

        $quotation->status = $request->input('action') === 'accept' ? 'accepted' : 'rejected';
        $quotation->save();

        return redirect()->route('user.quotations')->with('success', 'Your response has been recorded.');
    }
}
