<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\LearningSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Lesson;
use App\Models\Subject;
use App\Models\Exam;
use App\Models\Part;
use App\Models\Question;
use App\Models\QuestionChoice;
use App\Models\AvailableSlot;
use App\Models\Doctor;
use App\Models\ReserveSlot;
use App\Models\StudyStageSubject;
use App\Models\Message;
use App\Models\Admin;
use App\Models\ThreadMessage;
use Inertia\Inertia;

class MessageController extends Controller {

 
       public function my_messages(Request $request) {
			$customer =     \Auth::guard('web')->user();
			$customer_id = $customer->id;
			$threads = ThreadMessage::with('sender')-> where('user_id', $customer_id)->orWhere('sec_user_id',$customer_id)->orderBy('last_updated','desc')->get();
					//	 dd($customer_id );
			Message::where('receiver_id',$customer->id)->update(['is_readed'=>1]);			
						
        return Inertia::render('front/messages/MyMessages' ); 
    }
	
    
      public function message_threads_list(Request $request) {
			$customer =     \Auth::guard('web')->user();
			$customer_id = $customer->id;
			$threads = ThreadMessage::with('sender')-> where('user_id', $customer_id)->orWhere('sec_user_id',$customer_id)->orderBy('last_updated','desc')->get();
						
        return response()->json([
                    'data' => $threads,
        ]);
    }
	
	
	 public function message_thread (Request $request, $rec_id) {
		 
		 
		 
		 return Inertia::render('front/messages/MessageThreadsView',[
						"rec_id"=>$rec_id , 
					]); 
		 
	 }
	

    public function message_thread_view(Request $request, $id) {
        $customer =  \Auth::guard('web')->user();
        $customer_id = $customer->id;

			$messageReciver=User::find($id);

        $messages = Message:: where(function ($query) use ($id, $customer_id) {
                            $query->where('receiver_id', $id)
                            ->where('sender_id', $customer_id);
                        })
                        ->orWhere(function ($query) use ($id, $customer_id) {
                            $query->where('receiver_id', $customer_id)
                            ->where('sender_id', $id);
                        })->orderBy('id', 'desc')
                        ->with('sender');

       // $thread = ThreadMessage::where('sec_user_id', $id)->where('user_id', $customer_id)->first();
		
		
		
	  $thread = ThreadMessage::where(function ($query) use ($id, $customer_id) {
										$query->where('sec_user_id', $id) ->where('user_id', $customer_id);
                        }) ->orWhere(function ($query) use ($id, $customer_id) {
										$query->where('user_id', $id)  ->where('sec_user_id',$customer_id );
                        })->first();
		
		
		
        if ($thread == null) {

            $data['user_id'] = $customer_id;
            $data['sec_user_id'] = $id;
			 
          //  $data['message'] = $request->get('message');
			
			//$now = new DateTime();
 

            //$data['last_updated'] =$now->getTimestamp();

            $thread = ThreadMessage::create($data);
            $thread_id = $thread->id;
        } else {


            $thread_id = $thread->id;
        }


        return response()->json([
                    'user_id' => $customer_id,
                    'data' => $messages->paginate(10),
                    'thread_id' => $thread_id,
                    'message_reciver' =>  $messageReciver,
        ]);
    }
    
    
    

    public function remove_message(Request $request) {
		
		$message_id = $request->get('message_id');
	    Message::where('id',$message_id)->delete(); 
		
		return response()->json([
			'data' => 'done',  
		]);

    }
	
	    public function post_message(Request $request) {

				$customer =  \Auth::guard('web')->user(); 
				$userId = $customer->id;

				$data = $request->all();
				$data['sender_id'] = $userId;
				$data['sender_type'] = "App\Models\User";
				$data['receiver_id'] = $data['receiver_id'];
				$data['receiver_type'] = "App\Models\User";
				 
			    $now = new \DateTime();
				  /* return response()->json([
							'data' => $now->getTimestamp(),
				]); */
    
				$threadMessage = ThreadMessage::where('id',$data['thread_id'] )->first(); 
				$threadMessage->message = $data['message']; 
				$threadMessage->last_sender_id = $userId ; 
				$threadMessage->last_updated = $now;  
				$threadMessage->save();
				
			 
				$messages = Message::create($data);
				return response()->json([
							'data' => $messages,
				]);
    }
	
	
	
	
	
	
	
	
	
	
	    public function post_reply(Request $request) {

        $customer =  \Auth::guard('web')->user(); 
        $userId = $customer->id;

        $data = $request->all();
        $data['sender_id'] = $userId;
        $data['sender_type'] = "App\Models\User";
        $data['receiver_id'] = $data['receiver_id'];
        $data['receiver_type'] = "App\Models\Admin";

        $messages = Message::create($data);
        return response()->json([
                    'data' => $messages,
        ]);
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	   public function get_messages(Request $request) {
		
		          $customer_id = auth()->user()->id;
        $maxIds = DB::table('messages')
                        ->select(DB::raw('MAX(id) as max_id'))
                        ->groupBy('thread_id')
                        ->pluck('max_id')->toArray();

        $messages = Message:: whereIn('id', $maxIds)->where(function ($query) use ( $customer_id, $maxIds) {
                            $query->where('sender_type', 'App\Models\Admin')
                            ->where('sender_id', $customer_id)
                            ->whereIn('id', $maxIds);
                        })
                        ->orWhere(function ($query) use ($customer_id, $maxIds) {
                            $query->where('receiver_id', $customer_id)
                            ->where('receiver_type', 'App\Models\Admin')
							 ->whereIn('id', $maxIds);
                        })->with('sender')->  orderBy('id','desc')->get();
						 
        return Inertia::render('messages/inbox_message', [
                    'messages' => $messages,
        ]);
    }











   public function message_thread_viewsss(Request $request, $id) {

 
        $customer_id = auth()->user()->id;
    
        $messages = Message:: where('thread_id',$id)->orderBy('id', 'asc')->with('sender');

        $thread = ThreadMessage::where('id',$id)->first();
		 
	   
		$receiver_id = $thread->user_id;
        return response()->json([
                    'data' => $messages->paginate(5),
                    'thread_id' =>   $thread->id ,
                    'receiver_id' => $receiver_id,
        ]);
    }
	
	
	
	
	
	
	
	
	
	
	
	
	

}
