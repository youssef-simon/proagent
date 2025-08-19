<?php

namespace App\Http\Controllers\Forum\API;

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
use Intervention\Image\Facades\Image;

class ImageUploadController extends Controller
{
     
 
 
 
 
 
 	public function uploadimg(Request $request){
		
	 	$reqAll=$request->all();
	 
		$path=$request->get('file');
		$path =$reqAll['file'];
 
		      if($path!=''){
 
                 $image = $path->store('public/media'); 
				 
				 
				$filename = basename($image);
				 
				/*$resizedFilename = 'resized_' . $filename;
			  
				$resizedImage = Image::make($path->getRealPath())
        ->fit(250, 250 )
 ->save(storage_path('app/public/media/' . $resizedFilename)); */
										 
				 
				 
				 
				 
				 
				return response()->json([
					'original_name' => $path->getClientOriginalName(),
					'path' =>   $image , 
					'pathshow' =>   Storage::url($image), 
					]);
                }else{
                    return 0;
                }
	}
	
	
	
	
	
	 	public function uploadFile(Request $request){
		
	 	$reqAll=$request->all();
		
		$path=$request->get('file');
		$path =$reqAll['file'];
		
		      if($path!=''){

                $image = $path->store('public/files');
                $templateImage = new  FileUpload();
				
				
$newpath = str_replace('public', 'storage', $image);

                $templateImage->path=$newpath;
                $templateImage->name=$path->getClientOriginalName();
                $templateImage->extension=$path->getClientOriginalExtension();

                $data = $templateImage->save();
                
				
				return response()->json([
					'path' => $templateImage->path,
					'file_id' => $templateImage->id 
					]);
                }else{
                    return 0;
                }
	}
	
	
	
	
	
	
	
	
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
}