<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\proposal;
use App\proposal_action;
use App\User;

class proposalController extends Controller
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

        $customers = User::find($id)->load('customer');
        $proposals = DB::select('SELECT proposals.id As propasal_id, customers.name_customer, customers.lastname_customer, proposals.title_proposal, proposals.date_proposal, proposals.description_proposal FROM proposals INNER JOIN customers on proposals.customer_id=customers.id INNER JOIN users on customers.user_id=users.id WHERE users.id=? ORDER BY proposals.id DESC', [$id]);

        return view('propasal', ['customers' => $customers->customer, 'proposals' => $proposals]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indexproposal()
    {
        //usuario logueado
        $user = Auth::user();
        $id = $user->id;

        $proposals = DB::select('SELECT proposals.id As propasal_id, customers.name_customer, customers.lastname_customer, proposals.title_proposal, proposals.date_proposal, proposals.description_proposal FROM proposals INNER JOIN customers on proposals.customer_id=customers.id INNER JOIN users on customers.user_id=users.id WHERE users.id=? ORDER BY proposals.id DESC', [$id]);

        return view('allProposal', ['proposals' => $proposals]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($id)
    {
        $proposal = proposal::find($id)->load('customer', 'proposal_action');

        return view('showproposal', ['proposal' => $proposal]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id_customer' => ['required', 'numeric'],
            'titulo_propuesta' => ['required', 'regex:/^[\pL\s\-]+$/u', 'max:150'],
            'fecha_propuesta' => ['required'],
            'descripcion_propuesta' => ['required']
        ]);

        $id_customer = $request->input('id_customer');
        $title = $request->input('titulo_propuesta');
        $date_proposal = $request->input('fecha_propuesta');
        $description = $request->input('descripcion_propuesta');
        $field_action_array = $_REQUEST['field_action'];
        $field_date_array = $_REQUEST['field_date'];

        $proposal = new proposal();
        $proposal->customer_id = $id_customer;
        $proposal->title_proposal = $title;
        $proposal->date_proposal = $date_proposal;
        $proposal->description_proposal = $description;
        
        $proposal->save();
        $id_proposal = $proposal->id;
        if (!empty($field_action_array) && $id_proposal) {
            foreach ($field_action_array as $value => $item) {
                $fee = $value;
                $proposal_action = new proposal_action();
                $proposal_action->proposal_id = $id_proposal;
                $proposal_action->action_proposal = $item;
                $proposal_action->date_action = $field_date_array[$fee];
                $proposal_action->save();
            }
        }

        return redirect()->route('propuesta')->with(['message' => 'Propuesta guardada correctemente']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request, $id_proposal)
    {

        $this->validate($request, [
            'titulo_propuesta' => ['required', 'regex:/^[\pL\s\-]+$/u', 'max:150'],
            'fecha_propuesta' => ['required'],
            'descripcion_propuesta' => ['required']
        ]);

        $title = $request->input('titulo_propuesta');
        $date_proposal = $request->input('fecha_propuesta');
        $description = $request->input('descripcion_propuesta');

        $proposal = proposal::find($id_proposal);
        $proposal->id = $id_proposal;
        $proposal->title_proposal = $title;
        $proposal->date_proposal = $date_proposal;
        $proposal->description_proposal = $description;
        $proposal->file_proposal = '';
        
        $proposal->update();
        return redirect()->route('propuesta.detalle', ['id' => $id_proposal]);
    }
}
