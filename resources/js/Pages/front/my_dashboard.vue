<script>
import AppLayout from '@/Layouts/AppFrontLayout.vue';
 
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
  <div class="row">
		<div class="col-md-3">
		 
		<div class="userImg">
	 	<img class="userImgCont" :src="user.image_path_show" />
		</div>
				<ul class="dashBoardList">
					<li> <a href="/service_list">
					
					<i class="fas fa-th"></i>
					My Servcies</a> </li>
					
					
					<li> <a href="/my_requested_service">
					<i class="fas fa-th"></i> My sales</a> </li>
					
					 
					<li> 	<a href="/my_purchases">
					<i class="fas fa-th"></i>
					My Purchases</a> </li> 
					
					<li> 	<a href="/my_messages">
					<i class="fas fa-th"></i>
					My Messages</a> </li> 
					<li> 	<a :href="'/user_details/'+user.id">
					<i class="fas fa-th"></i>
					My Page</a> </li> 
					<li><a href="/edit_profile">
					<i class="fas fa-th"></i>
					Edit Profile</a> </li> 
					
				<li> 	<a href="/my_works">
					<i class="fas fa-th"></i>
					My Works</a> </li> 
				</ul>
		</div>  
		<div class="col-md-9">
				<div class="row">
					<div class="col-md-3">
						<div class="cardCont">
						
						<h3>Total Money</h3>
						<h4>0 $</h4	>
						</div>
					</div>
					
					<div class="col-md-3">
						<div class="cardCont">
							<h3>Total Money</h3>
						<h4>0 $</h4	>
						
						</div>
					</div>
					<div class="col-md-3">
						<div class="cardCont">
						
							<h3>Total Money</h3>
						<h4>0 $</h4	></div>
					</div>
				
				</div>
				
					<div class="row">
					<div class="col-md-3">
						<div class="cardCont">
						
						<h3>Total Money</h3>
						<h4>0 $</h4	>
						</div>
					</div>
					
					<div class="col-md-3">
						<div class="cardCont">
							<h3>Total Money</h3>
						<h4>0 $</h4	>
						
						</div>
					</div>
					<div class="col-md-3">
						<div class="cardCont">
						
							<h3>Total Money</h3>
						<h4>0 $</h4	></div>
					</div>
				
				</div>
		</div>
	</div>  
  </AppLayout>
</template>

 