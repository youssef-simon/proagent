<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller; 
use App\Models\UserLink;
use App\Models\Notification;

use App\Models\UserProjectImage; 
 
class UserLinkController extends Controller
{


	public function create()
	{
		return Inertia::render('front/userlinks/create');
	}

	public function index()
	{
		$user = \Auth::guard('web')->user();
		$userLinks = UserLink::where('user_id', $user->id)
		->orderBy('id','desc')
		->paginate(12);

		return Inertia::render('front/userlinks/index', [
			"userLinks" => $userLinks,
		]);
	}


	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$data = $request->all();
		 
		$validatedData = $request->validate([
		    'title' => 'required', 
		    'description' => 'required',  
		 ]);
		
		$user = \Auth::guard('web')->user();

		$data['user_id'] =   $user->id;
		 $data['status']=1;
		 
		$userLink  = UserLink::create($data);

    
		return to_route('my_links');
	}
 
	public function edit($id)
	{
		$userLink = UserLink::find($id);
		  
		return Inertia::render('front/userlinks/edit', [
		 
			'userlink' => $userLink,
		]);
	}

 

	public function update($id, Request $request)
	{
		$data	= $request->all();

		$userLink = UserLink::find($id);
		$userLink->update($data);

 
		return to_route('my_links');
	}
	
	 
	public function destroy($id)
    {
			$userLink=UserLink::find($id);
			$userLink->delete();
			
			return to_route('my_links');
    }
	
}
