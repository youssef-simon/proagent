<script>
import AppLayout from '@/Layouts/AppFrontLayout.vue';
 
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

import SideMenu from '@/Pages/front/Comp/SideMenu.vue';
import { usePage } from '@inertiajs/vue3'

export default{
	components:{
		AppLayout,reactive,router,SideMenu
	 }
	   ,
	   data() {
					return {
						submit_form:false   ,
						subscription: usePage().props.subscription,
						protocol: window.location.protocol ,
						curr_domain: window.location.hostname,
					}
		  } 
	  
	 ,props:{ 
		  user:Object,  
		  servicesCount:String,  
		  worksCount:String,  
		  myPurchases:String,  
		  myRequested:String,  
		  subscription:Object,  
	 },setup(){
		 
	 }, methods:{
	 
	  
	
	 },created(){
		 
		
	 }
}
</script>

<template>
<AppLayout title="Dashboard">
    <div class="whContAll">
  <div class="row">
		<div class="col-md-3">
		<SideMenu />
		</div>  
		<div class="col-md-9">
				<div class="row">
				
				
					 <div class="col-md-12 cardUserData">
						 <div class="row">
						
								<div class="col-md-3">
									<img :src="user.image_path_show" style="width:300px;" /> 
								</div>
								<div class="col-md-9">
								 
											<h2>{{ user.full_name	 }}</h2>  
											<h5>{{ user.work_title	 }}</h5>  
											<h5>Your Page : <a target="_blank" :href="'/user_details/'+user.slug">{{ protocol }}//{{ curr_domain }}/user_details/{{ user.slug }}</a></h5>  
											<div class="col-md-12">
									 
							 
											</div>
											
											<template v-if="user.vertified==2">
												<span class="verfiedUser"><i class="fa fa-check-circle"></i>Verfied</span>
											</template>
											<template v-if="user.vertified!=2">
												<span class="unverfiedUser"><i class="fa fa-flushed"></i>Not Verfied</span>
												 
											</template>
									</div>		
											
								</div>
					</div>
			 
				
				
				
				
				
				
				
				
				

					<!--<div class="col-md-12">
						<div class="cardCont">
						
						<h3>Current Subsciption : {{ subscription.title }}</h3>
						<h4> Max Achivement : {{ subscription.work_limit }}</h4>
						<h4> Max Servcies : {{ subscription.service_limit }}</h4>
						</div>
					</div>-->
			<!--	<div class="col-md-4">
						<div class="cardCont">
						
						<h3>Total Balance</h3>
						<h4>{{ user.total_balance }} $</h4>
						</div>
					</div>
					
					
					<div class="col-md-4">
						<div class="cardCont">
						
						<h3>Pending Balance</h3>
						<h4>{{ user.pending_balance }} $</h4>
						</div>
					</div>
					
					
					<div class="col-md-4">
						<div class="cardCont">
						
						<h3>Avaible Balance</h3>
						<h4>{{ user.ava_balance }} $</h4>
						</div>
					</div>-->
					
					<div class="col-md-6">
						<div class="cardCont">
						
						<h3>Servcies Count</h3>
						<h4>{{ servicesCount }}</h4	>
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="cardCont">
							<h3>Works/Achievement</h3>
						<h4>{{ worksCount }}</h4	>
						
						</div>
					</div>
					<!--	<div class="col-md-4">
						<div class="cardCont">
						
							<h3>my Purchases</h3>
						<h4>{{ myPurchases }}</h4	></div>
					</div>
				
				</div>
				
					<div class="row">
					<div class="col-md-4">
						<div class="cardCont">
						
						<h3>My Requested service</h3>
						<h4>{{ myRequested }}</h4	>
						</div>
					</div>-->
					<!--
					<div class="col-md-4">
						<div class="cardCont">
							<h3>Total Money</h3>
						<h4>0 $</h4	>
						
						</div>
					</div>
					<div class="col-md-4">
						<div class="cardCont">
						
							<h3>Total Money</h3>
						<h4>0 $</h4	></div>
					</div>-->
				
				</div>
		</div>
	</div>  
	</div>  
  </AppLayout>
</template>

 