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
		 department:Object,
		
	 },setup(props){ 
		 const form = reactive({
				name:props.department.name,
				description:props.department.description,
			})
			const department=props.department;
			return { form ,department }
	 }, methods:{
			  submit() {
				   
					  router.post('/department/update/'+this.department.id, this.form)
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
            <h1>departement</h1>
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
	  <div class="card card-primary">
			  <div class="card-body">
					  <form @submit.prevent="submit">
								<div class="form-group">
									<label for="title">name:</label>
									<input id="title" class="form-control" v-model="form.name" />
								</div>
								
								 	<div class="form-group">
									<label for="title">description:</label>
									<input id="title" class="form-control" v-model="form.description" />
								</div>
								
								 
												 
								 
								<button @click="submit()"
								class="btn btn-primary"
								type="submit">Submit</button>
					  </form>
			  </div>
		  </div>
  </AppLayout>
</template>

 