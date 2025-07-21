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
						
							  total_images:0,
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
				 
				 
				 
				 prevImg(){
					this.current_image_index=this.current_image_index-1;
					this.current_image=  this.service.service_images[this.current_image_index].image_path;
				},
				nextImg(){
					this.current_image_index=this.current_image_index+1;
						this.current_image=  this.service.service_images[this.current_image_index].image_path
				},
				 
				 
				 
				 
				 
	 },created(){
		  this.total_images=this.service.service_images.length-1;
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






    <div class="widthFull whContAll servicePage">
	
		<div class="col-md-12">
			<h2>{{ service.title }}</h2>
			<h6>
				<template v-if="service.category.parent_category">{{ service.category.parent_category.title }} /</template>
				{{ service.category.title }} 
			</h6>
							
	</div>
      <div class="row">
			 <div class="col-md-12">
								
			 
								 <div class="imgContainer">
										<img :src="service.image_path_show" /> 
								 </div>
								<div class="txtContainer txtContainerEditor" v-html="service.description">
								 
								</div>
								<div class="row">
										<div class="imgHeader col-md-12">
											<h2>
												Gallery
											</h2>
										</div>
									<div v-for="(serImg, indexImg) in service.service_images" class="col-md-4">
										<div class="imgCont" 	@click="showPopup(indexImg)">
											<img   :src="serImg.resize_image_path" />
										</div>
									</div>
								</div>
							  

							 
						</div>
						
					<div class="col-md-12">
								
								 <div class="userProfile">
										 
									<div class="row">	
										<div class="col-md-3">
											<a :href="'/user_details/'+service.user.id">
											<img :src="service.user.image_path_show" style="width:250px;height:250px;" />
											</a>
										</div>
										<div class="col-md-9">
											<h3>
												<a :href="'/user_details/'+service.user.id">
											{{ service.user.full_name }}
											
												</a>
											</h3>
											<p>{{ service.user.work_title }}</p>
											<p>{{ service.user.small_bio }}</p>
											
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
							
							<div @click="hidePopup()" class="absFullBox"></div>
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
						
						<div class="w-lightbox-control w-lightbox-left"  @click="prevImg()" role="button" v-show="current_image_index!=0" aria-hidden="true" aria-controls="w-lightbox-view" aria-label="previous image" tabindex="-1"></div>
						<div class="w-lightbox-control w-lightbox-right" @click="nextImg()" role="button" v-show="current_image_index!=total_images" aria-hidden="false" aria-controls="w-lightbox-view" aria-label="next image" tabindex="0"></div>
						
				 </div>
				 <div @click="hidePopup()" class="absFullBox"></div>
					<div class="w-lightbox-strip" role="tablist"> 
						<div class="w-lightbox-item"  v-for="(imgItm, indexImg)  in service.service_images" tabindex="0" aria-controls="w-lightbox-view" role="tab"   aria-selected="true">
									<div class="w-lightbox-thumbnail" @click="showPopup(indexImg)">
										<img class="w-lightbox-img w-lightbox-wide w-lightbox-thumbnail-image" :src="imgItm.image_path">
									</div>
						</div> 
					</div>
	  	 </div>
		 
		 
</div>

	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  

	</div>
  </AppLayout>
</template>

 