<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceImage; 
use App\Models\UserProject; 

class MyProjectController extends Controller
{
 
 
	   public function create()
    {
	  return Inertia::render('front/works/create');
    }
 
    public function index()
    {
		 $user = \Auth::guard('web')->user();
		 $userProjects = UserProject::where('user_id',$user->id)->paginate(10); 
		 
		 return Inertia::render('front/works/index',[
				"userProjects"=>$userProjects , 
			]);
    }
 
 
	/**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $data = $request->all(); 
		 $user = \Auth::guard('web')->user();
		   
		$data['user_id'] =   $user->id;
		
		$userProject  = UserProject::create($data);
	
	 
	 foreach($data['imgfields'] as $imgPath){
		 $subData['path']=$imgPath['path'];
		  $subData['project_id']=	$userProject->id;
		$serviceImage = UserProjectImage::create( $subData);
	 }
	 
		return to_route('my_works');
    }
 
 
 
}
