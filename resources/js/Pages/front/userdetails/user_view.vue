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
		  services:Object, 
		  userprojects:Object,  
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
	 <div class="col-md-12 bioCont">
		<h2>My Bio</h2>
		<div class="bioContTxt" v-html="user.biograph">
		 
		</div>
	 
	 </div>
	 
	 <div class="col-md-12 bioCont">
		<h2>My Services</h2>
	      <div class="row">
		  
			<div   v-for="serviceItm in services" class="col-md-4">
			
						 <div class="serItm">
								 <div class="imgContainer">
								 
									<a :href="'/service_view/'+serviceItm.id">
											<img  style="width:100%;height:185px;" :src="serviceItm.resize_image_path_show" /> 
									 </a>
								 </div>
								<h5>{{ serviceItm.title }}</h5> 
								<h5><span>Begin from </span>: {{ serviceItm.price_from }} $</h5>
								
								<p><template v-if="serviceItm.category.parent_category">{{ serviceItm.category.parent_category.title }} /</template> {{ serviceItm.category.title }}  </p>
							
							
						</div>
			</div>
	  </div>
	  </div>
	  
		 <div class="col-md-12 bioCont">
				<h2> My Previous Projects / Experiences </h2>
	      <div class="row">
		  
			<div   v-for="serviceItm in userprojects" class="col-md-4">
			
						 <div class="serItm">
								 <div class="imgContainer">
								 
									<a :href="'/work_view/'+serviceItm.id">
											<img  style="width:100%;height:185px;" :src="serviceItm.resize_image_path_show" /> 
									 </a>
								 </div>
								<h5>{{ serviceItm.title }}</h5> 
							 
							
						</div>
			</div>
	  </div>
	  </div>
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  </div>
	 
	 
	 
	 
	 
	 
	  </div>
	  
	  
	  
	  
	  
	  
	  

	</div>
	
	
	
	
	
	
  </AppLayout>
</template>

 