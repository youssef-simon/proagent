<script>
import AppLayout from '@/Layouts/AppFrontLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { reactive } from 'vue';
import { router } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';

import UserData from '@/Pages/front/Comp/userdata.vue';
import UserTab from '@/Pages/front/Comp/userTab.vue';



export default{
	components:{
		AppLayout,reactive,router,UserData,UserTab
	 }
	   ,
	   data() {
					return {
						submit_form:false   ,
						cur_user: usePage().props.auth.user 
					}
		  } 
	  
	 ,props:{ 
		  user:Object, 
		  userLinks:Object, 
	 },setup(){
		 
	 }, methods:{
	 
	  
	
	 }
}
</script>

<template>
<AppLayout title="Dashboard">



    <div class="card-deck">
	<div class="container">
	 	  <div class="userContIntro col-md-12">
				 <div class="container">
							<UserData :user="user" />
						</div>
		</div>
		  <UserTab :user="user" />
					
					
	  <div class="tabBigCont">
 
	 
		 
	 <div class="col-md-12 myLinks">
		<h2>My Links</h2>
	      <div class="row">
		  
			<div   v-for="userLink in userLinks.data" class="col-md-12">
			
						 <div class="serItm">
								 
								<h5>
								
								
								<a :href="userLink.link">
								{{ userLink.title }}
								</a>
								
								
								</h5> 
								<h5>{{ userLink.description }}</h5> 
							 
								 
							
						</div>
			</div>
	  </div>
	  </div>
	  
	  </div>
	 
	 
	 
	 
	 
	 
	  </div>
	  
	  
	  
	  
	  
	  
	  

	</div>
	








  </AppLayout>
</template>

 