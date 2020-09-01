<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\customer;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class customerController extends Controller
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
        $id=$user->id;

        $customers= DB::select('SELECT * FROM customers WHERE user_id=? and status_customer=2 ORDER BY id DESC ', [$id]);
        $customerPotencials= DB::select('SELECT * FROM customers WHERE user_id=? and status_customer=3 ORDER BY id DESC', [$id]);

        return view('customer', ['customers'=>$customers, 'customerPotencials'=>$customerPotencials]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($id)
    {
        $customer= customer::find($id)->load('sale','proposal', 'task');

        return view('showCustomer', ['customer'=>$customer]);
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

        //recoger del formulario
        $name_customer=$request->input('name_customer');
        $lastname_customer=$request->input('lastname_customer');
        $identification_customer=$request->input('identification_customer');
        $address_customer=$request->input('address_customer');
        $city_customer=$request->input('city_customer');
        $phone_customer=$request->input('phone_customer');
        $email_customer=$request->input('email_customer');
        $company_customer=$request->input('company_customer');
        $website_customer=$request->input('website_customer');
        $status_customer=$request->input('status_customer');

        //caragar objeto
        $customer=new customer();

        $customer->user_id=$id;
        $customer->name_customer=$name_customer;
        $customer->lastname_customer=$lastname_customer;
        $customer->identification_customer=$identification_customer;
        $customer->address_customer=$address_customer;
        $customer->city_customer=$city_customer;
        $customer->phone_customer=$phone_customer;
        $customer->email_customer=$email_customer;
        $customer->company_customer=$company_customer;
        $customer->website_customer=$website_customer;
        $customer->status_customer=$status_customer;

        $customer->save();

        return redirect()->route('cliente')->with(['message'=>'Cliente guardado correcatemente']);        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request)
    {
        //usuario logueado
        $user= Auth::user();
        $id=$user->id;

        //recoger del formulario
        $id_customer=$request->input('id');
        $name_customer=$request->input('name_customer');
        $lastname_customer=$request->input('lastname_customer');
        $identification_customer=$request->input('identification_customer');
        $address_customer=$request->input('address_customer');
        $city_customer=$request->input('city_customer');
        $phone_customer=$request->input('phone_customer');
        $email_customer=$request->input('email_customer');
        $company_customer=$request->input('company_customer');
        $website_customer=$request->input('website_customer');
        $status_customer=$request->input('status_customer');

        //caragar objeto
        $customer=customer::find($id_customer);

        $customer->id=$id_customer;
        $customer->user_id=$id;
        $customer->name_customer=$name_customer;
        $customer->lastname_customer=$lastname_customer;
        $customer->identification_customer=$identification_customer;
        $customer->address_customer=$address_customer;
        $customer->city_customer=$city_customer;
        $customer->phone_customer=$phone_customer;
        $customer->email_customer=$email_customer;
        $customer->company_customer=$company_customer;
        $customer->website_customer=$website_customer;
        if($status_customer==0){
            $customer->status_customer=$customer->status_customer;
        }else{
            $customer->status_customer=$status_customer;
        }
        
        $customer->update();

        return redirect()->route('cliente.detalle', ['id'=>$id_customer]);        
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function follow()
    {
        //usuario logueado
        $user= Auth::user();
        $id=$user->id;

        $tasks= DB::select('SELECT task_actions.action_task, task_actions.date_action_task FROM task_actions INNER JOIN tasks on tasks.id=task_actions.task_id INNER JOIN customers ON customers.id=tasks.customer_id INNER JOIN users ON users.id=customers.user_id WHERE users.id=? ORDER BY task_actions.date_action_task DESC;', [$id]);
        $activities= DB::select('SELECT proposal_actions.action_proposal, proposal_actions.date_action FROM proposal_actions INNER JOIN proposals on proposals.id=proposal_actions.proposal_id INNER JOIN customers ON customers.id=proposals.customer_id INNER JOIN users ON users.id=customers.user_id WHERE users.id=? ORDER BY proposal_actions.date_action DESC;', [$id]);

        return view('followCustomer', ['tasks'=>$tasks, 'activities'=>$activities]);
    }
}
