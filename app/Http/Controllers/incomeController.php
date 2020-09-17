<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\credit;
use App\User;
use App\otherincome;

class incomeController extends Controller
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

        $credits = DB::select("SELECT credits.id As credit_id, no_fee, statu_fee, date_expiration_fee, price_fee, sales.sale_target, customers.name_customer, customers.lastname_customer FROM credits INNER JOIN sales ON sales.id=credits.sale_id INNER JOIN customers on customers.id=sales.customer_id INNER JOIN users on users.id=customers.user_id WHERE users.id=1 ORDER BY sales.id DESC", [$id]);
        $incomes = DB::select("SELECT * FROM otherincomes WHERE user_id=?", [$id]);

        return view('income', ['credits' => $credits, 'incomes' => $incomes]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indexIncomes()
    {
        //usuario logueado
        $user = Auth::user();
        $id = $user->id;

        $credits = DB::select("SELECT credits.id As credit_id, no_fee, statu_fee, date_expiration_fee, price_fee, sales.sale_target, customers.name_customer, customers.lastname_customer FROM credits INNER JOIN sales ON sales.id=credits.sale_id INNER JOIN customers on customers.id=sales.customer_id INNER JOIN users on users.id=customers.user_id WHERE users.id=1 ORDER BY sales.id DESC", [$id]);
        $incomes = DB::select("SELECT * FROM otherincomes WHERE user_id=? ORDER BY id DESC", [$id]);

        return view('allincomes', ['credits' => $credits, 'incomes' => $incomes]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        //usuario logueado
        $user = Auth::user();
        $id = $user->id;

        $target_income = $request->input('target_income');
        $date_income = $request->input('date_income');
        $description_income = $request->input('description_income');
        $price_income = $request->input('price_income');

        $otherincome = new otherincome();
        $otherincome->user_id = $id;
        $otherincome->target_income = $target_income;
        $otherincome->date_income = $date_income;
        $otherincome->description_income = $description_income;
        $otherincome->price_income = $price_income;

        $otherincome->save();

        return redirect()->route('ingreso')->with(['message' => 'Ingreso guardado correctemente']);   
    }
}
