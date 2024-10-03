<script>
import AppLayout from '@/Layouts/AppFrontLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

export default{
	components:{
		AppLayout,reactive,router
	 }
	   ,
	   data() {
					return {
						submit_form:false   
				   
					}
		  } 
	  
	 ,props:{ 
		  user:Object, 
		  services:Object, 
	 },setup(){
		 
	 }, methods:{
	 
	  
	
	 }
}
</script>

<template>
<AppLayout title="Dashboard">
<div>
    <div class="card-deck">
	
		<div class="col-md-12">
			<h3>Users</h3>
	</div>
     
	 
	 
	 
	 <img :src="user.image_path_show" style="width:300px;height:350px;" />  
		<h3>{{ user.full_name	 }}</h3>  
		<div class="col-md-12">
		<p>{{ user.biograph	 }}</p>  
		<p><a :href="'/message_thread/'+user.id">Send Message</a></p>  
	 </div>
	 <br>
	 <br>
	 <br>
	 <br>
	 
	 
	 
	 
	 
	 
	 
	 <h2>My Services</h2>
	      <div class="row">
		  
			<div   v-for="serviceItm in services" class="col-md-4">
			
						 <div class="serItm">
								 <div class="imgContainer">
								 
									<a :href="'/service_view/'+serviceItm.id">
											<img :src="serviceItm.image_path_show" /> 
									 </a>
								 </div>
								<h3>{{ serviceItm.title }}</h3> 
								<h3>{{ serviceItm.price_from }} $</h3>
							
						</div>
			</div>
	  </div>
	 
	 
	 
	 
	 
	 
	  </div>
	  
	  
	  
	  
	  
	  
	  

	</div>
  </AppLayout>
</template>

 