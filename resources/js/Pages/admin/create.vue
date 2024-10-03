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
 
		 errors:Object
	 },setup(){
		 const form = reactive({
				first_name: '',
				last_name: '',
				email: '',
				password: '',
				password_confirmation: '',
			 
			 
			})
			return { form }
	 }, methods:{
	 
	 submit() {
		   router.post('/admin/store', this.form)
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
     <!-- Main content -->
    <section class="content">
	
	 <form @submit.prevent="submit">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">General</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
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
				<input id="email" class="form-control" v-model="form.email" />
			  <div v-if="errors.email">{{ errors.email }}</div>
              </div>
              <div class="form-group">
             			  <label for="password">password:</label>
						<input id="password" class="form-control" v-model="form.password" type="password" />
						 <div v-if="errors.password">{{ errors.password }}</div>
              </div>
              
              <div class="form-group">
                       <label for="password_confirmation">password_confirmation:</label>
					<input id="password_confirmation" class="form-control" type="password" v-model="form.password_confirmation" />
					 <div v-if="errors.password">{{ errors.password_confirmation }}</div>
              </div>
			  
			  
			  
			    <div class="form-group">
                       <label for="password_confirmation">Roles:</label>
					  
					  <label v-for="(item, index) in roles" :key="index">
						  <input type="checkbox" v-model="form.admin_roles" :value="item.name" />
						  {{ item.name }}
					</label>
	 
			</div>
			  
		 <div class="row">
        <div class="col-12">
          <a href="#" class="btn btn-secondary">Cancel</a>
      
		  <button @click="submit()"  class="btn btn-success float-right" type="submit">Submit</button>
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

 