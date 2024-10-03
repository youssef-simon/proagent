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
		 
			 router.post('/user/store', this.form)
	}
	 
	
	
	
	
	 }
}
</script>

<template>
<AppLayout title="Dashboard">
    <div class="card-deck mb-3">
			<h2>register</h2>
	</div>
	
	
	
	
	
	
	
	
	
	     <!-- Main content -->
    <section class="content">
	
	 <form @submit.prevent="submit">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
            
            <div class="card-body">
              <div class="form-group">
					  <label for="name">  first_name:</label>
					<input id="first_name" class="form-control" v-model="form.first_name" />
              </div>
			  <div class="form-group">
					  <label for="name">  last_name:</label>
					<input id="last_name" class="form-control" v-model="form.last_name" />
              </div>
              <div class="form-group">
					<label for="email">email:</label>
					<input id="email" class="form-control" v-model="form.email" />
				  <div v-if="errors.email">{{ errors.email }}</div>
              </div>
			  
			  
			     <div class="form-group">
					<label for="email">biograph:</label>
					<textarea id="biograph" class="form-control" v-model="form.biograph" ></textarea>
				  <div v-if="errors.biograph">{{ errors.biograph }}</div>
              </div>
			  
			  
			  
			  
			    <div class="form-group">
					<label for="phone">phone:</label>
					<input id="phone" class="form-control" v-model="form.phone" />
				  <div v-if="errors.phone">{{ errors.phone }}</div>
              </div>
			  
              <div class="form-group">
             			  <label for="password">password:</label>
						<input id="password" class="form-control" v-model="form.password" type="password" />
              </div>
              
              <div class="form-group">
                       <label for="password_confirmation">password_confirmation:</label>
					<input id="password_confirmation" class="form-control" type="password" v-model="form.password_confirmation" />
              </div>
			  
			 
			 
			  
			  
			  
			  
			   

			 
			 
			 
			 
		 <div class="row">
        <div class="col-12">
          <a href="#" class="btn btn-secondary">Cancel</a>
      
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
	
	
	
	
	
	
	
	
	
  </AppLayout>
</template>

 