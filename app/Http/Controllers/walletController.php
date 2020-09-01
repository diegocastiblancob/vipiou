<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\credit;
use App\User;

class walletController extends Controller
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
        $user = Auth::user();
        $id = $user->id;

        $credits = DB::select("SELECT credits.id As credit_id, no_fee, statu_fee, date_expiration_fee, price_fee, sales.sale_target, customers.name_customer, customers.lastname_customer FROM credits INNER JOIN sales ON sales.id=credits.sale_id INNER JOIN customers on customers.id=sales.customer_id INNER JOIN users on users.id=customers.user_id WHERE credits.statu_fee != 'PAGO' AND users.id=1 ORDER BY sales.id DESC", [$id]);

        return view('wallet', ['credits' => $credits]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update($id)
    {
        $credit = credit::find($id);
        $credit->statu_fee = 'PAGO';
        $credit->update();
        //usuario logueado
        $user = Auth::user();
        $id = $user->id;

        $credits = DB::select("SELECT credits.id As credit_id, no_fee, statu_fee, date_expiration_fee, price_fee, sales.sale_target, customers.name_customer, customers.lastname_customer FROM credits INNER JOIN sales ON sales.id=credits.sale_id INNER JOIN customers on customers.id=sales.customer_id INNER JOIN users on users.id=customers.user_id WHERE credits.statu_fee != 'PAGO' AND users.id=1 ORDER BY sales.id DESC", [$id]);

        return view('wallet', ['credits' => $credits]);
    }

    public function collectionandpayment()
    {
        //usuario logueado
        $user = Auth::user();
        $id = $user->id;

        $credits = DB::select("SELECT credits.id As credit_id, no_fee, statu_fee, date_expiration_fee, price_fee, sales.sale_target, customers.name_customer, customers.lastname_customer FROM credits INNER JOIN sales ON sales.id=credits.sale_id INNER JOIN customers on customers.id=sales.customer_id INNER JOIN users on users.id=customers.user_id WHERE credits.statu_fee != 'PAGO' AND users.id=1 ORDER BY sales.id DESC", [$id]);
        $expenses = User::find($id)->load('expense');

        //print_r($expenses);
        return view('collectionAndPayments', ['credits'=>$credits, 'expenses'=>$expenses->expense]);
    }
}
