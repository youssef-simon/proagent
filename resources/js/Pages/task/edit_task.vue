<script>
import AppLayout from '@/Layouts/AppEmpLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

export default{
	components:{
		AppLayout,reactive,router
	 } 
	 ,props:{
		 task:Object,
		 taskstatuses:Object,
		
	 },setup(props){ 
		 const form = reactive({
				task_status_id:props.task.task_status_id,
		 	});
			const task= props.task;
			return { form , task }
	 }, methods:{
			  submit() {
				   
					  router.post('/employee/task/'+this.task.id, this.form)
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
								 
								
								 
								<h1> {{ task.name }}</h1>
								<p> {{ task.description }}</p>
								
								
								<h3>Task Status :  {{ task.task_status }}   </h3>
									<label>task status</label>
									<select v-model="form.task_status_id">
										<option  v-for="taskstatus in taskstatuses" :value="taskstatus.id">{{ taskstatus.name }}</option>
									</select>	
								
								<button @click="submit()"
								class="btn btn-primary"
								type="submit">Submit</button>
					  </form>
			  </div>
		  </div>
  </AppLayout>
</template>

 