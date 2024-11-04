<script> 
import AppLayout from '@/Layouts/AppFrontLayout.vue';
import axios from 'axios'; 
import { usePage } from '@inertiajs/vue3';
import SideMenu from '@/Pages/front/Comp/SideMenu.vue';

 export default {
	 components:{
		AppLayout ,SideMenu
	 },
  data() {
    return { 
		raw_messages:[], 
		next_pause:true, 
		messages:[], 
		left_messages:[], 
		next_link:'', 
		message_send:'', 
		thread_id:'', 
		   user: usePage().props.auth.user, 
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
    
				  
	<div class="whContAll">
		<div class="row">
		<div class="col-md-3">
			<SideMenu />
		</div>  
		<div class="col-md-9">
 
    <div class="card">
	
	  <div class="card-header">
                
              </div>
			  
			   
	  <div class="col-md-12">
							<div  v-for="(item, indexe) in left_messages" class="item leftItm"  >
							
							
							
							
							
							
							
							
							
							
									<div class="row">
									
									<div class="col-md-2">
																			<img :src="item.sender.image_path_show" style="width:150px;height:200px;">
											 	</div>
											<div class="col-md-10">							
													<p>
													<template v-if="item.sender">
														  <b>From : {{  item.sender.full_name }}</b>
													</template>	  
																					<br>
																				<b>created at : {{  item.created_at }}</b>
													</p>
															<h5> {{ item.message }}</h5> 
															
															
															<a  v-if="user.id!=item.sec_user_id" class="btn btn-danger" :href="'/message_thread/'+item.sec_user_id">Send Message</a>
															<a  v-if="user.id!=item.user_id" class="btn btn-danger" :href="'/message_thread/'+item.user_id">Send Message</a>
												</div>
									</div>
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




