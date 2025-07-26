<?php

namespace App\Http\Controllers;
 
 
use Illuminate\Http\Request;
use Inertia\Inertia;
use Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rules\Password;
 
use App\Models\UserProject;  
use App\Models\UserLink;  
use App\Models\User; 
use App\Models\Notification; 

class UserLinkController extends Controller
{
	
	
	
    /**
     * Display a listing of the resource.
     */
    public function indexall(Request $request)
    {
        $userLinks = UserLink:: orderBy('id','desc');
		 
		
		$status = $request->get('status');
		
		if(isset($status ) || $status !=0){
			   $userLinks =  $userLinks->where('status',$status );
		}
		    $userLinks =  $userLinks->paginate(10);
		
	    return Inertia::render('userlink/indexall',[ 'userLinks'=>$userLinks   ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
		$user = User::find($id);
		
        return Inertia::render('userlink/create',[
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
		
		$userLink  = UserLink::create($data);
	 
		return to_route('userlink.index',['id'=> $id]);
    }
 
 
    public function edit($id)
    {
		 $userLink = UserLink::find($id); 
	 
		 return Inertia::render('userlink/edit',[
					 	'userlink'=>$userLink, 
		 ]);
		 
		 
    }
 
    public function update($id,Request $request)
    {
		$data	= $request->all();
 
	 	$userLink = UserLink::find($id); 
		$userLink->update($data);
		
		 
		return to_route('userlink.index',['id'=>  $userLink->user_id ]);
	 
    }
 
    public function destroy($id)
    {
			$service=UserLink::find($id);
			$service->delete();
			
			return to_route('userproject.index');
    }
	
	 public function view($id)
    {
	    $userLink = UserLink::where('id',$id)->first();
		
		return Inertia::render('userlink/view',[
					'userlink'=>$userLink , 
				]); 
    }
	
	
		 public function change_status(Request $request)
    {
		  
		  $userlink_id=$request->get('userlink_id');
	 
			$status=$request->get('status');
		   $reason=$request->get('reason');

		 $userLink = UserLink::where('id',$userlink_id) ->first();; 
		 $userLink->status= $status;
		 $userLink->reason= $reason;
		 $userLink->save();
 
		
		
		return to_route('userlink.index');
		
		
    }
	 
	
	
}
