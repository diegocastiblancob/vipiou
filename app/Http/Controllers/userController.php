<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
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
    

    public function update(Request $request){
        //usuario logueado
        $user= Auth::user();
        $id=$user->id;

        //recoger del formulario
        $name=$request->input('name');
        $lastname=$request->input('lastname');
        $identification=$request->input('identification');
        $address=$request->input('address');
        $city=$request->input('city');
        $phone=$request->input('phone');
        $email=$request->input('email');
        $name_company=$request->input('name_company');
        $nit_company=$request->input('nit_company');
        $owner_company=$request->input('owner_company');

        //caragar objeto
        $user->name=$name;
        $user->lastname=$lastname;
        $user->identification=$identification;
        $user->address=$address;
        $user->city=$city;
        $user->phone=$phone;
        $user->email=$email;
        $user->name_company=$name_company;
        $user->nit_company=$nit_company;
        $user->owner_company=$owner_company;

        $user->update();

        return redirect()->route('cuenta')->with(['message'=>'Informacion actualizada correcatemente']);
    }
}
