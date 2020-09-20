<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\customer;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\proposal;
use App\proposal_action;

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
        $user = Auth::user();
        $id = $user->id;

        $customers = DB::select('SELECT * FROM customers WHERE user_id=? and status_customer=2 ORDER BY id DESC ', [$id]);
        $customerPotencials = DB::select('SELECT * FROM customers WHERE user_id=? and status_customer=3 ORDER BY id DESC', [$id]);

        return view('customer', ['customers' => $customers, 'customerPotencials' => $customerPotencials]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($id)
    {
        $customer = customer::find($id)->load('sale', 'proposal', 'task');

        return view('showCustomer', ['customer' => $customer]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'nombre_cliente' => ['required', 'regex:/^[\pL\s\-]+$/u', 'max:100'],
            'apellido_cliente' => ['required', 'regex:/^[\pL\s\-]+$/u', 'max:100'],
            'identificacion_cliente' => ['required', 'numeric'],
            'direccion_cliente' => ['string', 'max:100'],
            'ciudad_cliente' => ['string', 'max:100'],
            'telefono_cliente' => ['required', 'numeric'],
            'empresa_cliente' => ['required', 'regex:/^[\pL\s\-]+$/u', 'max:100'],
            'website_cliente' => ['string', 'max:100'],
            'estado_cliente' => ['required', 'numeric', 'min:1', 'max:2'],
            'email_customer' => ['required', 'string', 'email', 'max:255', 'unique:customers']
        ]);

        //usuario logueado
        $user = Auth::user();
        $id = $user->id;

        //CHEC DE VALIDACION PARA FINANCIAMIENTO
        $sale_chec = $request->input('chec');
        //recoger del formulario
        $name_customer = $request->input('nombre_cliente');
        $lastname_customer = $request->input('apellido_cliente');
        $identification_customer = $request->input('identificacion_cliente');
        $address_customer = $request->input('direccion_cliente');
        $city_customer = $request->input('ciudad_cliente');
        $phone_customer = $request->input('telefono_cliente');
        $email_customer = $request->input('email_customer');
        $company_customer = $request->input('empresa_cliente');
        $website_customer = $request->input('website_cliente');
        $status_customer = $request->input('estado_cliente');

        //datos propuesta
        $title = $request->input('titulo_propuesta');
        $date_proposal = $request->input('fecha_propuesta');
        $description = $request->input('descripcion_propuesta');

        $field_action_array = $_REQUEST['field_action'];
        $field_date_array = $_REQUEST['field_date'];

        //caragar objeto
        $customer = new customer();

        $customer->user_id = $id;
        $customer->name_customer = $name_customer;
        $customer->lastname_customer = $lastname_customer;
        $customer->identification_customer = $identification_customer;
        $customer->address_customer = $address_customer;
        $customer->city_customer = $city_customer;
        $customer->phone_customer = $phone_customer;
        $customer->email_customer = $email_customer;
        $customer->company_customer = $company_customer;
        $customer->website_customer = $website_customer;
        $customer->status_customer = $status_customer;

        $customer->save();
        $customer_id = $customer->id;

        //var_dump($sale_chec);die();
        if ($sale_chec) {
            $this->validate($request, [
                'titulo_propuesta' => ['required', 'alpha', 'max:150'],
                'fecha_propuesta' => ['required'],
                'descripcion_propuesta' => ['required']
            ]);
            $proposal = new proposal();
            $proposal->customer_id = $customer_id;
            $proposal->title_proposal = $title;
            $proposal->date_proposal = $date_proposal;
            $proposal->description_proposal = $description;
            $proposal->save();
            $proposal_id = $proposal->id;
            if (!empty($field_action_array) && $proposal_id) {
                foreach ($field_action_array as $value => $item) {
                    $fee = $value;
                    $proposal_action = new proposal_action();
                    $proposal_action->proposal_id = $proposal_id;
                    $proposal_action->action_proposal = $item;
                    $proposal_action->date_action = $field_date_array[$fee];
                    $proposal_action->save();
                }
            }
        }
        return redirect()->route('cliente')->with(['message' => 'Cliente guardado correctemente']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'nombre_cliente' => ['required', 'regex:/^[\pL\s\-]+$/u', 'max:100'],
            'apellido_cliente' => ['required', 'regex:/^[\pL\s\-]+$/u', 'max:100'],
            'identificacion_cliente' => ['required', 'numeric'],
            'direccion_cliente' => ['string', 'max:100'],
            'ciudad_cliente' => ['string', 'max:100'],
            'telefono_cliente' => ['required', 'numeric'],
            'empresa_cliente' => ['required', 'regex:/^[\pL\s\-]+$/u', 'max:100'],
            'website_cliente' => ['string', 'max:100'],
            'estado_cliente' => ['required', 'numeric', 'min:1', 'max:2'],
            'email_customer' => ['required', 'string', 'email', 'max:255']
        ]);

        //usuario logueado
        $user = Auth::user();
        $id = $user->id;

        //recoger del formulario
        $id_customer = $request->input('id');
        $name_customer = $request->input('nombre_cliente');
        $lastname_customer = $request->input('apellido_cliente');
        $identification_customer = $request->input('identificacion_cliente');
        $address_customer = $request->input('direccion_cliente');
        $city_customer = $request->input('ciudad_cliente');
        $phone_customer = $request->input('telefono_cliente');
        $email_customer = $request->input('email_customer');
        $company_customer = $request->input('empresa_cliente');
        $website_customer = $request->input('website_cliente');
        $status_customer = $request->input('estado_cliente');

        //caragar objeto
        $customer = customer::find($id_customer);

        $customer->id = $id_customer;
        $customer->user_id = $id;
        $customer->name_customer = $name_customer;
        $customer->lastname_customer = $lastname_customer;
        $customer->identification_customer = $identification_customer;
        $customer->address_customer = $address_customer;
        $customer->city_customer = $city_customer;
        $customer->phone_customer = $phone_customer;
        $customer->email_customer = $email_customer;
        $customer->company_customer = $company_customer;
        $customer->website_customer = $website_customer;
        if ($status_customer == 0) {
            $customer->status_customer = $customer->status_customer;
        } else {
            $customer->status_customer = $status_customer;
        }

        $customer->update();

        return redirect()->route('cliente.detalle', ['id' => $id_customer]);
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function follow()
    {
        //usuario logueado
        $user = Auth::user();
        $id = $user->id;

        $tasks = DB::select('SELECT task_actions.action_task, task_actions.date_action_task FROM task_actions INNER JOIN tasks on tasks.id=task_actions.task_id INNER JOIN customers ON customers.id=tasks.customer_id INNER JOIN users ON users.id=customers.user_id WHERE users.id=? ORDER BY task_actions.date_action_task DESC;', [$id]);
        $activities = DB::select('SELECT proposal_actions.action_proposal, proposal_actions.date_action FROM proposal_actions INNER JOIN proposals on proposals.id=proposal_actions.proposal_id INNER JOIN customers ON customers.id=proposals.customer_id INNER JOIN users ON users.id=customers.user_id WHERE users.id=? ORDER BY proposal_actions.date_action DESC;', [$id]);

        return view('followCustomer', ['tasks' => $tasks, 'activities' => $activities]);
    }
}
