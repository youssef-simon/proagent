<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
  
use App\Models\Department; 
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


class DepartmentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexCategory $request
     * @return array|Factory|View
     */
    public function index()
    { 
		$departments =   Department:: paginate(10);
					
       return Inertia::render('department/index',[ 'departments'=>$departments  ]);
	    
    }
 
    public function create()
    {
     
          return Inertia::render('department/create');
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
		 
        $attribute = Department::create($data);
  
        return to_route('department.index');
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
		  $department = Department::find($id);
		   
		  return Inertia::render('department/edit',[ 'department'=>$department->toArray()  ]);
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
		$data	= $request->all(); 
		
		$department = Department::find($id); 
		$department->update($data);
		
		return to_route('department.index');
    }

  
 
    public function destroy(Request $request,  $id)
    {
		
		$department = Department::find($id); 
        $department->delete();

        
        return redirect()->back();
    }

 
}
