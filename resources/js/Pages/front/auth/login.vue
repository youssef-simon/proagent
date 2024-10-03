<script>
import AppLayout from '@/Layouts/AppFrontLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { reactive } from 'vue'
import { router, usePage } from '@inertiajs/vue3'
 

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
		 
		  errors:Object,
	 },setup(){
		 
		 const page = usePage()

		 const form = reactive({
				email: '',
				password: '',
				   _token: page.props.csrf_token,
			 
			})
			return { form }
	 }, methods:{
	 
	 submit() {
		 
			 router.post('/login_check', this.form)
	}
	 
	
	
	
	
	
	 }
}
</script>

<template>
<AppLayout title="Dashboard">
    <div class="card-deck mb-3">
			<h2>login</h2>
			
			
			   <form @submit.prevent="submit">
								<div class="form-group">
									<label for="title">email:</label>
									<input id="title" class="form-control" v-model="form.email" />
								</div>
								
								 	<div class="form-group">
									<label for="title">password:</label>
									<input id="title" class="form-control" type="password" v-model="form.password" />
								</div>
								
								 
												 
								 
								<button  
								class="btn btn-primary"
								type="submit">Submit</button>
					  </form>
	</div>
  </AppLayout>
</template>

 