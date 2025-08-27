<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
 
use App\Models\Subject; 
use App\Models\Category; 
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Http\Request;

class SubjectController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexCategory $request
     * @return array|Factory|View
     */
    public function index()
    {
			$subjects = Subject::withCount('posts')->paginate(60); 
       return Inertia::render('subject/index',[ 'subjects'=>$subjects ]);
	    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
		
		$categories = Category::all();
         return Inertia::render('subject/create',['categories'=>$categories]);
    }

     
    public function store(Request $request)
    { 
        $data = $request->all(); 
		
			      $request->validate([
				  'title' => 'required', 
				  'description' => 'required', 
				]) ;
		
        $subject = Subject::create($data);
  
        return to_route('subject.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit($id)
    {
		  $subject=Subject::find($id);
		  $categories = Category::all();
		  
		  return Inertia::render('subject/edit',[ 'subject'=>$subject->toArray(),'categories'=>$categories  ]);
    }

  
    public function update(Request $request, $id)
    {
		$getRequest	= $request->all(); 
		
			$request->validate([
				  'title' => 'required', 
				  'description' => 'required', 
				]) ;
		
		$subject = Subject::find($id); 
		$subject->update($getRequest);
		
		return to_route('subject.index');
    }
 
    public function destroy($id)
    {
		 $subject=Subject::find($id);
		
		  $subject->delete();
			
		return to_route('subject.index');
    }

     public function getSubjectByCat($id)
    {
		$subjects = Subject::where('category_id',$id)->get();
			
			return response()->json(
							$subjects 
			);
    }
}
