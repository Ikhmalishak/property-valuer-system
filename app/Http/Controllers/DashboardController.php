<?php

namespace App\Http\Controllers;
use App\Models\Property;
use App\Models\Client;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
  public function index()
{
    $user = Auth::user();

    // Get the client for this user
    $client = Client::where('user_id', $user->id)->first();

    if (!$client) {
        return view('dashboard.index', [
            'invoices' => collect(),
            'properties' => collect(),
            'user' => $user,
        ])->with('error', 'No client found.');
    }

    // Fetch all invoices for this client
    $allInvoices = Invoice::where('client_id', $client->id)->with('property')->get();

    // Calculate stats
    $totalPaid = $allInvoices->where('status', 'paid')->sum('amount');
    $pendingCount = $allInvoices->where('status', 'unpaid')->count();
    $totalInvoices = $allInvoices->count();
    $totalProperties = Property::where('client_id', $client->id)->count();

    // Paginate only the latest invoices for table
    $invoices = Invoice::where('client_id', $client->id)
        ->with('property')
        ->latest()
        ->paginate(10);

    $properties = $client->properties ?? collect(); // or Property::where(...)

    return view('dashboard.index', compact(
        'invoices',
        'properties',
        'user',
        'totalPaid',
        'pendingCount',
        'totalInvoices',
        'totalProperties'
    ));
}
}
