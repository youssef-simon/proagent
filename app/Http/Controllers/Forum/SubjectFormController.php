<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
 
use App\Models\Category;
use App\Models\Post;
use App\Models\Subject;
use App\Models\Comment;
use App\Models\PostForm;
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

class SubjectFormController extends Controller
{
  
    public function create($id)
    {
		$subject = Subject::find($id);
		 $postFields = 	PostForm::where('subject_id',$id)->get();
		 
         return Inertia::render('front/sub_forum/subjectform/create',[
			 'id'=>$id,
			 'postFields'=>$postFields,
			 'subject'=>$subject ,
		  ]);
    }

     
    public function store(Request $request,$id)
    { 
        $data = $request->all(); 
			
		$postFields = 	PostForm::where('subject_id',$id)->delete();
		 //dd($data['formfields']);
			 
			 $formItems = $data['formfields'];
			 
			 foreach($formItems as $formItem){
				 
				 $formItem['subject_id']=$id;
				 $formItem['field_options']=array_values($formItem['field_options']);
				 
				 PostForm::create($formItem);
				  
			 }
			 
        return to_route('category.index');
    }

    
 
}
