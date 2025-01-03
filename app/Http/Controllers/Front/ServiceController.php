<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceImage; 

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
		 $services = Service::limit(10)->get();
		 $departments = Department::limit(10)->get();
		  
	   return Inertia::render('front/service',[
			"services"=>$services ,
			"departments"=>$departments ,
	    ]);
    }

    public function service_list_category($id,Request $request)
    {
		  $services = Service::where('category_id',$id) ->get();; 
		  
		  return Inertia::render('front/serviceCategory',[
						"services"=>$services , 
					]); 
	}	
		


	  /**
     * Display a listing of the resource.
     */
    public function taxservice()
    {
	  
		 $serviceCategories = ServiceCategory::whereNull('parent_id')->with('department')->get(); 
		$serviceCats=[]; 
		foreach($serviceCategories as $depItm){
			
			$serviceCats[$depItm->department->id]['name'] = $depItm->department->name;
			$serviceCats[$depItm->department->id]['id'] = $depItm->department->id;
			$serviceCats[$depItm->department->id]['chidern'][] =[ 'title'=>$depItm->title , 'id'=>$depItm->id];
			
		} 
		   
	   return Inertia::render('front/cats',[
			"serviceCats"=>$serviceCats , 
	    ]);
    }



	  /**
     * Display a listing of the resource.
     */
    public function serviceView($id)
    {
	  
		 $service = Service::where('id',$id)
		 ->with('serviceImages')
		   ->with('category')
		   ->with('category.parentCategory')
		 ->with('user') ->first();; 
		 
		   
	   return Inertia::render('front/serviceView',[

	   "service"=>$service , 
	   
	   ]);
    }






	  /**
     * Display a listing of the resource.
     */
    public function create_service()
    {
	  
		 $departments = Department::all(); 
		$serviceCategories = ServiceCategory::all(); 
		 
		   
	   return Inertia::render('front/service/add' ,[
				'departments'=>$departments ,  
				'serviceCategories'=>$serviceCategories   
	   
	   ]  );
    }





	  /**
     * Display a listing of the resource.
     */
    public function add_service(Request $request)
    {
	  
		 
		 $data = $request->all(); 
		 
		 
		 $user = \Auth::guard('web')->user();
		 
		 $data['user_id']= $user->id;
		 $data['status']=1;
		 
		$service  = Service::create($data);
	 
	 
	 foreach($data['imgfields'] as $imgPath){
		 $subData['path']=$imgPath['path'];
		 $subData['service_id']=	$service->id;
		$serviceImage = ServiceImage::create( $subData);
	 }
	 
	return to_route('service_list');
	  // return Inertia::render('front/service/add' );
    }
	
	 
    public function service_list()
    {
		
		   $user = \Auth::guard('web')->user();
		   $services = Service::where('user_id',$user ->id)-> paginate(40);
	 
	    return Inertia::render('front/service/index',[ 'services'=>$services  ]);
    }
	
	  public function 	service_update($id,Request $request){
		    $data	= $request->all();
		    $service = Service::find($id); 
		 	$service->update($data);
		
		   $serviceImage = ServiceImage::where('service_id',$id)->delete();
		
			 foreach($data['imgfields'] as $imgPath){
					$subData['path']=$imgPath['path'];
					$subData['service_id']=	$service->id;
					$serviceImage = ServiceImage::create( $subData);
			  }
			return to_route('service_list');
	  }
        public function service_edit($id)
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

		 return Inertia::render('front/service/edit',[
				 'departments'=>$departments ,  
				 'serviceImageArr'=>$serviceImageArr ,
				 'service'=>$service ,
				 'serviceCategories'=>$serviceCategories 
			 ]);
	  //  return Inertia::render('front/service/edit',[ 'services'=>$services  ]);
    }
	
	
	
	
	
	
	public function serviceAll($id,$child=0){
		
		
		
		
		if($child==0){
	$department =	Department::find($id);
		$categories =  ServiceCategory::where('department_id',$id)->whereNull('parent_id')->with("childCategories")->get();
		 
		 
		$services =  Service::where('department_id',$id)->with('category')->with('category.parentCategory')-> paginate(24);
		
			$alldepartments =	Department::all();
			 
		return Inertia::render('front/service_all',[
					'categories'=>$categories ,
					'services'=>$services ,
					'dep_id'=>$id ,
					'department'=>$department ,
					'alldepartments'=>$alldepartments  ,
			]);
		}else{
			$depId=$id;
			$id=$child;
			  $categories =  ServiceCategory::where('department_id',$depId)->whereNull('parent_id')->with("childCategories")->get();
		$services =  Service:: leftJoin('service_categories', 'services.category_id', '=', 'service_categories.id')
									  -> where('services.category_id',$id)
									  ->with('category.parentCategory')
									  ->orWhere('service_categories.parent_id',$id)
									 
									  ->select('services.*')
									-> paginate(24);
		 
		 	$department =	Department::find($depId);
		 
		  
		  $alldepartments =	Department::all();
			 
		return Inertia::render('front/service_cat',[
				'curr_id'=>$id ,
				'dep_id'=>$depId ,
				'categories'=>$categories,
				'services'=>$services,
				'department'=>$department ,
				'alldepartments'=>$alldepartments,
		]);
		}
		
		
	}
	
	
	public function serviceByCategory($depId,$id){ 
	    $categories =  ServiceCategory::where('department_id',$depId)->whereNull('parent_id')->with("childCategories")->get();
		$services =  Service:: leftJoin('service_categories', 'services.category_id', '=', 'service_categories.id')
									  -> where('services.category_id',$id)
									  ->with('category.parentCategory')
									  ->orWhere('service_categories.parent_id',$id)
									 
									  ->select('services.*')
									-> paginate(24);
		 
		 	$department =	Department::find($depId);
		 
		  
		return Inertia::render('front/service_cat',[
				'curr_id'=>$id ,
				'dep_id'=>$depId ,
				'categories'=>$categories,
				'services'=>$services,
				'department'=>$department ,
		]);
	}
	
	
	
    public function destroy($id)
    {
			$service=Service::find($id);
			$service->delete();
			
			return to_route('service_list');
    }
	
}
