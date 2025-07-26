<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

 use App\Http\Controllers\Forum\CategoriesController; 
 use App\Http\Controllers\Forum\SubjectController; 
 use App\Http\Controllers\Forum\SettingController; 
 use App\Http\Controllers\Forum\UserController; 
 use App\Http\Controllers\Forum\ForumController; 
 use App\Http\Controllers\Forum\PostController; 
 use App\Http\Controllers\Forum\CommentController;   
 use App\Http\Controllers\Forum\ReplyController;  
 
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
	
 
	  
		 	
	Route::post('/uploadimg', [\App\Http\Controllers\API\ImageUploadController::class, 'uploadimg']); 
	Route::post('/uploadfile', [\App\Http\Controllers\API\FileUploadController::class, 'uploadfile']); 
	 
 
		 
		 
		  
	});
	
	 
 