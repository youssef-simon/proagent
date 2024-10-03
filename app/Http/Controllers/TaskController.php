<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
 
use App\Models\Attribute; 
use App\Models\Task;  
use App\Models\TaskStatus;  
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Http\Request;


class TaskController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexCategory $request
     * @return array|Factory|View
     */
    public function index()
    {
		$tasks = Task::with('taskStatus')->paginate(10);/* where('status','=',1)-> */
			
			///dd($tasks );
 
       return Inertia::render('task/index',[ 'tasks'=>$tasks  ]);
	    
    }
 
    public function create()
    {
		$task_statuses=	TaskStatus::all();
		
		
		
          return Inertia::render('task/create',['task_statuses'=>$task_statuses]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategory $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(Request $request)
    { 
        $data = $request->all();
 
        $data['user_id'] = $data['emp_id']; 
		 
        $task = Task::create($data);
  
        return to_route('task.index');
    }

 

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit($id)
    {
		 $task = Task::where('id',$id) ->with('taskStatus')->with('employee')->first(); 
			
			 //dd($task->toArray());
			$taskstatuses = TaskStatus::all();
			 
		   
		  return Inertia::render('task/edit',[ 'task'=>$task->toArray(),'taskstatuses'=>$taskstatuses->toArray()    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategory $request
     * @param Category $category
     * @return array|RedirectResponse|Redirector
     */
    public function update(Request $request, $id)
    {
		$getRequest	= $request->all(); 
		//dd(	$getRequest);
		$task = Task::find($id); 
		$task->update($getRequest);
		
		return to_route('task.index');
    }

  
 
    public function destroy(Request $request,  $id)
    {
		
		$task = Task::find($id); 
        $task->delete(); 
        return redirect()->back();
    }

	
    public function tasksEmp( )
    { 

		$user = auth()->user();
		  $tasks = Task::where('user_id',$user->id)->with('taskStatus')->paginate(10);  
			 
		  return Inertia::render('task/emp_tasks',[ 'tasks'=>$tasks->toArray()  ]);
    }


 
    public function editStatus($id)
    { 
		   	$task = Task::where('id',$id) ->with('taskStatus')->first(); 
			
			
			$taskstatuses = TaskStatus::all();
			 
		  return Inertia::render('task/edit_task',[ 'task'=>$task->toArray(),'taskstatuses'=>$taskstatuses->toArray()  ]);
    }


 
    public function updateStatus(Request $request,$id)
    {
		  
		 $data	= $request->all(); 
		   
		   	$task = Task::find($id); 
		   	$task->task_status_id=$data['task_status_id']; 
		   	$task->save(); 
		   
		 		return to_route('emp.taskemp');
    }


 
}
