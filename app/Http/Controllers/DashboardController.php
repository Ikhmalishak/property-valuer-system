<?php

namespace App\Http\Controllers;

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

        // Get the client that belongs to the user
        $client = Client::where('user_id', $user->id)->first();

        // If client exists, fetch their invoices
        $invoices = $client
            ? Invoice::where('client_id', $client->id)->latest()->with(['property:id,nombor_kait,file_path,file_name'])->get()
            : collect(); // return empty collection if no client

            return view('dashboard.index', compact('invoices','user'));
    }
}
