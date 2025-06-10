<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class PaymentController extends Controller
{
    /**
     * Display a listing of all payments.
     */
    public function index()
    {
        $payments = Payment::with(['user', 'service'])->get();
        return view('payments.index', compact('payments'));
    }

    /**
     * Show the payment form for a service.
     */
    public function showPaymentForm(Service $service)
    {
        return view('payments.confirm', compact('service'));
    }

    /**
     * Handle payment request.
     */
    public function pay(Request $request, Service $service)
    {
        $request->validate([
            'payment_method' => 'required|in:stripe,fpx',
            'terms' => 'required|accepted',
        ]);

        $payment = Payment::create([
            'user_id' => Auth::id(),
            'service_id' => $service->id,
            'amount' => $service->price,
            'status' => 'pending',
            'payment_method' => $request->payment_method,
        ]);

        if ($request->payment_method === 'stripe') {
            return $this->handleStripePayment($payment);
        }

        // Handle FPX or other payment methods here
        return redirect()->back()->with('error', 'Unsupported payment method.');
    }

    /**
     * Handle Stripe Checkout session.
     */
    protected function handleStripePayment(Payment $payment)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'myr',
                        'product_data' => [
                            'name' => $payment->service->name,
                            'description' => $payment->service->description ?? '',
                        ],
                        'unit_amount' => $payment->amount * 100, // Convert to cents
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('payment.success', $payment),
                'cancel_url' => route('payment.cancel', $payment),
                'client_reference_id' => $payment->id,
            ]);

            $payment->update(['gateway_reference' => $session->id, 'paid_at' => now()]);

            return redirect($session->url);

        } catch (\Exception $e) {
            $payment->update(['status' => 'failed']);
            return redirect()->back()->with('error', 'Payment initialization failed: ' . $e->getMessage());
        }
    }

    /**
     * Handle successful payment.
     */
    public function success(Payment $payment)
    {
        $payment->update(['status' => 'completed']);
        $payment ->user->notify(new \App\Notifications\InvoiceNotification($payment));
        return view('payments.success', compact('payment'));
    }

    /**
     * Handle cancelled payment.
     */
    public function cancel(Payment $payment)
    {
        $payment->update(['status' => 'cancelled']);
        return view('payments.cancel', compact('payment'));
    }
}