<script>
import AppLayout from '@/Layouts/AppFrontLayout.vue';
 
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

import SideMenu from '@/Pages/front/Comp/SideMenu.vue';

export default{
	components:{
		AppLayout,reactive,router,SideMenu
	 }
	   ,
	   data() {
					return {
						submit_form:false   
				   
					}
		  } 
	  
	 ,props:{ 
		  user:Object,  
		  servicesCount:String,  
		  worksCount:String,  
		  myPurchases:String,  
		  myRequested:String,  
	 },setup(){
		 
	 }, methods:{
	 
	  
	
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
				<div class="col-md-4">
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
					</div>
					
					<div class="col-md-4">
						<div class="cardCont">
						
						<h3>Servcies Count</h3>
						<h4>{{ servicesCount }}</h4	>
						</div>
					</div>
					
					<div class="col-md-4">
						<div class="cardCont">
							<h3>Works/Achievement</h3>
						<h4>{{ worksCount }}</h4	>
						
						</div>
					</div>
					<div class="col-md-4">
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
					</div>
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

 