<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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

        //tomar imagen
        $image_path=$request->file('image_path');

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

        //subir imagen
        if($image_path){
            $image_path_name=time().$image_path->getClientOriginalName();

            Storage::disk('images')->put($image_path_name, File::get($image_path));

            $user->logo_company=$image_path_name;
        }
        
        $user->update();

        return redirect()->route('cuenta')->with(['message'=>'Informacion actualizada correcatemente']);
    }
}
