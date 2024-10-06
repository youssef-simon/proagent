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
						async fetchData() { 
						
						var self=this;
						 
						   
							axios.get("/message_threads_list")
								  .then( function(response) { 
												self.left_messages=response.data.data;
												//console.log(response.data);
												
												 // var scrollableDiv = document.getElementById("messageCont");
												   
													//scrollableDiv.scrollTop = scrollableDiv.scrollHeight;
											}
										)
								  .catch(error => {
									console.error(error);
								  });
						
								 
								
																 
						}   ,
			 
 	
		  } 
		  
		  
		   , created () {
					
					 
						this.fetchData( ); 
						 
		},
			mounted () {
			  
		} 
							
  }
  
</script> 


<template>

<AppLayout title="Dashboard">
   <div class="container">
			 
				  <div class="containerx">
				  <div class="row">
				  
				  <div class="col-md-12">
							<div  v-for="(item, indexe) in left_messages" class="item leftItm"  >
								<p>
									  <b>From : {{  item.sender.email }}</b>
																<br>
															<b>created at : {{  item.created_at }}</b>
								</p>
										<h5> {{ item.message }}</h5> 
										
									 	<a class="btn btn-danger" :href="'/message_thread/'+item.sec_user_id">Send Message</a>
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