<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller; 
use App\Models\UserProject;

use App\Models\UserProjectImage; 

class MyProjectController extends Controller
{


	public function create()
	{
		return Inertia::render('front/works/create');
	}

	public function index()
	{
		$user = \Auth::guard('web')->user();
		$userProjects = UserProject::where('user_id', $user->id)->paginate(10);

		return Inertia::render('front/works/index', [
			"userProjects" => $userProjects,
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


		foreach ($data['imgfields'] as $imgPath) {
			$subData['path'] = $imgPath['path'];
			$subData['project_id'] =	$userProject->id;
			$serviceImage = UserProjectImage::create($subData);
		}

		return to_route('my_works');
	}








	public function edit($id)
	{
		$userProject = UserProject::find($id);
		$userProjectImages = UserProjectImage::where('project_id', $id)->get();


		$userProjectImageArr = [];

		$serviceImageArr = [];
		foreach ($userProjectImages as $xx => $imgItm) {
			$userProjectImageArr[$xx]['path'] = $imgItm->path;
			$userProjectImageArr[$xx]['imagpathshow'] = $imgItm->image_path;
			$userProjectImageArr[$xx]['img_id'] = $imgItm->id;
		}

		return Inertia::render('front/works/edit', [
			'userProjectImageArr' => $userProjectImageArr,
			'userproject' => $userProject,
		]);
	}








	public function update($id, Request $request)
	{
		$data	= $request->all();

		$userProject = UserProject::find($id);
		$userProject->update($data);

		$serviceImage = UserProjectImage::where('project_id', $id)->delete();

		foreach ($data['imgfields'] as $imgPath) {
			$subData['path'] = $imgPath['path'];
			$subData['project_id'] =	$userProject->id;
			$serviceImage = UserProjectImage::create($subData);
		}
		return to_route('my_works');
	}
	
	
	
	
	
	public function destroy($id)
    {
			$userProject=UserProject::find($id);
			$userProject->delete();
			
			return to_route('my_works');
    }
	
}
