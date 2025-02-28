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
						
						showSlider:false, 
					    current_image:'',
					    current_image_index:0,
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
	,
	
	 showPopup(i){
					this.current_image_index=i;
					this.current_image= this.userproject.project_images[i].image_path;
					 this.showSlider=true;
				 }, 
				 hidePopup(){
					 	 this.showSlider=false;
				 },
	 }
}
</script>

<template>
<AppLayout title="Dashboard">




  





    <div class="card-deck whContAll workView">
	
		<div class="col-md-12">
			<h1>{{ userproject.title }}</h1>
			 
							
	</div>
      <div class="row">
			 <div class="col-md-12">
								
			 
								 <div class="imgContainer">
										<img :src="userproject.image_path_show" /> 
								 </div>
								<div class="txtContainer txtContainerEditor">
								<p v-html=" userproject.description"></p>
								
								</div>
								
								
								
									<div class="row">
										<div class="imgHeader col-md-12">
											<h2>
												Gallery
											</h2>
										</div>
									<div v-for="(serImg, indexImg) in userproject.project_images" class="col-md-4">
										<div class="imgCont" 	@click="showPopup(indexImg)">
											<img   :src="serImg.image_path" />
										</div>
									</div>
								</div>
							  

							 
						</div>
						
						<div class="col-md-12">
								
					  
						
						<div class="userProfile">
						 
					<div class="row">	
						<div class="col-md-3">
							<a :href="'/user_details/'+userproject.user.id">
							<img :src="userproject.user.image_path_show" style="width:250px;height:250px;" />
							</a>
						</div>
						<div class="col-md-9">
							<h3>
								<a :href="'/user_details/'+userproject.user.id">
							{{ userproject.user.full_name }}
							
								</a>
							</h3>
							<p>{{ userproject.user.work_title }}</p>
							<p>{{ userproject.user.small_bio }}</p>
							
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
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  <div v-show="showSlider" class="fixedContainer">

			<!--<div class="fixedLayer"></div>-->
			<div class="w-lightbox-control w-lightbox-close" @click="hidePopup()" role="button" aria-label="close lightbox" tabindex="0"></div>
			<div class="w-lightbox-backdrop">
					
					<div class="w-lightbox-content w-lightbox-group">
						<div class="w-lightbox-view" tabindex="0" id="w-lightbox-view" style="opacity: 1;">
						
								
							<div class="w-lightbox-frame">
							<figure class="w-lightbox-figure">
									<img class="w-lightbox-img w-lightbox-image" :src="current_image">
							</figure>
							</div> 
							
							<div @click="hidePopup()" class="absFullBox"></div>
						</div>
						
						 
				 </div>
				 
				 
	  	 </div>
		 
		 
</div>
	  
	  
	  

	</div>
  </AppLayout>
</template>

 