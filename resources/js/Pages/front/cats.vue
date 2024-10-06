<script>
import AppLayout from '@/Layouts/AppFrontLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

export default{
	components:{
		AppLayout,reactive,router
	 }
	   
	 ,props:{ 
		  serviceCats:Object, 
		  errors:Object,
	 },setup(){
		 
	 }, methods:{
	  
	
	
	 }
}
</script>

<template>
<AppLayout title="Dashboard">
    <div class="container">
	<div class="col-md-12">
			<h2>Services Taxanomy</h2>
	</div>
      <div class="row">
	  
			  <div class="col-md-4"  v-for="(serviceCatItm, index) in  serviceCats ">
						  
								<h2>{{ serviceCatItm.name }}</h2>
								<ul style="margin-left:20px;">
								  <li  v-for="childernItm in  serviceCatItm.chidern">
										 <a :href="'/service_by_category/'+index+'/'+childernItm.id">{{ childernItm.title }}</a>
										 
									
								  </li>
								</ul>
						  </div>
	  </div>
	</div>
  </AppLayout>
</template>

 