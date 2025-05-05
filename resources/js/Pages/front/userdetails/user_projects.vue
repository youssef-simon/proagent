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
		 <div class="row">
	
			<div class="col-md-3">
				<img :src="user.image_path_show" style="width:300px;height:350px;" /> 
			</div>
			<div class="col-md-9">
			 
						<h2>{{ user.full_name	 }}</h2>  
						<h5>{{ user.work_title	 }}</h5>  
						<div class="col-md-12">
							<p>{{ user.small_bio }}</p> 
		
						<template v-if="cur_user&&user.id!= cur_user.id">								
							<p><a class="btn btn-danger" :href="'/message_thread/'+user.id">Send Message</a></p>  
							</template>
						</div>
						
						<template v-if="user.vertified==2">
							<span class="verfiedUser"><i class="fa fa-check-circle"></i>Verfied</span>
						</template>
						<template v-if="user.vertified!=2">
							<span class="unverfiedUser"><i class="fa fa-flushed"></i>Not Verfied</span>
							 
						</template>
						
						
						
						<div class="colsss">  
							<div class="tagsCont">
								<ul>
									<template v-for="tagItm in user.tags">
										<li>
											<a href="#">
													{{ tagItm.name }}
											</a>
										</li>
									</template>
								</ul>
							</div>
						</div>
						
						
						
				</div>		
						
			</div>
			 
	  
	  
			</div>
	 </div>
	 
	 
	   <UserTab :user="user" />
	  <div class="tabBigCont">
 
	 
		 
	 <div class="col-md-12 bioCont">
		<h2>My Achievement</h2>
	      <div class="row">
		  
			<div   v-for="serviceItm in userprojects.data" class="col-md-4">
			
						 <div class="serItm">
								 <div class="imgContainer">
								 
									<a :href="'/work_view/'+serviceItm.id">
											<img  style="width:100%;height:185px;" :src="serviceItm.image_path_show" /> 
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

 