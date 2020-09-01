<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\expense;
use App\User;

class expenseController extends Controller
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

        $typesExpenses = User::find($id)->load('typeofexpense');
        $expenses = User::find($id)->load('expense');

        return view('expense', ['typesExpenses' => $typesExpenses->typeofexpense, 'expenses' => $expenses->expense]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indexexpenses()
    {
        //usuario logueado
        $user = Auth::user();
        $id = $user->id;

        $typesExpenses = User::find($id)->load('typeofexpense');
        $expenses = User::find($id)->load('expense');

        return view('allExpense', ['typesExpenses' => $typesExpenses->typeofexpense, 'expenses' => $expenses->expense]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($id)
    {
        $expense = expense::find($id);

        return view('showExpense', ['expense' => $expense]);
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

        $name_type_expense = $request->input('name_type_expense');
        $title_expense = $request->input('title_expense');
        $date_expense = $request->input('date_expense');
        $description_expense = $request->input('description_expense');
        $price_expense = $request->input('price_expense');
        $status_expense = $request->input('status_expense');

        $expense = new expense();
        $expense->user_id = $id;
        $expense->name_type_expense = $name_type_expense;
        $expense->title_expense = $title_expense;
        $expense->date_expense = $date_expense;
        $expense->description_expense = $description_expense;
        $expense->price_expense = $price_expense;

        if ($status_expense == 'on') {
            $expense->status_expense = 'PENDIENTE';
        } else {
            $expense->status_expense = 'PAGADO';
        }

        $expense->save();

        return redirect()->route('egreso')->with(['message' => 'Egresos guardado correcatemente']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request, $id)
    {
        $title_expense = $request->input('title_expense');
        $date_expense = $request->input('date_expense');
        $price_expense = $request->input('price_expense');
        $status_expense = $request->input('status_expense');

        $expense = expense::find($id);
        $expense->title_expense = $title_expense;
        $expense->date_expense = $date_expense;
        $expense->price_expense = $price_expense;
        $expense->status_expense = $status_expense;

        $expense->update();

        return redirect()->route('egreso.detalle', ['id' => $id])->with(['message' => 'Egresos actualizado correcatemente']);
    }
}
