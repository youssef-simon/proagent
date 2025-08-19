<script>
import AppLayout from '@/Layouts/AppFrontLayout.vue';
import Welcome from '@/Components/Welcome.vue';
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
	 
		  errors:Object,
	 },setup(){
		 const form = reactive({
				first_name: '',
				last_name: '',
				email: '',
				password: '',
				phone: '',
				password_confirmation: '',
			 
				 
				
			 
			})
			return { form }
	 }, methods:{
	 
	 submit() {
		 
			 router.post('/register_store', this.form)
	}
	 
	
	
	
	
	 }
}
</script>

<template>
<AppLayout title="Dashboard">
<div class="registerCont">
   
	
	 
	     <!-- Main content -->
    <section class="content">
	 
	 <form @submit.prevent="submit">
      <div class="row">
        <div class="col-md-6 middleReg">
          <div class="card card-primary">
            	<h2> {{ __("register") }}</h2>
            <div class="card-body">
              <div class="form-group">
					  <label for="name">{{ __("first_name") }}</label>
					<input id="first_name" class="form-control" v-model="form.first_name" />
						  <div class="error_val" v-if="errors.first_name">{{ errors.first_name }}</div>
              </div>
			  <div class="form-group">
					  <label for="name"> {{ __("last_name") }}</label>
					<input id="last_name" class="form-control" v-model="form.last_name" />
						  <div class="error_val" v-if="errors.first_name">{{ errors.first_name }}</div>
              </div>
              <div class="form-group">
					<label for="email">{{ __("email") }} </label>
					<input id="email" class="form-control" v-model="form.email" />
				  <div class="error_val" v-if="errors.email">{{ errors.email }}</div>
              </div>
			  
			   
			  
			  
			  
			  
			    <div class="form-group">
					<label for="phone">  {{ __("phone") }} </label>
					<input id="phone" class="form-control" v-model="form.phone" />
				  <div class="error_val" v-if="errors.phone">{{ errors.phone }}</div>
              </div>
			  
              <div class="form-group">
             			  <label for="password">  {{ __("password") }} </label>
						<input id="password" class="form-control" v-model="form.password" type="password" />
						<div  class="error_val" v-if="errors.password">{{ errors.password }}</div>
              </div>
              
              <div class="form-group">
                       <label for="password_confirmation">  {{ __("password_confirmation") }}</label>
					<input id="password_confirmation" class="form-control" type="password" v-model="form.password_confirmation" />
							<div class="error_val" v-if="errors.password_confirmation">{{ errors.password_confirmation }}</div>
              </div>
			  
			 
			 
			  
			  
			  
			  
			   

			 
			 
			 
			 
		 <div class="row">
        <div class="col-12">
        
		
		  <button   class="btn btn-success float-right" type="submit">Submit</button>
        </div>
      </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
       </div>
      
	 </form> 
    </section>
    <!-- /.content -->
	
	</div>
	
	
	
	
	
	
	
  </AppLayout>
</template>

 