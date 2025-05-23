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
use App\Models\Notification;


class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $services = Service:: with('user') ;
		
		$status = $request->get('status');
		
		if(isset($status ) || $status !=0){
			   $services =  $services->where('status',$status );
		}
		
        $services =  $services->paginate(10);
		
		
		
	    return Inertia::render('service/index_all',[ 'services'=>$services  ]);
    }
	
	
	
	
	
	
	    /**
     * Display a listing of the resource.
     */
    public function index_user($id)
    {
        $services = Service::where('user_id',$id)-> paginate(10);
	 
	    return Inertia::render('service/index',[ 'services'=>$services,'id'=>$id  ]);
    }
	

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
		$departments = Department::all(); 
		$serviceCategories = ServiceCategory::all(); 
		
        return Inertia::render('service/create',[
				'departments'=>$departments ,  
				'serviceCategories'=>$serviceCategories   ,
				'id'=>$id   
	   
	   ]  );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$id)
    {
        $data = $request->all(); 
        $data['user_id']=$id; 
		  
		$service  = Service::create($data);
	 
	 
	 foreach($data['imgfields'] as $imgPath){
		 $subData['path']=$imgPath['path'];
		 $subData['service_id']=	$service->id;
		$serviceImage = ServiceImage::create( $subData);
	 }
	 
	   
	 
		return to_route('service.indexbyid',['id'=>$id]);
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
		  $reason=$request->get('reason');
		

		$service = Service::where('id',$service_id) ->first();; 
		 $service->status= $status;
		 $service->reason= $reason;
		 $service->save();
		 
		 
		 $serviceLnkHref ="/service_view/".$service_id;
		 $serviceLnk='<a href="'. $serviceLnkHref.'">'.$service ->title.'</a>';
		 if($status==Service::STATUS_ACCEPTED){
		 $data['description']= "your service  $serviceLnk has been accepted check your service page"." <a href='/service_list'>services page</a>";
		 }
		 
		 
		if($status==Service::STATUS_REFUSED){
		 $data['description']= "your service  $serviceLnk you put doesnt accepted check your service page"." <a href='/service_list'>services page</a>";
		 }
		 
		 if($status==Service::STATUS_PENDING){
		 $data['description']= "your service  $serviceLnk is under Invertigating"." <a href='/service_list'>services page</a>";
		 }
		
		 $data['user_id'] = $service->user_id;
		
		Notification::create($data);

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
		
		return to_route('service.indexbyid',['id'=>$service->user_id]);
		 
    }
 
    public function destroy($id)
    {
			$service=Service::find($id);
			$service->delete();
			
			return to_route('service.index');
    }
	
	
	 
	
	
}
