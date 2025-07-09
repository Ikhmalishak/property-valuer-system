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

        $client = Client::where('user_id', $user->id)->first();

        if (!$client) {
            return view('dashboard.index', [
                'invoices' => collect(),
                'properties' => collect(),
                'user' => $user,
            ])->with('error', 'No client found.');
        }

        $invoices = Invoice::where('client_id', $client->id)
            ->with('property')
            ->latest()
            ->paginate(10);

        $properties = Property::where('client_id', $client->id)->get();

        return view('dashboard.index', compact('invoices', 'properties', 'user'));
    }
}
