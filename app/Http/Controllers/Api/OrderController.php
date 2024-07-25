<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\CustomerOrderShipped;
use App\Mail\CompanyOrderNotification;
use App\Models\Order;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function validateOrder(Request $request)
    {
        Log::info('Ricevuta richiesta per validare un ordine', ['request_data' => $request->all()]);

        try {
            $validatedData = $request->validate([
                'customer_name' => 'required|string|max:255',
                'customer_address' => 'required|string|max:255',
                'customer_phone' => 'required|string|max:20',
                'customer_email' => 'required|email|max:255',
                'details' => 'nullable|string|max:2000',
                'total' => 'required|numeric',
                'dishes' => 'required|array',
                'dishes.*.id' => 'required|exists:dishes,id',
                'dishes.*.qty' => 'required|integer|min:1'
            ]);

            Log::info('Dati validati con successo', ['validated_data' => $validatedData]);

            return response()->json(['valid' => true]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'valid' => false,
                'errors' => $e->errors()
            ], 422);
        }
    }

    public function store(Request $request)
    {
        Log::info('Ricevuta richiesta per creare un ordine', ['request_data' => $request->all()]);

        // Validazione dei dati ricevuti
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_address' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'required|email|max:255',
            'details' => 'nullable|string|max:2000',
            'total' => 'required|numeric',
            'dishes' => 'required|array',
            'dishes.*.id' => 'required|exists:dishes,id',
            'dishes.*.qty' => 'required|integer|min:1'
        ]);

        Log::info('Dati validati con successo', ['validated_data' => $validatedData]);

        try {
            // Creazione dell'ordine
            $order = Order::create([
                'customer_name' => $validatedData['customer_name'],
                'customer_address' => $validatedData['customer_address'],
                'customer_phone' => $validatedData['customer_phone'],
                'customer_email' => $validatedData['customer_email'],
                'details' => $validatedData['details'] ?? null,
                'total' => $validatedData['total'],
            ]);

            Log::info('Ordine creato con successo', ['order_id' => $order->id]);

            // Salvataggio dei piatti associati all'ordine
            foreach ($validatedData['dishes'] as $dish) {
                $order->dishes()->attach($dish['id'], ['qty' => $dish['qty']]);
            }

            Log::info('Piatti associati all\'ordine con successo', ['order_id' => $order->id, 'dishes' => $validatedData['dishes']]);

            // Inviare email al cliente
            Mail::to($order->customer_email)->send(new CustomerOrderShipped($order));

            // Inviare email alla compagnia
            $companyEmails = $order->dishes->map(function($dish) {
                return $dish->company->email;
            })->unique();
            foreach ($companyEmails as $email) {
                Mail::to($email)->send(new CompanyOrderNotification($order));
            }

            return response()->json([
                'success' => true,
                'message' => 'Ordine creato con successo',
                'order' => $order
            ]);
        } catch (\Exception $e) {
            Log::error('Errore nella creazione dell\'ordine', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Errore nella creazione dell\'ordine',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}