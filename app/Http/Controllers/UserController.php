<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Doctor;
use App\Models\Subject;
use App\Models\User;
use App\Models\Address;
use App\Models\Department;
use App\Models\ServiceCategory;
use App\Models\UserCategory;
use Illuminate\Validation\Rule; //import Rule class 
use Hash;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $users = User:: paginate(10);
	 
       return Inertia::render('user/index',[ 'users'=>$users  ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { 
		$serviceCategories = ServiceCategory::with('department')->get();
		
		$serviceCats=[];
		//dd($departments );
		foreach($serviceCategories as $depItm){
			
			$serviceCats[$depItm->department->id]['name'] = $depItm->department->name;
			$serviceCats[$depItm->department->id]['chidern'][] =[ 'title'=>$depItm->title , 'id'=>$depItm->id];
			
		} 
	   return Inertia::render('user/create',['serviceCats'=>$serviceCats]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
		 $data	= $request->all();
		 $data['password'] = Hash::make($data['password']);
	    $user = User::create($data);
		 
	$userCategories =	$data['user_categories'];
	
	foreach($userCategories  as $userCategoryItm){
			$serviceCategory =	ServiceCategory::find($userCategoryItm);
	 
		
		
		 $subData['user_id']= $user ->id;
		 $subData['department_id']=	 $serviceCategory->department_id;
		 $subData['category_id']=	 $serviceCategory->id;
		$serviceImage = UserCategory::create( $subData);
			
	}
		
		
		
		
		
		
		
		
		return to_route('user.index');
    }

 
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
              $user=User::find($id);
			  $departments = Department::all();
			  
			  
			  		 $mainImg ="";
		
		if(isset($user->mainImage)){
			$mainImg = $user->mainImage->path;
		 }
		 
		  $user->img_path= $mainImg;
		 
		 
		 	$userCategories = UserCategory::where('user_id',$id)->pluck('category_id');
		 
		 
		 $serviceCategories = ServiceCategory::with('department')->get();
		
		$serviceCats=[];
		//dd($departments );
		foreach($serviceCategories as $depItm){
			
			$serviceCats[$depItm->department->id]['name'] = $depItm->department->name;
			$serviceCats[$depItm->department->id]['chidern'][] =[ 'title'=>$depItm->title , 'id'=>$depItm->id];
			
		} 
		 
		 
		 
		  return Inertia::render('user/edit',[ 'user'=>$user  , 'departments'=>$departments->toArray() ,'userCategories'=>$userCategories, 'serviceCats'=>$serviceCats ]);
    }

  

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
           $admin=User::find($id);
			$admin->delete();
			return to_route('user.index');
    }
	
	
	
    /**
     * Remove the specified resource from storage.
     */
    public function searchByName(Request $request)
    {
			$term = $request->get('term');
           
 		    $users = User::where('first_name', 'like', $term.'%')->limit(10)->get();
			 
			  return response()->json([
							'data' =>$users ,  
				]);	
				
    }
	
	
	
	
	
    /**
     * Remove the specified resource from storage.
     */
    public function getUserdata($id)
    { 
 		     $user = User::find($id);
			 
			 
			return response()->json([
							'data' =>$user ,   
				]);	
				
    }
	  
    public function changeDepart($id)
    { 
 		     $serviceCategories = ServiceCategory::where('department_id',$id) ->get();
			 return response()->json([
							'data' =>$serviceCategories ,   
				]);	
     }
	
	public function changeCategory($id)
    { 
 		     $serviceCategories = ServiceCategory::where('parent_id',$id)->get();
			 return response()->json([
							'data' =>$serviceCategories ,   
				]);	
     }
	
    /**
     * Update the specified resource in storage.
     */
    public function update($id,Request $request)
    {
		  $data	= $request->all();
		  $validatedData = $request->validate([
			'email' => 'required|email', // Example validation rules
		]);
		
	 ;
	  
		$user = User::find($id); 
		$user->update($data);
		return to_route('user.index');
    }

}
