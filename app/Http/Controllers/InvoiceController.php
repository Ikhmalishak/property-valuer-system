<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $client = Client::where('user_id', $user->id)->first();

        if (!$client) {
            return view('dashboard.index', [
                'invoices' => collect(),
                'user' => $user,
            ])->with('error', 'No client found.');
        }

        $invoices = Invoice::where('client_id', $client->id)
            ->with('property')
            ->latest()
            ->paginate(10);

        return view('dashboard.index', compact('invoices', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $client = Client::where('user_id', $user->id)->first();

        $properties = $client ? $client->properties : [];

        return view('invoices.create', compact('properties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'invoice_number' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'due_date' => 'required|date',
            'status' => 'required|in:paid,unpaid',
            'file_path' => 'nullable|file|mimes:pdf,docx,jpg,png|max:5120',
        ]);

        $user = Auth::user();
        $client = Client::where('user_id', $user->id)->firstOrFail();

        $filePath = null;
        $fileName = null;

        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $fileName = time() . '_' . $file->getClientOriginalName(); // unique filename
            $filePath = $file->storeAs('uploads/invoices', $fileName, 'public');
        }

        Invoice::create([
            'client_id' => $client->id,
            'property_id' => $validated['property_id'],
            'invoice_number' => $validated['invoice_number'],
            'amount' => $validated['amount'],
            'due_date' => $validated['due_date'],
            'issued_date' => now(),
            'status' => $validated['status'],
            'file_path' => $filePath,
            'file_name' => $fileName,
        ]);

        return back()->with('success', 'Invoice added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        $invoice->load('property');
        dd($invoice); // For debugging
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // TODO: implement if needed
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // TODO: implement if needed
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // TODO: implement if needed
    }
}
