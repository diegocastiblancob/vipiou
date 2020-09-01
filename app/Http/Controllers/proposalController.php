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

        return view('showProposal', ['proposal' => $proposal]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $id_customer = $request->input('id_customer');
        $title = $request->input('title_proposal');
        $date_proposal = $request->input('date_proposal');
        $description = $request->input('description_proposal');
        $action = $request->input('proposal_action');
        $date_action = $request->input('date_action');

        $proposal = new proposal();
        $proposal->customer_id = $id_customer;
        $proposal->title_proposal = $title;
        $proposal->date_proposal = $date_proposal;
        $proposal->description_proposal = $description;

        $proposal->save();
        $id_proposal = $proposal->id;

        $proposal_action = new proposal_action();
        $proposal_action->proposal_id = $id_proposal;
        $proposal_action->action_proposal = $action;
        $proposal_action->date_action = $date_action;

        $proposal_action->save();

        return redirect()->route('propuesta')->with(['message' => 'Propuesta guardada correcatemente']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request, $id_proposal)
    {

        $this->validate($request, [
            'title_proposal' => 'required',
            'date_proposal' => 'required',
            'description_proposal' => 'required'
        ]);
        
        $title = $request->input('title_proposal');
        $date_proposal = $request->input('date_proposal');
        $description = $request->input('description_proposal');

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
