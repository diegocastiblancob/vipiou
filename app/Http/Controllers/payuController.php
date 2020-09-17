<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\payment;

class payuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['response', 'confirmation']]);
    }


    public function response()
    {

        $ApiKey = "4Vj8eK4rloUd272L48hsrarnUA";
        $merchant_id = $_REQUEST['merchantId'];
        $referenceCode = $_REQUEST['referenceCode'];
        $TX_VALUE = $_REQUEST['TX_VALUE'];
        $New_value = number_format($TX_VALUE, 1, '.', '');
        $currency = $_REQUEST['currency'];
        $transactionState = $_REQUEST['transactionState'];
        $firma_cadena = "$ApiKey~$merchant_id~$referenceCode~$New_value~$currency~$transactionState";
        $firmacreada = md5($firma_cadena);
        $firma = $_REQUEST['signature'];
        $reference_pol = $_REQUEST['reference_pol'];
        $cus = $_REQUEST['cus'];
        $extra1 = $_REQUEST['description'];
        $pseBank = $_REQUEST['pseBank'];
        $lapPaymentMethod = $_REQUEST['lapPaymentMethod'];
        $transactionId = $_REQUEST['transactionId'];

        if ($_REQUEST['transactionState'] == 4) {
            $estadoTx = "Transacción aprobada";
        } else if ($_REQUEST['transactionState'] == 6) {
            $estadoTx = "Transacción rechazada";
        } else if ($_REQUEST['transactionState'] == 104) {
            $estadoTx = "Error";
        } else if ($_REQUEST['transactionState'] == 7) {
            $estadoTx = "Transacción pendiente";
        } else {
            $estadoTx = $_REQUEST['mensaje'];
        }

        if (strtoupper($firma) == strtoupper($firmacreada)) {
            return view('response', ['reference_pol' => $reference_pol, 'cus' => $cus, 'extra1' => $extra1, 'pseBank' => $pseBank, 'lapPaymentMethod' => $lapPaymentMethod, 'transactionId' => $transactionId, 'estadoTx' => $estadoTx, 'TX_VALUE' => $TX_VALUE, 'currency' => $currency, 'referenceCode' => $referenceCode]);
        } else {
            return view('response', ['estadoTx' => $estadoTx]);
        }
    }

    public function confirmation(Request $request)
    {

        $api_key = "ZElCqBCT3c73Pw94x5QIzifGB1";
        $merchant_id = $request->input('merchant_id');
        $reference_sale = $request->input('reference_sale');
        $value = $request->input('value');
        $state_pol = $request->input('state_pol');
        $sign = $request->input('sign');

        $response_code_pol = $request->input('response_code_pol');
        $payment_method_type = $request->input('payment_method_type');
        $currency = $request->input('currency');
        $payment_method_id = $request->input('payment_method_id');
        $response_message_pol = $request->input('response_message_pol');
        $email_buyer = $request->input('email_buyer');
        $cus = $request->input('cus');
        $date = $request->input('date');

        $firma = md5($api_key . "~" . $merchant_id . "~" . $reference_sale . "~" . $value . "~COP" . $state_pol);

        $user = User::where(['email' => $email_buyer])->first();

        if ($firma == $sign) {

            $payment = new payment();

            $payment->user_id = $user->id;
            $payment->reference_sale = $reference_sale;
            $payment->value = $value;
            $payment->state_pol = $state_pol;
            $payment->response_code_pol = $response_code_pol;
            $payment->payment_method_type = $payment_method_type;
            $payment->currency = $currency;
            $payment->payment_method_id = $payment_method_id;
            $payment->response_message_pol = $response_message_pol;
            $payment->email_buyer = $email_buyer;
            $payment->cus = $cus;
            $payment->date = $date;

            $payment->save();
        }
        $payment = new payment();

        $payment->user_id = $user->id;
        $payment->reference_sale = $reference_sale;
        $payment->value = $value;
        $payment->state_pol = $state_pol;
        $payment->response_code_pol = $response_code_pol;
        $payment->payment_method_type = $payment_method_type;
        $payment->currency = $currency;
        $payment->payment_method_id = $payment_method_id;
        $payment->response_message_pol = $response_message_pol;
        $payment->email_buyer = $email_buyer;
        $payment->cus = $cus;
        $payment->date = $date;

        $payment->save();
    }
}
