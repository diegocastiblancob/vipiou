<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\proposal_action;
class actionProposalController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {   
        $id_proposal=$request->input('proposal_id');   
        $action=$request->input('action_proposal');   
        $date_action=$request->input('date_action');   

        $proposal_action=new proposal_action();
        $proposal_action->proposal_id=$id_proposal;
        $proposal_action->action_proposal=$action;
        $proposal_action->date_action=$date_action;

        $proposal_action->save();

        return redirect()->route('propuesta.detalle', ['id'=>$id_proposal])->with(['message' => 'Accion guardada correcatemente']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request, $id)
    {   
        $id_proposal=$request->input('proposal_id');   
        $action=$request->input('action_proposal');   
        $date_action=$request->input('date_action');   

        $proposal_action=proposal_action::find($id);
        $proposal_action->action_proposal=$action;
        $proposal_action->date_action=$date_action;

        $proposal_action->update();

        return redirect()->route('propuesta.detalle', ['id'=>$id_proposal])->with(['message' => 'Accion actualizada correcatemente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        proposal_action::destroy($id);
        return redirect()->route('propuestas');
    }
}
