<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User; 
use App\Models\LearningSession; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\StudyStagesSubject; 
use App\Models\Lesson; 
use App\Models\Subject; 
use App\Models\Exam; 
use App\Models\Part; 
use App\Models\AvailableSlot; 
use App\Models\MediaImage;  
use App\Models\FileUpload; 
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class FileUploadController   extends Controller
{
     
 
 
 
 
 
 	public function uploadfile(Request $request){
		
	 	$reqAll=$request->all();
		 
		$path=$request->get('file');
		$path =$reqAll['file'];
		
		
		$fileName=  $path->getClientOriginalName();
		      if($path!=''){

                 $image = $path->store('public/msgfiles');
				 
				return response()->json([
					'file_name' =>   $fileName , 
					'path' =>   $image , 
					'pathshow' =>   Storage::url($image), 
					]);
                }else{
                    return 0;
                }
	}
	
	
	
	
	  
 
 
 
 
}