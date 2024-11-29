<script>
import AppLayout from '@/Layouts/AppFrontLayout.vue'; 
import DialogModal from '@/Components/DialogModal.vue';

import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import { usePage } from '@inertiajs/vue3';

export default{
	components:{
		AppLayout,reactive,router,DialogModal
	 }
	   ,
	   data() {
					return {
						submit_form:false,   
						showReq:false,   
						reqdesc:false,   
						user: usePage().props.auth.user, 
					}
		  } 
	  
	 ,props:{ 
		  userproject:Object, 
	 },setup(props){
 
	 }, methods:{
	 showRequestModal(){
		 this.showReq=true;
	 } 
	,closeModal(){
		this.showReq=false;
	}
	 }
}
</script>

<template>
<AppLayout title="Dashboard">




  





    <div class="card-deck whContAll">
	
		<div class="col-md-12">
			<h2>{{ userproject.title }}</h2>
			 
							
	</div>
      <div class="row">
			 <div class="col-md-8">
								
			 
								 <div class="imgContainer">
										<img :src="userproject.image_path_show" /> 
								 </div>
								<div class="txtContainer">
								<p>{{ userproject.description }}</p>
								
								</div>
								<div class="row">
									<div v-for="serImg in userproject.project_images" class="col-md-12">
									 
										<img :src="serImg.image_path" />
									
									</div>
								</div>
							  

							 
						</div>
						
						<div class="col-md-4">
								
						<template v-if="user&&user.id!= userproject.user.id">	
						<a @click="showRequestModal" class="btn btn-danger" href="javascript::void(0);">Make Request</a>
						</template>
							<p>Rateing : 4.5/5</p>
							<p>price Begin from : {{ userproject.price_from }} $</p>
							<p>Deliver Date : 4 days</p>
						
						<div class="userProfile">
						 
					<div class="row">	
						<div class="col-md-3">
							<img :src="userproject.user.image_path_show" style="width:150px;height:150px;" />
						</div>
						<div class="col-md-9">
							<p>{{ userproject.user.full_name }}</p>
							<p>Web Developer</p>
							
						<template v-if="user&&user.id!= userproject.user.id">	
							<p>
								<a class="btn btn-danger" :href="'/message_thread/'+service.user.id">
										<i class="fa fa-message"></i>Send Message
								</a>
							</p>
						</template>
						</div>
					</div>
						</div>
						
						</div>
						
	  </div>
	  
	  
	  
	  
	  
	  
	  

	</div>
  </AppLayout>
</template>

 