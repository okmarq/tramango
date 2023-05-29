<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentResource;
use App\Models\Booking;
use App\Models\Payment;
use App\Http\Requests\StorePaymentRequest;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Laravel\SerializableClosure\Exceptions\PhpVersionNotSupportedException;
use Stephenjude\PaymentGateway\DataObjects\SessionData;
use App\Services\Payments\Paystack;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Payment::class);
    }

    public function pay (StorePaymentRequest $request): SessionData
    {
        return (new Paystack)->makePayment($request);
    }

    /**
     * @throws PhpVersionNotSupportedException
     */
    public function callback(Request $request)
    {
        $paymentData = (new Paystack)->verifyPayment($request);
        if ($paymentData->status === 'success'){
            $request->merge([
                'booking_id'=>$paymentData->meta['booking_id'],
                'email'=>$paymentData->email,
                'provider'=>$paymentData->provider,
                'status'=>$paymentData->status,
                'date'=>$paymentData->date
            ]);

            $transaction = DB::transaction(function () use ($request) {
                $tx['payment'] = Payment::create($request->all());

                $tx['booking'] = Booking::find($request['booking_id']);
                $tx['booking']->status_id = Status::IS_PAID;
                $tx['booking']->save();

                return $tx;
            });

            return response()->json([
                'transaction' => $transaction,
                'message' => 'Payment successful'
            ]);
        }
    }

    public function index()
    {
        $cacheKey = 'payments';
        $cacheTime = 3600;
        return Cache::remember($cacheKey, $cacheTime, fn () => PaymentResource::collection(Payment::all()));
    }
}
