<?php

namespace App\Http\Controllers;

use App\Order;
use Alexo\LaravelPayU\LaravelPayU;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
	protected $successPayment = false;
	protected $paymentErrors = [];
	protected $res = '';

    public function handlePayment(Request $request)
    {
    	$order = new Order;
    	$order->reference = uniqid();
    	$order->state = 'Orden creada';
    	$order->value = 20000;
    	$order->save();

    	$session = md5('myecommercewebsite.com');

    	$data = [
		    \PayUParameters::DESCRIPTION => 'Payment cc test',
		    \PayUParameters::IP_ADDRESS => '127.0.0.1',
		    \PayUParameters::USER_AGENT => $_SERVER['HTTP_USER_AGENT'],
		    \PayUParameters::CURRENCY => 'COP',
		    \PayUParameters::VALUE => $order->value,
		    \PayUParameters::PAYER_COOKIE => 'cookie_' . time(),
		    \PayUParameters::REFERENCE_CODE => $order->reference,

		    \PayUParameters::DEVICE_SESSION_ID => session_id($session),
		    \PayUParameters::PAYMENT_METHOD => $request->input('card_name'),
		    \PayUParameters::CREDIT_CARD_NUMBER => $request->input('card_number'),
		    \PayUParameters::CREDIT_CARD_EXPIRATION_DATE => $request->input('expiration_date'),
		    \PayUParameters::CREDIT_CARD_SECURITY_CODE => $request->input('card_cvc'),
		    \PayUParameters::INSTALLMENTS_NUMBER => $request->input('installments'),

		    \PayUParameters::PAYER_NAME => $request->input('payer_name'),
		    \PayUParameters::PAYER_EMAIL => $request->input('payer_email'),
		    \PayUParameters::PAYER_DNI => $request->input('payer_dni'),
		    \PayUParameters::PAYER_CONTACT_PHONE => $request->input('buyer_name'),
		];

    	$order->payWith($data, function($response, $order) {
    		if ($response->code == 'SUCCESS') {
    			if ($response->transactionResponse->state == 'APPROVED') {
    				$order->payu_order_id = $response->transactionResponse->orderId;
			        $order->transaction_id = $response->transactionResponse->transactionId;
			        $order->state = 'Order pagada';
			        $order->save();
			    	$this->successPayment = true;
    			}
		    }
    	}, function($error) {
    		array_push($this->paymentErrors, $error->getMessage());
    	});

    	if ($this->paymentErrors) {
    		return back()->with('errors', $this->paymentErrors);
    	}

    	return back()->with('status', 'Se ha pagado con tarjeta exitosamente');
    }
}
