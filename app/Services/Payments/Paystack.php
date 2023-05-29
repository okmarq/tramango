<?php
namespace App\Services\Payments;

use App\Http\Requests\StorePaymentRequest;
use Illuminate\Http\Request;
use Laravel\SerializableClosure\Exceptions\PhpVersionNotSupportedException;
use Stephenjude\PaymentGateway\DataObjects\SessionData;
use Stephenjude\PaymentGateway\PaymentGateway;
use Stephenjude\PaymentGateway\DataObjects\PaymentData;
use Laravel\SerializableClosure\SerializableClosure;

class Paystack {
    public function makePayment(StorePaymentRequest $request): SessionData
    {
        $provider = PaymentGateway::make('paystack');
        return $provider->initializePayment([
            'currency' => strtoupper($request['currency']),
            'amount' => $request['amount'],
            'email' => $request['email'],
            'meta' => [
                'booking_id' => $request['booking_id']
            ],
            'closure' => function (PaymentData $payment) {
                logger('payment details', [
                    'currency' => $payment->currency,
                    'amount' => $payment->amount,
                    'status' => $payment->status,
                    'reference' => $payment->reference,
                    'provider' => $payment->provider,
                    'date' => $payment->date,
                ]);
            },
        ]);
    }

    /**
     * @throws PhpVersionNotSupportedException
     */
    public function verifyPayment(Request $request): PaymentData|null
    {
        $closure = fn (PaymentData $payment): PaymentData => $payment;
        SerializableClosure::setSecretKey(env('APP_KEY', 'secret'));
        $serialized = new SerializableClosure($closure);

        $provider = PaymentGateway::make('paystack');
        return $provider->confirmPayment($request['reference'], $serialized);
    }
}
