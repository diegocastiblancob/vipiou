<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\task_action;
class actionTaskController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {   
        $id_task=$request->input('task_id');   
        $action=$request->input('action_task');   
        $date_action=$request->input('date_action_task');   

        $task_action=new task_action();
        $task_action->task_id=$id_task;
        $task_action->action_task=$action;
        $task_action->date_action_task=$date_action;
        $task_action->save();

        return redirect()->route('tarea.detalle', ['id'=>$id_task])->with(['message' => 'Acción guardada correctemente']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request, $id)
    {   
        $id_task=$request->input('task_id');   
        $action=$request->input('action_task');   
        $date_action=$request->input('date_action_task');   

        $task_action=task_action::find($id);
        $task_action->action_task=$action;
        $task_action->date_action_task=$date_action;
        $task_action->update();

        return redirect()->route('tarea.detalle', ['id'=>$id_task])->with(['message' => 'Acción actualizada correctemente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        task_action::destroy($id);
        return redirect()->route('tareas');
    }
}
