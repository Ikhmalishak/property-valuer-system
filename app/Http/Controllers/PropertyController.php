<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index()
{
    $user = Auth::user();

    // Get the client that belongs to the user
    $client = Client::where('user_id', $user->id)->first();

    if (!$client) {
        return view('property.index', [
            'properties' => collect(), // empty collection
            'user' => $user,
        ])->with('error', 'No client found for this user.');
    }

    // If client exists, fetch their properties
    $properties = Property::where('client_id', $client->id)
        ->latest()
        ->with(['client:id,name', 'invoice'])
        ->paginate(10); // Better for large datasets

    return view('property.index', compact('properties', 'user'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    // Get authenticated user
    $user = Auth::user();

    // Get client for the user
    $client = Client::where('user_id', $user->id)->firstOrFail();

    // Validate request
    $validated = $request->validate([
        'nombor_kait' => 'required|string|max:255',
        'nombor_lot' => 'required|string|max:255',
        'nombor_geran' => 'nullable|string|max:255',
        'daerah' => 'nullable|string|max:255',
        'mukim' => 'nullable|string|max:255',
        'file_path' => 'nullable|file|mimes:pdf,docx,jpg,png|max:5120', // Increased to 5 MB
    ]);

    // Handle file upload if present
    $filePath = null;
    $fileName = null;

    if ($request->hasFile('file_path')) {
        $file = $request->file('file_path');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads/properties', $fileName, 'public');
    }

    // Create property
    Property::create([
        'client_id' => $client->id,
        'nombor_kait' => $validated['nombor_kait'],
        'nombor_lot' => $validated['nombor_lot'],
        'nombor_geran' => $validated['nombor_geran'] ?? null,
        'daerah' => $validated['daerah'] ?? null,
        'mukim' => $validated['mukim'] ?? null,
        'file_path' => $filePath,
        'file_name' => $fileName,
    ]);

    return back()->with('success', 'Property added successfully!');
}

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        //
    }
}
