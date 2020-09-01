<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\typeofexpense;

class typeofexpenseController extends Controller
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
    public function store(Request $request)
    {
        //usuario logueado
        $user= Auth::user();
        $id=$user->id;

        $name_type_expenses=$request->input('name_type_expenses');   
        $description_type_expenses=$request->input('description_type_expenses');     

        $typeofexpense=new typeofexpense();
        $typeofexpense->user_id=$id;
        $typeofexpense->name_type_expenses=$name_type_expenses;
        $typeofexpense->description_type_expenses=$description_type_expenses;
        
        $typeofexpense->save();

        return redirect()->route('egresos')->with(['message'=>'Categoria de egreso guardado correcatemente']);
    }
}
