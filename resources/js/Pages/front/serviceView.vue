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






    <div class="card-deck mb-3">
	
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
									<div v-for="serImg in service.service_images" class="col-md-12">
									 
										<img :src="serImg.image_path" />
									
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
	  
	  
	  
	  
	  
	  
	  

	</div>
  </AppLayout>
</template>

 