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
        $user= Auth::user();
        $id=$user->id;

        $customers=User::find($id)->load('customer');
        $tasks = DB::select('SELECT tasks.id As task_id, customers.name_customer, customers.lastname_customer, tasks.title_task, tasks.date_task, tasks.description_task FROM tasks INNER JOIN customers on tasks.customer_id=customers.id INNER JOIN users on customers.user_id=users.id WHERE users.id=? ORDER BY tasks.id DESC', [$id]);

        return view('task', ['customers'=>$customers->customer, 'tasks'=>$tasks]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indextask()
    {
        //usuario logueado
        $user= Auth::user();
        $id=$user->id;

        $tasks = DB::select('SELECT tasks.id As task_id, customers.name_customer, customers.lastname_customer, tasks.title_task, tasks.date_task, tasks.description_task FROM tasks INNER JOIN customers on tasks.customer_id=customers.id INNER JOIN users on customers.user_id=users.id WHERE users.id=? ORDER BY tasks.id DESC', [$id]);

        return view('alltask', ['tasks'=>$tasks]);
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
        $id_customer=$request->input('id_customer');   
        $title=$request->input('title_task');   
        $date_task=$request->input('date_task');   
        $description=$request->input('description_task');   
        $action=$request->input('action_task');   
        $date_action_task=$request->input('date_action_task');   

        $task=new task();
        $task->customer_id=$id_customer;
        $task->title_task=$title;
        $task->date_task=$date_task;
        $task->description_task=$description;       
        $task->status_task=1;
        $task->save();
        $id_task=$task->id;

        $task_action=new task_action();
        $task_action->task_id=$id_task;
        $task_action->action_task=$action;
        $task_action->date_action_task=$date_action_task;
        $task_action->save();

        return redirect()->route('tarea')->with(['message'=>'Tarea guardada correcatemente']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request, $id_task)
    {

        
        $title = $request->input('title_task');
        $date_task = $request->input('date_task');
        $description = $request->input('description_task');

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
