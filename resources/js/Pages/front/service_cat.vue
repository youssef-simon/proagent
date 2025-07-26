<script>
import AppLayout from '@/Layouts/AppFrontLayout.vue'; 
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

export default{
	components:{
		AppLayout,reactive,router
	 }
	,data() {
					return {
						submit_form:false   
				   
					}
		  } 
	  
	 ,props:{
		  curr_id:String,
		 dep_id:String,
		 	 department:Object,
		  services:Object,
		  categories:Object,
		  		 alldepartments:Object,
		  errors:Object,
	 },setup(props){
		 const form = reactive({
				curr_id: props.curr_id, 
			})
			return { form }
	 }, methods:{ 
	
	 }
}
</script>

<template>
<AppLayout title="Dashboard">
    <div class="whContAll">
	 
		<div class="header">
			<h2> <a :href="route('category_all', { id:dep_id })">{{ department.name }}</a></h2>
	</div> 
      <div class="row">
		  <div class="col-md-3">
			<ul>
				  <li class="taxItmCont"   v-for="categoryItm in categories">
						<h6>
							<a v-if="categoryItm.id==form.curr_id"  class="active"  :href="route('category_all', { id:dep_id, childid:categoryItm.slug})">{{ categoryItm.title }}</a>
							<a  v-if="categoryItm.id!=form.curr_id" :href="route('category_all', { id:dep_id, childid:categoryItm.slug})">{{ categoryItm.title }}</a>
						
						</h6>
							<ul>
								<li v-for="categoryItmChild in categoryItm.child_categories">
										<a v-if="categoryItmChild.id==form.curr_id" class="active" :href="route('category_all', { id:dep_id, childid:categoryItmChild.slug})">{{ categoryItmChild.title }}</a>
										<a v-if="categoryItmChild.id!=form.curr_id" :href="route('category_all', { id:dep_id, childid:categoryItmChild.slug})">{{ categoryItmChild.title }}</a>
								 </li>
							</ul>
				   </li>
				  </ul>
				  
				  
				  
					<h4>Other Departements : </h4>	
				  	<template  v-for="departItm in alldepartments">
							<template v-if="dep_id!=departItm.slug">
								<h6 class="serviceDep">
										<a :href="route('category_all', { id:departItm.slug})">{{ departItm.name }}</a>
								 </h6>
							 </template>
							 </template>
							 
				  
				  
				  
		  </div>
	  <div class="col-md-9">
	  <div class="row">
			<div   v-for="serviceItm in services.data" class="col-md-4">
			
						<div class="serItm">
								 <div class="imgContainer">
								 
									<a :href="'/service_view/'+serviceItm.id">
											<img :src="serviceItm.resize_image_path_show" style="width:100%;height:185px;" /> 
									 </a>
								 </div>
								<h6 class="title">{{ serviceItm.title }}</h6> 
								<h6><span>Begin from </span>: {{ serviceItm.price_from }} $</h6>
								
						 	<template v-if="serviceItm.category">
													<h6 class="catItm"><template v-if="serviceItm.category.department">{{ serviceItm.category.department.name }} /</template> {{ serviceItm.category.title }}  </h6>
										</template>
						</div>
			</div>
			</div>
	  </div>
	</div>
	</div>
  </AppLayout>
</template>

 