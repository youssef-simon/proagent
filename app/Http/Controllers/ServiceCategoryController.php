<?php

namespace App\Http\Controllers;
 
 
use Illuminate\Http\Request;
use Inertia\Inertia;
use Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rules\Password;
 
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Department;


class ServiceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servicecategories = ServiceCategory:: paginate(10);
	 
	    return Inertia::render('servicecategory/index',[ 'servicecategories'=>$servicecategories  ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
		
		$departments = Department::all(); 
		  
		  return Inertia::render('servicecategory/create',[
						'departments'=>$departments ,   
				]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all(); 
		 
	 
		$services  = ServiceCategory::create($data);
	 
		return to_route('service_category.index');
    }
 
 
    public function edit($id)
    {
		  //$department = Department::find($id);
		  
		  $serviceCategory = ServiceCategory::find($id);
		  return Inertia::render('servicecategory/edit',[ 'serviceCategory'=>$serviceCategory  ]);
    }
 
    public function update($id,Request $request)
    {
		$data	= $request->all();
 
		$serviceCategory = serviceCategory::find($id); 
		$serviceCategory->update($data);
		
		return to_route('service_category.index');
    }
 
    public function destroy($id)
    {
			$service=Service::find($id);
			$service->delete();
			
			return to_route('service_category.index');
    }
	
	
	 
	
	
}
