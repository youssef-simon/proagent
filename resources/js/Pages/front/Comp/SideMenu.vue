 <script>

import { usePage } from '@inertiajs/vue3';

export default{
	components:{
		 
	 } ,
	   data() {
					return {
						 
				   user: usePage().props.auth.user, 
					}
		  } 
	  
	 
}
</script>
<template>

		<div class="sideMenu">
			 
		 <div class="userDetailCont">
			 
			</div>
			
				<ul class="dashBoardList">
				
					<li> <a href="/my_dashboard">
					
					<i class="fas fa-th"></i>
					My Dashboard</a> </li>
				
				
					<li> <a href="/my_notifications">
					
					<i class="fas fa-th"></i>
					My Notifications</a> </li>
					
					<li> <a href="/service_list">
					
					<i class="fas fa-th"></i>
					My Servcies</a> </li>
					
					
				<!--	<li> <a href="/my_requested_service">
					<i class="fas fa-th"></i> My sales</a> </li> 
					
					 
					<li> 	<a href="/my_purchases">
					<i class="fas fa-th"></i>
					My Purchases</a> </li>
					
						<li> 	<a :href="'/user_details/'+user.id">
					<i class="fas fa-th"></i>
					My Page</a> </li>  -->
					
					<li> 	<a href="/my_messages">
					<i class="fas fa-th"></i>
					My Messages</a> </li> 
				
					<li><a href="/edit_profile">
					<i class="fas fa-th"></i>
					Edit Profile</a> </li> 
					
				<li> 	<a href="/my_works">
					<i class="fas fa-th"></i>
					  My Previous Projects / Experinces</a> </li> 
					  
									<li> 	<a href="/my_links">
					<i class="fas fa-th"></i>
					  My Links</a> </li>   
					
						<li v-if="user.vertified!=2"> 	<a href="/verify_create">
					<i class="fas fa-th"></i>
					verify account</a> </li> 
				</ul>
		</div>  
		
						</template>