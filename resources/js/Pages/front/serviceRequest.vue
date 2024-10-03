<script>
import AppLayout from '@/Layouts/AppFrontLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import { usePage } from '@inertiajs/vue3';

export default{
	components:{
		AppLayout,reactive,router
	 }
	   ,
	   data() {
					return {
							submit_form:false,   
							raw_messages:[], 
							next_link:'',
							successform:false,
							isVisible:false,
							rooms:[],
							messages:[],
							message:"",
							room_id:0, 
							next_pause:true, 
						   user: usePage().props.auth.user, 
						 
						 
						 
					}
		  } 
	  
	 ,props:{ 
		  serviceRequest:Object, 
	 },setup(props){
			const form = reactive({
				service_id:props.serviceRequest.id,  
			});
			
			
			const formaccept = reactive({
				service_req_id:props.serviceRequest.id,  
			})
			return { form,formaccept }
	 }, methods:{
	 
	   async fetchData() {
					   
					  var id=  this.serviceRequest.id; 
					  
					  	var self=this;
					  	 axios.get("/chat_room/"+id)
								  .then( function(response) {
												 self.messages = response.data.data.data;	
												 console.log(self.messages);
												 self.raw_messages=[];
												 //self.raw_messages = response.data.data.data;  
												  self.raw_messages.push(...response.data.data.data); 
												// console.log( self.raw_messages);
												var tempMessage= self.raw_messages;
												 self.messages = tempMessage;  
												 self.next_link =  response.data.data.next_page_url;  
											   
											setTimeout(() => {
										/**************************************/
													var scrollableDiv = document.getElementById("messageCont");
												    scrollableDiv.scrollTop = scrollableDiv.scrollHeight;
													 console.log(scrollableDiv.scrollTop);
										/************************************/
												}, 1000);
													
	
												  
												 
											}
										)
								  .catch(error => {
									console.error(error);
								  });
					  
					   
					}  ,
				   
				  	async postMessage() { 
							var id =  this.serviceRequest.id;  
							var msgJson = { "message":this.message , "request_id" : id};
					
					var self=this;
					 
					
						 axios.post("/post_room_message",msgJson)
								  .then( function(response) {
														self.fetchData();									 
											}
										)
								  .catch(error => {
									console.error(error);
								  });
					} 
					, handleScroll (event) {
							
						
									 var myDiv = document.getElementById("messageCont");
									var scrollTop = myDiv.scrollTop;
								 	const config=this.user.headerconfig;
										 
										const self=this; 
											if(scrollTop==0){
											console.log('ffff');
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
									 scrollToBottom() { }
									  ,acceptProj(){		
											  router.post('/changetoinprogress', this.formaccept, {
															onProgress: () => (this.submit_form=true),
															  onError: () =>(this.submit_form=false),
												});
										},deliverProj(){
											  router.post('/add_service', this.form, {
															onProgress: () => (this.submit_form=true),
															  onError: () =>(this.submit_form=false),
						});
										}
	 },  mounted () {
			 var scrollableDiv = document.getElementById("messageCont");
			  scrollableDiv.addEventListener('scroll', this.handleScroll);
						    window.onload = this.scrollToBottom();
									 
				 } ,created(){
						this.fetchData();
				 }
}
</script>

<template>
<AppLayout title="Dashboard">
    <div class="card-deck mb-3">
	
		<div class="col-md-12">
			<h2>Services Request</h2>
	</div>
      <div class="row">
			 <div class="serItm">
							 
							 <h4>Request : {{ serviceRequest.description }}</h4>
							 <h4>request_at : {{ serviceRequest.created_at }}</h4>
						</div>
						
						<div class="col-md-12">
							<h4>Service Requester</h4>
							{{ serviceRequest.user_request.full_name }}
						 
							<img style="width:160px;height:160px;" :src="serviceRequest.user_request.image_path_show" />
						</div>
						
						
						
						<div class="col-md-12">
							<h4>Seller</h4>
							{{ serviceRequest.user_make.full_name }}
							 
							<img style="width:160px;height:160px;" :src="serviceRequest.user_make.image_path_show" />
							
						</div>
						
						
						<template v-if="serviceRequest.status_id==1">
							<div class="col-md-12 actionCont">
									<h5>Pending User Approve</h5>
									<p>Pending User Approve</p>
									
									<template v-if="serviceRequest.user_make_id==user.id">
										<a @click="acceptProj()" class="btn btn-primary" href="javascript::void(0)">Accept</a>
									</template>
							</div>	
						</template>
						
							<template v-if="serviceRequest.status_id==2">
							<div class="col-md-12 actionCont">
								<h5>In progress</h5>
								 
								<p>the proffesionak working on it</p>
								
								<template v-if="serviceRequest.user_req_id==user.id">
										<a @click="deliverProj()" class="btn btn-primary" href="javascript::void(0)">Deliver the project</a>
								</template>
							</div>	
						</template>
						
						
						<template v-if="serviceRequest.status_id==3">
						<div class="col-md-12 actionCont">
								<h5>Delivered</h5>
								<p>Delivered</p>
						</div>			
								 
						</template>
						
	  </div>
	  
	  
	  
	  
	  
	  
	  

	</div>
	
	
	
	
	
	
	
	
	
	
	
	<div class="container">
	 
	
	
		  <div class="col-md-12 serviceCont">
	 
										<div  v-for="(item, indexe) in rooms" class="item" :key="indexe">
												 
											</div>
										
										
										
										
										
										
											<div id="messageCont" class="messageContainer">	
										 
																	<div  v-for="(item, indexe) in messages.slice().reverse()" class="item" :key="indexe">
																			 
																				<br>
																			<b>created at : {{  item.created_at }}</b>
																			 <br>  
																			<div class="message"> {{ item.id }} {{ item.message }}</div>
																			<div v-if="item.sender_type=='App\\Models\\Admin'">
																					<h4><i class="fa fa-modx"></i>Admin</h4>
																			</div>
																	<div v-if="item.sender_type=='App\\Models\\User'">
																		 		
																	</div>		
																 </div>
										
											</div>	
										
										
										
										
										
										
										
										
										
										
								  </div>
	 
	 
 
 
 
 
 
						<div class="mb-3 message-container">
														<label for="firstName" class="form-label">Message</label>
														<textarea v-model="message" class="form-control"></textarea>
														<button @click="postMessage()" >send</button>
						</div>
										
 
 
 
 
 
 
 
 
	</div>
 
  </AppLayout>
</template>

 