<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

export default{
	components:{
		AppLayout,reactive,router
	 }  ,
	   data() {
					return {
						submit_form:false   
				   
					}
		  } 
	 ,props:{
		    userproject:Object, 
		   
		  errors:Object
	 },setup(props){ 
		     const form = reactive({ 
			    status:  props.userproject.title , 
				userproject_id:  props.userproject.id ,
			
			 })
			
			return { form }
	 },  methods:{
			  submit() {
				       router.post('/admin/userproject/change_status', this.form)
			  }
			  
			   
	 },created(){
		 	  
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
								<div class="txtContainer">
								<p>{{ userproject.description }}</p>
								
								</div>
								<div class="row">
									<div v-for="serImg in userproject.project_images" class="col-md-12">
									 
										<img :src="serImg.image_path" />
									
									</div>
								</div>
							  

							 
						</div>
						  <div class="col-md-12">
							  	 <form @submit.prevent="submit">
							  
											<div class="form-group">
													<label for="category_id">Status</label>
														<select class="form-control" v-model="form.status">
															 <option value="1">Under Investigation</option> 
															 <option value="2" > Approved </option> 
															 <option value="3" > declined</option> 
														</select>
											 </div>
											 
										<div class="form-group">	 
												<button class="btn btn-primary">Update Status</button>
										 </div>		
											 
							  </form>
							  
							  </div>
					 
						
	  </div>
	  </div>
	  
	  
	  
	  
	  
	  
	  


	</AppLayout>
</template>

 