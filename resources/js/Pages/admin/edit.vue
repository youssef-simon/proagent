<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

export default{
	components:{
		AppLayout,reactive,router
	 } 
	 ,props:{
		 admin:Object,
		  errors:Object
	 },setup(props){ 
		 const form = reactive({ 
			  	first_name: props.admin.first_name ,
				last_name: props.admin.last_name,
				email: props.admin.email,
				password: '',
				password_confirmation: '',  
			})
			const admin=props.admin;
			return { form ,admin }
	 }, methods:{
			  submit() {
				     router.post('/admin/update/'+this.admin.id, this.form)
			  }
	 }
}
</script>

<template>
<AppLayout title="Dashboard">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Admins</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Gallery</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  <div class="card">
	
								<div class="card-header">
									<h3 class="card-title">admins</h3>
								</div>
					
								<div class="card-body">
											  <div class="form-group">
													  <label for="first_name">  first_name:</label>
													  <input id="first_name" class="form-control" v-model="form.first_name" />
													  <div v-if="errors.first_name">{{ errors.first_name }}</div>
											  </div>
											   <div class="form-group">
														<label for="last_name"> last_name:</label>
														<input id="last_name" class="form-control" v-model="form.last_name" />
														<div v-if="errors.last_name">{{ errors.last_name }}</div>
											  </div>
											  
											   
											  <div class="form-group">
												<label for="email">email:</label>
													<p> {{ form.email }}</p>
													<div v-if="errors.email">{{ errors.email }}</div>
											  </div>
												 
													   
												 <div class="row">
														<div class="col-12">
														  <a href="#" class="btn btn-secondary">Cancel</a>
													  
														  <button @click="submit()"  class="btn btn-success float-right" type="submit">Submit</button>
														</div>
												</div>
							</div>
							
			
    </div>
  </AppLayout>
</template>

 