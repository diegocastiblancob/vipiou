<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\payment;

class mycountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        //usuario logueado
        $user= Auth::user();
        
        $payments = payment::all();
        $last= $payments->last();
        
        $reference=$last->reference_sale+1;

        $email_user=$user->email;
        $name_user=$user->name;
        $identification=$user->identification;
        $monto=28000;
        //$api_key="ZElCqBCT3c73Pw94x5QIzifGB1";
        $api_key="4Vj8eK4rloUd272L48hsrarnUA";

        $payment= new payment();

        //$payment->merchantId="834436";
        $payment->merchantId="508029";
        //$payment->accountId="841797";
        $payment->accountId="512321";
        $payment->description="Compra de servicios de VipioU";
        $payment->referenceCode=$reference;
        $payment->amount=$monto;
        $payment->tax="0";
        $payment->taxReturnBase="0";
        $payment->currency="COP";
        $payment->signature=md5($api_key."~".$payment->merchantId."~".$payment->referenceCode."~".$monto."~COP");
        $payment->test="1";
        $payment->buyerEmail=$email_user;
        $payment->responseUrl="http://www.vipiou.com/public/response/";
        $payment->confirmationUrl="http://www.vipiou.com/public/confirmation/";
        $payment->buyerFullName=$name_user;
        $payment->payerDocument=$identification;

        return view('mycount', ['payment'=>$payment]);
    }

}
