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
		  users:Object, 
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
      <div class="row">
			<div   v-for="userItm in users.data" class="col-md-4">
						<a :href="'/user_details/'+userItm.id">
						 <img :src="userItm.image_path_show" />  
						 </a>
						  <h3>{{ userItm.full_name	 }}</h3>  
						  
							
						</div>
			</div>
	  </div>
	  
	  
	  
	  
	  
	  
	  

	</div>
  </AppLayout>
</template>

 