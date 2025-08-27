<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

 use App\Http\Controllers\Forum\CategoryController; 
 use App\Http\Controllers\Forum\SubjectController; 
 use App\Http\Controllers\Forum\SettingController; 
 use App\Http\Controllers\Forum\UserController; 
 use App\Http\Controllers\Forum\ForumController; 
 use App\Http\Controllers\Forum\PostController; 
 use App\Http\Controllers\Forum\CommentController;   
 use App\Http\Controllers\Forum\ReplyController;  
 use App\Http\Controllers\Forum\SubjectFormController;  
 
/* Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');
 */
 

 Route::group(['middleware' => ['auth:web']], function () {
	 
		Route::get('/forums', [ForumController::class, 'index'])->name('home');
		Route::get('posts/{id}', [ForumController::class, 'index_posts'])->name('post.index');	
		Route::get('post_view/{id}', [ForumController::class, 'view'])->name('post.view');	
		 
		Route::get('post/create', [PostController::class, 'create'])->name('post.create');
		Route::post('post/store', [PostController::class, 'store'])->name('post.store');
		
		Route::get('post_inside/create/{id}', [PostController::class, 'create_inside'])->name('post_inside.create');
		Route::post('post_inside/store/{id}', [PostController::class, 'store_inside'])->name('post_inside.store');
		   
		  
		Route::get('post/index', [PostController::class, 'index'])->name('post.indexu');
		
		Route::get('my_posts', [PostController::class, 'myPosts'])->name('post.myposts');
		 
		Route::delete('post/delete/{id}', [PostController::class, 'destroy'])->name('post.delete');
		Route::get('post/edit/{id}', [PostController::class, 'edit'])->name('post.edit');		
		Route::post('post/update/{id}', [PostController::class, 'update'])->name('post.update');	
		
		Route::get('comment/create/{id}', [CommentController::class, 'create'])->name('post.create_comment');	
		Route::get('comment/edit/{id}', [CommentController::class, 'edit'])->name('post.edit_comment');	
		
		Route::delete('comment/destory/{id}', [CommentController::class, 'destory'])->name('post.destory_comment');	
		
		Route::post('comment/update/{id}', [CommentController::class, 'update'])->name('post.update_comment');	
	
	Route::post('comment/store', [CommentController::class, 'store'])->name('post.store_comment');	
		
		Route::get('reply/create/{id}', [ReplyController::class, 'create'])->name('create_reply');	
		Route::post('reply/store', [ReplyController::class, 'store'])->name('store_reply');	
	
 
	  
		 	
	Route::post('/uploadimgforum', [\App\Http\Controllers\Forum\API\ImageUploadController::class, 'uploadimg']); 
	Route::post('/uploadfileforum', [\App\Http\Controllers\Forum\API\FileUploadController::class, 'uploadfile']); 
	 
 
		 
		 
		  
	});
	
	 
 	    Route::group(['prefix'=>'admin','middleware' => ['auth:admin']], function () {
		//Route::get('/admin',[DashboardController::class,'show'])->name('admin.login-view');
   
		 	Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
		Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');
		Route::get('category/index', [CategoryController::class, 'index'])->name('category.index');
		Route::delete('category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
		Route::get('category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');		
		Route::post('category/update/{id}', [CategoryController::class, 'update'])->name('category.update');	
		 
		Route::get('subject/create', [SubjectController::class, 'create'])->name('subject.create');
		Route::post('subject/store', [SubjectController::class, 'store'])->name('subject.store');
		Route::get('subject/index', [SubjectController::class, 'index'])->name('subject.index');
		Route::delete('subject/delete/{id}', [SubjectController::class, 'destroy'])->name('subject.delete');
		Route::get('subject/edit/{id}', [SubjectController::class, 'edit'])->name('subject.edit');		
		Route::post('subject/update/{id}', [SubjectController::class, 'update'])->name('subject.update');	
			 
		 	  		
			Route::get('subject_form/create/{id}', [SubjectFormController::class, 'create'])->name('subject_form.create');
		Route::post('subject_form/store/{id}', [SubjectFormController::class, 'store'])->name('subject_form.store');
		  
		});