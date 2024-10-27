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
    <div class="card-deck whContAll userPage">
	
	
      <div class="container">
	  	<div class="header">
			<h3>Users</h3>
	</div>
			<div   v-for="userItm in users.data" class="proItem row">
						<div class="col-md-2">
							<a :href="'/user_details/'+userItm.id">
							 <img style="width:150px;height:150px;"  :src="userItm.image_path_show" />  
							 </a>
						 </div>
						 <div class="col-md-10">
						<a :href="'/user_details/'+userItm.id">	  <h4>{{ userItm.full_name }}</h4>  </a>
						  <h6><i class="fa fa-suitcase"></i>{{ userItm.work_title }}</h6>
						  <div class="txtCont">
						  <p>{{ userItm.small_bio }}</p>
						  </div>
						   </div>
					 </div>
			</div>
	  </div>
	  
	  
	  
	  
	  
	  
	  

	</div>
  </AppLayout>
</template>

 