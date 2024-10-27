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
use App\Models\ServiceCategory;


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
		 
		 
	 
		$service  = Service::create($data);
	 
	 
	 foreach($data['imgfields'] as $imgPath){
		 $subData['path']=$imgPath['path'];
		 $subData['service_id']=	$service->id;
		$serviceImage = ServiceImage::create( $subData);
	 }
	 
		return to_route('service.index');
    }
 
 
    public function edit($id)
    {
		  
		  $service = Service::find($id);
		 	
		    $serviceCategories = ServiceCategory::all(); 
			$serviceImages = ServiceImage::where('service_id',$id)->get();


		$serviceImageArr=[];
		foreach($serviceImages as $xx=> $imgItm){
			$serviceImageArr[$xx]['path']=$imgItm->path;
			$serviceImageArr[$xx]['imagpathshow']=$imgItm->image_path;
			$serviceImageArr[$xx]['img_id']=$imgItm->id;
		}

		$departments = Department::all(); 

		 return Inertia::render('service/edit',[
		 'departments'=>$departments ,  
		 'serviceImageArr'=>$serviceImageArr ,
		 'service'=>$service ,
		 'serviceCategories'=>$serviceCategories 
		 ]);
    }
	
	
	 public function view($id)
    {
		  
		  
		 $service = Service::where('id',$id)
		 ->with('serviceImages')
		   ->with('category')
		   ->with('category.parentCategory')
		 ->with('user') ->first();; 
		 

		 return Inertia::render('service/view',[
	 
		 'service'=>$service , 
		 ]);
		 
		 
    }
	
	
	
	
	
		
	 public function change_status(Request $request)
    {
		  
		  $service_id=$request->get('service_id');
		  $status=$request->get('status');
		

		$service = Service::where('id',$service_id) ->first();; 
		 $service->status=2;
		 $service->save();

		return to_route('service.index');
		
		
    }
	
	
	
	
	
	
	
 
    public function update($id,Request $request)
    {
		$data	= $request->all();
 
	 
		$service = Service::find($id); 
		
		
		
		
		$service->update($data);
		
		$serviceImage = ServiceImage::where('service_id',$id)->delete();
		
			 foreach($data['imgfields'] as $imgPath){
		 $subData['path']=$imgPath['path'];
		 $subData['service_id']=	$service->id;
		$serviceImage = ServiceImage::create( $subData);
	 }
		
		
		
		return to_route('service.index');
    }
 
    public function destroy($id)
    {
			$service=Service::find($id);
			$service->delete();
			
			return to_route('service.index');
    }
	
	
	 
	
	
}
