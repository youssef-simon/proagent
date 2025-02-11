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
						   show_msg_err:false, 
						   form:{
								  pathshow:'',
								  path:''
							  }
						 
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
					if(this.message=="" || this.message==null){
						this.show_msg_err=true;
						return;
					}
							var id =  this.serviceRequest.id;  
							var msgJson = {
								"message":this.message 
								, "request_id" : id
								, "file_path" : this.form.path
								, "file_name" : this.form.file_name
							};
					
					var self=this;
					 
					
						 axios.post("/post_room_message",msgJson)
								  .then( function(response) {
														self.fetchData();
															self.form.path="";
															self.form.file_name="";
															self.message="";
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
											  router.post('/changetodelivered', this.formaccept, {
															onProgress: () => (this.submit_form=true),
															  onError: () =>(this.submit_form=false),
						});
										}
										
												
		, uploadFile(event, index) {
                var self = this;
                // this.form.refields[index].img="Ddd";

                const URL = '/api/uploadfile';

                let data = new FormData();
                data.append('name', 'my-picture');
                data.append('file', event.target.files[0]);

                let config = {
                    header: {
                        'Content-Type': 'multipart/form-data'
                    }
                };

                axios.post(URL,data,config).then(function (response) { 
								 //let result = response.data.path.replace("public", "storage");
								self.form.file_name =  response.data.file_name;
								self.form.pathshow =  response.data.pathshow;
								self.form.path =  response.data.path; 
								return true; 
					}
                )
            }, 	   
	
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
    <div class="widthFull whContAll">
    <div class="container">
	
		<div class="col-md-12">
			<h2>Services Request</h2>
	</div>
      <div class="row">
			 <div class="serItm col-md-12">
							 
							 <h4>Request : {{ serviceRequest.description }}</h4>
							 <h4>request_at : {{ serviceRequest.created_at }}</h4>
						</div>
						
						<div class="col-md-6">
							<div class="row">
							
							<div class="col-md-3">
								<img style="width:160px;height:160px;" :src="serviceRequest.user_request.image_path_show" />
							 </div>
							 <div class="col-md-9">
							<h4>Service Requester</h4>
							{{ serviceRequest.user_request.full_name }}
							
							</div>
							</div>
						</div>
						
						
						
						<div class="col-md-6">
							<div class="row">
							<div class="col-md-3">
								<img style="width:160px;height:160px;" :src="serviceRequest.user_make.image_path_show" />
							</div>
							<div class="col-md-9">
							<h4>Seller</h4>
							<p>{{ serviceRequest.user_make.full_name }}</p>
							 
							
							</div>
							</div>
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
																	<div class="row">
																			<div class="col-md-2">
																				<img :src="item.sender.image_path_show" style="width:150px;height:200px;">
																				</div>
																				<div class="col-md-10">
																				<p>From : {{  item.sender.full_name }}</p>
																					<p>created at : {{  item.created_at }}</p>
																					<div class="message">  {{ item.message }}</div>
																					<div v-if="item.file_path" class="file"> <a :href="item.file_path_show">{{ item.file_name }}</a></div>
																					
																					</div> 
																	</div> 
																	 
																 </div>
										
											</div>	
										
										
										
										
										
										
										
										
										
										
								  </div>
	 
	 
 
 
 
 
 
						<div class="mb-3 message-container">
														<label for="firstName" class="form-label">Message</label>
														<textarea v-model="message" class="form-control"></textarea>
														<p v-if="show_msg_err" class="error_val">
														the message is required
														</p>
														<button class="btn btn-primary" @click="postMessage()" >send</button>
														
														
															 <div class="repeater col-md-12 p15">
																<h3>File Upload</h3> 
																<div class="row">
																	<div class="col-md-4" >
																		<div class="control-group w-100">
																			 
																			<input type="file" accept="image/*" @change="uploadFile($event,index)" id="file-input">
																		 
																			<a :href="form.pathshow">{{ form.path }}</a>
																		</div>
																	</div>
																</div>  
															</div>
						</div>
										
 
 
 
 
 
 
 
 
	</div>
	</div>
 
  </AppLayout>
</template>

 