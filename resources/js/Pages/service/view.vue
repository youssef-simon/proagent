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
		    service:Object, 
		   
		  errors:Object
	 },setup(props){ 
		     const form = reactive({ 
			    status:  props.service.status , 
			    reason:  props.service.reason , 
				service_id:  props.service.id ,
			
			 })
			
			return { form }
	 }, methods:{
			  submit() {
				     router.post('/admin/change_status', this.form)
			  }
			  
			  
			     
          
		
	 },created(){
		 	  
	 }
}
</script>

<template>
<AppLayout title="Dashboard">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit service</h1>
          </div>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>
	
	
      <section class="content">
	
		 
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
           
		   	<div class="col-md-12">
			<h2>{{ service.title }}</h2>
			<h4>
				<template v-if="service.category.parent_category">{{ service.category.parent_category.title }} /</template>
				{{ service.category.title }} 
			</h4>
							
	</div>
		   
		   
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
							  
							  
							  <div>
							  	 <form @submit.prevent="submit">
							  
							  
							  
							  
							  
							  
							  
										<div class="form-group">
													<label for="reason">reason</label>
														 <textarea class="form-control"  v-model="form.reason"></textarea>
											 </div>
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
          <!-- /.card -->
        </div>
       </div>
      
 
    </section> </AppLayout>
</template>

 