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
		    userlink:Object, 
		   
		  errors:Object
	 },setup(props){ 
		     const form = reactive({ 
			    status:  props.userlink.status , 
				userlink_id:  props.userlink.id ,
				reason:  props.userlink.reason , 
			 })
			
			return { form }
	 },  methods:{
			  submit() {
				       router.post('/admin/userlink/change_status', this.form)
			  }
			  
			   
	 },created(){
		 	  
	 }
}
</script>

<template>
<AppLayout title="Dashboard">
  




    <div class="card-deck whContAll workView">
	
		<div class="col-md-12">
			<h1>{{ userlink.title }}</h1>
			 
							
	</div>
      <div class="row">
			 <div class="col-md-12">
							   
								<div class="txtContainer">
									<p>description : {{ userlink.description }}</p>
									<p>link : {{ userlink.link }}</p>
									<p>title : {{ userlink.title }}</p>
									
								</div>
							  
						</div>
						  <div class="col-md-12">
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
	  </div>
	  
	  
	  
	  
	  
	  
	  


	</AppLayout>
</template>

 