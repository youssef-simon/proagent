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
     
	 
	 	<h3>{{ user.full_name	 }}</h3>  
	 
	 <img :src="user.image_path_show" style="width:300px;height:350px;" />  
		<h3>{{ user.full_name	 }}</h3>  
	
	 
	 <br>
	 <br>
	 <br>
	 <br>
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	  </div>
	  
	  
	  
	  
	  
	  
	  

	</div>
  </AppLayout>
</template>

 