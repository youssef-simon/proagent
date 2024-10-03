<script> 
import AppLayout from '@/Layouts/AppFrontLayout.vue';
import axios from 'axios'; 

 export default {
	 
  data() {
    return { 
		raw_messages:[], 
		next_pause:true, 
		messages:[], 
		left_messages:[], 
		next_link:'', 
		message_send:'', 
		thread_id:'', 
		 
		  message_reciver:null , 
    }
  } 

   ,props:{ 
		  rec_id:String,  
	 }
	, methods: { 
						async fetchData(id) { 
						
						var self=this;
						 
						  
						axios.get("/message_thread_view/"+id)
								  .then( function(response) {
												  self.raw_messages=[];
												 //self.raw_messages = response.data.data.data;  
												  self.raw_messages.push(...response.data.data.data); 
												// console.log( self.raw_messages);
												var tempMessage= self.raw_messages;
												 self.messages = tempMessage;  
												 self.next_link =  response.data.data.next_page_url;  
												 self.thread_id = response.data.thread_id;
												 self.message_reciver = response.data.message_reciver;
												 self.user_id = response.data.user_id;
												  
												  
												  
												  var scrollableDiv = document.getElementById("messageCont");
												   
													scrollableDiv.scrollTop = scrollableDiv.scrollHeight;
											}
										)
								  .catch(error => {
									console.error(error);
								  });
						
						
						
						
						
							axios.get("/message_threads_list")
								  .then( function(response) { 
												self.left_messages=response.data.data;
												console.log(response.data);
												
												  var scrollableDiv = document.getElementById("messageCont");
												   
													scrollableDiv.scrollTop = scrollableDiv.scrollHeight;
											}
										)
								  .catch(error => {
									console.error(error);
								  });
						
								 
								
																 
						}   ,
						async postComment() { 
							 
									var msgJson= {"receiver_id":this.rec_id, "message":this.message_send , "thread_id" : this.thread_id};
									 
									 var self=  this;
						 const doctorslist = await axios.post("/post_message",msgJson).then((dd) => {
													self.fetchData(self.rec_id); 
													self.message_send="";
						});
					 
					},async removeMsg(id){
						var msgJson= {"message_id":id };
									 
								var self=  this;
						 const doctorslist = await axios.post("/remove_message",msgJson).then((dd) => {
												 
													self.message_send="";
						});
					} , handleScroll (event) {
									
									
									var myDiv = document.getElementById("messageCont");
									var scrollTop = myDiv.scrollTop;
								//	console.log("Scroll top of the div:", scrollTop);
								 
								 
								 	const config=this.user.headerconfig;
						  console.log(config);
								 
								 const self=this;
								 
								
									if(scrollTop==0){
										console.log(this.next_link);
										if(this.next_pause==true){
											if(this.next_link!=null){
												this.next_pause=false;
												axios.get(this.next_link,config)
													  .then( function(response) {
														  
																	self.next_pause=true;
																	
																  self.raw_messages.push(...response.data.data.data);  
																	var tempMessage= self.raw_messages;
																	
																	 console.log( 'self.raw_messages');
																	 console.log( self.raw_messages);
																	 console.log( 'self.raw_messages');
																	 self.messages = tempMessage;  
																	 self.next_link = response.data.data.next_page_url;  
																	 
																	  
																}
															)
													  .catch(error => {
														console.error(error);
													  });
													  }
												  }
										
									}
									},
									
									scrollToBottom() {
																  var scrollableDiv = document.getElementById("messageCont");
													scrollableDiv.scrollTop = scrollableDiv.scrollHeight;
													
												}
 	
		  } 
		  
		  
		   , created () {
					
					window.addEventListener("load", this.scrollToBottom);
					 var id=  this.rec_id;
						this.fetchData(id); 
						 
		},
			mounted () {
			 
			   window.onload = this.scrollToBottom();
		 
		} 
							
  }
  
</script> 


<template>

<AppLayout title="Dashboard">
   <div class="container">
			 
				  <div class="containerx">
				  <div class="row">
				  
				  <div class="col-md-4">
							<div  v-for="(item, indexe) in left_messages" class="item leftItm"  >
								<p>
									  <b>From : {{  item.sender.email }}</b>
																<br>
															<b>created at : {{  item.created_at }}</b>
								</p>
										<h5> {{ item.message }}</h5> 
										
										<a v-if="user_id!=item.user_id" class="btn btn-danger" :href="'/message_thread/'+item.user_id">Send Message</a>
										<a v-if="user_id!=item.sec_user_id" class="btn btn-danger" :href="'/message_thread/'+item.sec_user_id">Send Message</a>
							</div>
				  </div>
								  <div class="col-md-8 serviceCont">
													<h1>Messages Threads</h1>
													
													
													
												<div id="messageCont" class="messageContainer">	
													<div  v-for="(item, indexe) in messages.slice().reverse()" class="item" :key="indexe">
															 <b>From : {{  item.sender.email }}</b>
																<br>
															<b>created at : {{  item.created_at }}</b>
															
															
															
															<br> 
															
															<div class="message"> {{ item.id }} {{ item.message }}</div>
															<div v-if="item.sender_type=='App\\Models\\Admin'">
																	<h4><i class="fa fa-modx"></i>Admin</h4>
															</div>
													<div v-if="item.sender_type=='App\\Models\\User'">
														<div v-if="item.sender.id==user_id">
																
																<a @click="removeMsg(item.id)" class="btn btn-primary commentBtm" href="javascript:void(0)">REMOVE</a>
														</div>		
													</div>		
														
														
													</div>
													
													<div class="mb-3 message-container">
														<label for="firstName" class="form-label">Message</label>
														<textarea v-model="message_send" class="form-control"></textarea>
														<button @click="postComment()" >send</button>
													</div>
										
									</div>	
										
										
										
								  </div>
								 
				  </div>
				  </div>
				  </div>
   </AppLayout>
</template>
<style> 
 .serviceCont .row img{
	width:100%;
 } 
   .serviceCont{
    margin-top: 30px;
   }
   .item p span { font-weight:bold; }
</style>