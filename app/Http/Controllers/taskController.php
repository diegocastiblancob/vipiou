<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\task;
use App\task_action;
use App\User;
use Illuminate\Support\Facades\DB;

class taskController extends Controller
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
        $tasks = DB::select('SELECT tasks.id As task_id, customers.name_customer, customers.lastname_customer, tasks.title_task, tasks.date_task, tasks.description_task FROM tasks INNER JOIN customers on tasks.customer_id=customers.id INNER JOIN users on customers.user_id=users.id WHERE users.id=? ORDER BY tasks.id DESC', [$id]);

        return view('task', ['customers' => $customers->customer, 'tasks' => $tasks]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indextask()
    {
        //usuario logueado
        $user = Auth::user();
        $id = $user->id;

        $tasks = DB::select('SELECT tasks.id As task_id, customers.name_customer, customers.lastname_customer, tasks.title_task, tasks.date_task, tasks.description_task FROM tasks INNER JOIN customers on tasks.customer_id=customers.id INNER JOIN users on customers.user_id=users.id WHERE users.id=? ORDER BY tasks.id DESC', [$id]);

        return view('alltask', ['tasks' => $tasks]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($id)
    {
        $task = task::find($id)->load('customer', 'task_action');
        
        return view('showTask', ['task' => $task]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo_tarea' => ['required', 'regex:/^[\pL\s\-]+$/u', 'max:150'],
            'fecha_tarea' => ['required'],
            'descripcion_tarea' => ['required']
        ]);

        $id_customer = $request->input('id_customer');
        $title = $request->input('titulo_tarea');
        $date_task = $request->input('fecha_tarea');
        $description = $request->input('descripcion_tarea');

        $field_action_array = $_REQUEST['field_action'];
        $field_date_array = $_REQUEST['field_date'];

        $task = new task();
        $task->customer_id = $id_customer;
        $task->title_task = $title;
        $task->date_task = $date_task;
        $task->description_task = $description;
        $task->status_task = 1;
        $task->save();
        $id_task = $task->id;
        if (!empty($field_action_array) && $id_task) {
            foreach ($field_action_array as $value => $item) {
                $fee = $value;
                $task_action = new task_action();
                $task_action->task_id = $id_task;
                $task_action->action_task = $item;
                $task_action->date_action_task = $field_date_array[$fee];
                $task_action->save();
            }
        }

        return redirect()->route('tarea')->with(['message' => 'Tarea guardada correctemente']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request, $id_task)
    {
        $this->validate($request, [
            'titulo_tarea' => ['required', 'regex:/^[\pL\s\-]+$/u', 'max:150'],
            'fecha_tarea' => ['required'],
            'descripcion_tarea' => ['required']
        ]);

        $title = $request->input('titulo_tarea');
        $date_task = $request->input('fecha_tarea');
        $description = $request->input('descripcion_tarea');

        $task = task::find($id_task);
        $task->id = $id_task;
        $task->title_task = $title;
        $task->date_task = $date_task;
        $task->description_task = $description;
        $task->status_task = 1;
        $task->update();
        return redirect()->route('tarea.detalle', ['id' => $id_task]);
    }
}
