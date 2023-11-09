<?php

namespace App\Http\Controllers;

use Exception;
use Razorpay\Api\Api;
use Illuminate\Http\Request;
use App\Models\Lending;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;

class RazorpayController extends Controller
{
    public function handlePayment(Request $request)
    {
        $input = $request->all();
        $api = new Api(env('RAZORPAY_API_KEY'), env('RAZORPAY_API_SECRET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        if (count($input) && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture([
                    'amount' => $payment['amount']
                ]);
                // dd($response);

                $id = $request->input('id');

                Lending::where('id', $id)->update([
                    'payment_status' => 'paid',
                    'payment_type' => 'online',
                ]);

                Payment::create([
                    'status' => $response['status'],
                    'payment_id' => $response['id'],
                    'entity' => $response['entity'],
                    'amount' => $response['amount'] / 100, // Assuming amount is in paisa
                    'currency' => $response['currency'],
                    'lending_id' => $id
                ]);

                return redirect()->route('user.cart')->with('success', 'Payment status and type updated successfully.');

            } catch (Exception $e) {
                Log::info($e->getMessage());
                return back()->withError($e->getMessage());
            }
        }
        return back()->withSuccess('Payment done.');
    }
}
