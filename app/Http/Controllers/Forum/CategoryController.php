<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
 
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

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexCategory $request
     * @return array|Factory|View
     */
    public function index()
    {
			$categories = Category::paginate(60); 
       return Inertia::render('category/index',[ 'categories'=>$categories ]);
	    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
         return Inertia::render('category/create');
    }

     
    public function store(Request $request)
    { 
        $data = $request->all(); 
		
			      $request->validate([
				  'title' => 'required', 
				  'description' => 'required', 
				]) ;
		
        $category = Category::create($data);
  
        return to_route('category.index');
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
		  $category=Category::find($id);
		  
		  return Inertia::render('category/edit',[ 'category'=>$category->toArray()  ]);
    }

  
    public function update(Request $request, $id)
    {
		$getRequest	= $request->all(); 
		
			$request->validate([
				  'title' => 'required', 
				  'description' => 'required', 
				]) ;
		
		$category = Category::find($id); 
		$category->update($getRequest);
		
		return to_route('category.index');
    }
 
    public function destroy($id)
    {
		 $category=Category::find($id);
		
		  $category->delete();
			
		return to_route('category.index');
    }

   
}
