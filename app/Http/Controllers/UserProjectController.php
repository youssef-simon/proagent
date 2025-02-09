<?php

namespace App\Http\Controllers;
 
 
use Illuminate\Http\Request;
use Inertia\Inertia;
use Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rules\Password;
 
use App\Models\UserProject; 
use App\Models\UserProjectImage; 
use App\Models\User; 

class UserProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $userProjects = UserProject:: where('user_id',$id)->paginate(10);
		
		$user = User::find($id);
	 
	    return Inertia::render('userproject/index',[ 'userProjects'=>$userProjects,'user'=>$user   ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
		$user = User::find($id);
		
        return Inertia::render('userproject/create',[
				'user'=>$user ,   
	   
	   ]  );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$id)
    {
        $data = $request->all(); 
		 
		  
		$data['user_id'] = $id;
		
		$userProject  = UserProject::create($data);
	
	 
	 foreach($data['imgfields'] as $imgPath){
		 $subData['path']=$imgPath['path'];
		  $subData['project_id']=	$userProject->id;
		$serviceImage = UserProjectImage::create( $subData);
	 }
	 
		return to_route('userproject.index',['id'=> $id]);
    }
 
 
    public function edit($id)
    {
			$userProject = UserProject::find($id);
			$userProjectImages = UserProjectImage::where('project_id',$id)->get();
	
			 
	$userProjectImageArr=[];
	
		$serviceImageArr=[];
		foreach($userProjectImages as $xx=> $imgItm){
			$userProjectImageArr[$xx]['path']=$imgItm->path;
			$userProjectImageArr[$xx]['imagpathshow']=$imgItm->image_path;
			$userProjectImageArr[$xx]['img_id']=$imgItm->id;
		}
			  
		 return Inertia::render('userproject/edit',[
					'userProjectImageArr'=>$userProjectImageArr ,
						'userproject'=>$userProject, 
		 ]);
		 
		 
    }
 
    public function update($id,Request $request)
    {
		$data	= $request->all();
 
	 	$userProject = UserProject::find($id); 
		$userProject->update($data);
		
		
		
		
		$serviceImage = UserProjectImage::where('project_id',$id)->delete();
		
			 foreach($data['imgfields'] as $imgPath){
		 $subData['path']=$imgPath['path'];
		 $subData['project_id']=	$userProject->id;
		$serviceImage = UserProjectImage::create( $subData);
	 }
		return to_route('userproject.index',['id'=>  $userProject->user_id ]);
		return to_route('service.index');
    }
 
    public function destroy($id)
    {
			$service=UserProject::find($id);
			$service->delete();
			
			return to_route('userproject.index');
    }
	
	 public function view($id)
    {
	    $userProject = UserProject::where('id',$id)->with('user')->with('projectImages')->first();
		
		return Inertia::render('userproject/view',[
					'userproject'=>$userProject , 
				]); 
    }
	
	 
	
	
}
