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
		  service:Object, 
	 },setup(props){
	 const form = reactive({
				service_id:props.service.id,  
				description:"",  
			})
			return { form }
	 }, methods:{
	 showRequestModal(){
		 this.showReq=true;
	 },
	  makerequest(){
		    router.post('/makerequest', this.form)
	  }
	,closeModal(){
		this.showReq=false;
	}
	,
	
	 showPopup(i){
					this.current_image_index=i;
					this.current_image= this.service.service_images[i].image_path;
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




  <DialogModal :show="showReq" @close="closeModal">
            <template #title>
                Make A Request For Service
            </template>

            <template #content>
						<textarea v-model="form.description" class="form-control" name="reqdesc"></textarea>
            </template>

            <template #footer>
             <a @click="makerequest()" class="btn btn-primary" href="javascript::void(0)">Submit</a>
             <a @click="closeModal()" class="btn btn-danger" href="javascript::void(0)">close</a>
            </template>
        </DialogModal>






    <div class="card-deck whContAll">
	
		<div class="col-md-12">
			<h2>{{ service.title }}</h2>
			<h4>
				<template v-if="service.category.parent_category">{{ service.category.parent_category.title }} /</template>
				{{ service.category.title }} 
			</h4>
							
	</div>
      <div class="row">
			 <div class="col-md-8">
								
			 
								 <div class="imgContainer">
										<img :src="service.image_path_show" /> 
								 </div>
								<div class="txtContainer">
								<p>{{ service.description }}</p>
								</div>
								<div class="row">
										<div class="imgHeader col-md-12">
											<h2>
												Gallery
											</h2>
										</div>
									<div v-for="(serImg, indexImg) in service.service_images" class="col-md-4">
										<div class="imgCont" 	@click="showPopup(indexImg)">
											<img   :src="serImg.image_path" />
										</div>
									</div>
								</div>
							  

							 
						</div>
						
						<div class="col-md-4">
								
						<template v-if="user&&user.id!= service.user.id">	
						<a @click="showRequestModal" class="btn btn-danger" href="javascript::void(0);">Make Request</a>
						</template>
							<p>Rateing : 4.5/5</p>
							<p>price Begin from : {{ service.price_from }} $</p>
							<p>Deliver Date : 4 days</p>
						
						<div class="userProfile">
						 
					<div class="row">	
						<div class="col-md-3">
							<img :src="service.user.image_path_show" style="width:150px;height:150px;" />
						</div>
						<div class="col-md-9">
							<p>{{ service.user.full_name }}</p>
							<p>Web Developer</p>
							
						<template v-if="user&&user.id!= service.user.id">	
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
						</div>
						
						 
				 </div>
				 
				 
	  	 </div>
		 
		 
</div>
	  
	  

	</div>
  </AppLayout>
</template>

 