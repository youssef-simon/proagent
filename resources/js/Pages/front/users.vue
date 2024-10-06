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
      <div class="container">
			<div   v-for="userItm in users.data" class="proItem row">
						<div class="col-md-2">
							<a :href="'/user_details/'+userItm.id">
							 <img style="width:150px;height:150px;"  :src="userItm.image_path_show" />  
							 </a>
						 </div>
						 <div class="col-md-10">
						  <h4>{{ userItm.full_name }}</h4>  
						  <h6>Electronic Engineer</h6>
						   </div>
					 </div>
			</div>
	  </div>
	  
	  
	  
	  
	  
	  
	  

	</div>
  </AppLayout>
</template>

 