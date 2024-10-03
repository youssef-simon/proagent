<?php

namespace App\Http\Controllers;
 
 
use Illuminate\Http\Request;
use Inertia\Inertia;
use Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rules\Password;
 
use App\Models\Service;
use App\Models\ServiceImage; 
use App\Models\Department;


class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service:: paginate(10);
	 
	    return Inertia::render('service/index',[ 'services'=>$services  ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
		$departments = Department::all(); 
		$serviceCategories = ServiceCategory::all(); 
		
        return Inertia::render('service/create',[
				'departments'=>$departments ,  
				'serviceCategories'=>$serviceCategories   
	   
	   ]  );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all(); 
		 
		 
	 
		$services  = Service::create($data);
	 
	 
	 foreach($data['imgfields'] as $imgPath){
		 $subData['path']=$imgPath['img'];
		$serviceImage = ServiceImage::create( $subData);
	 }
	 
		return to_route('service.index');
    }
 
 
    public function edit($id)
    {
		  
		  $service = Service::find($id);
			
		  $serviceCategories = ServiceCategory::all(); 

		 return Inertia::render('service/edit',[
		 'service'=>$service ,
		 'serviceCategories'=>$serviceCategories 
		 ]);
    }
 
    public function update($id,Request $request)
    {
		$data	= $request->all();
 
	 
		$service = Service::find($id); 
		$service->update($data);
		
		return to_route('service.index');
    }
 
    public function destroy($id)
    {
			$service=Service::find($id);
			$service->delete();
			
			return to_route('service.index');
    }
	
	
	 
	
	
}
