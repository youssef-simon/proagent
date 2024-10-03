<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

export default{
	components:{
		AppLayout,reactive,router
	 } ,props:{
		  task:Object, 
		  taskstatuses:Object, 
	 },
  data() {
    return {
	 
		list_users:[], 
 
    }
  }  ,setup(props){
		 const form = reactive({
			  name:  props.task.name,
			  description:  props.task.description,
			  emp_id:  props.task.employee.id,
			  emp_name: props.task.employee.first_name,
			  task_status_id: props.task.task_status_id,
			  autocomplete: props.task.employee.full_name,
  
			});
			
			const task= props.task;
			return { form,task }
	 }, methods:{
			    submit() {
						router.post('/task/update/'+this.task.id, this.form)
				}	,searhStudent(){
							var self=this;
								 axios.get("/searchusers?term="+this.form.autocomplete)
									  .then( function(response) {
														
														self.list_users=response.data .data;
														console.log(	self.list_users);
												 })
									  .catch(error => {
										console.error(error);
									  });
							
						} 
						,  getUser(emp){ 
								this.form.emp_name=emp.full_name;
								this.form.autocomplete=emp.full_name; 
								this.list_users=[];
								this.form.emp_id=emp.id; 
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
            <h1>Task</h1>
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
									<label for="name">name:</label>
									<input id="name" class="form-control" v-model="form.name" />
								</div>
								
								 	<div class="form-group">
									<label for="description">description:</label>
									<input id="description" class="form-control" v-model="form.description" />
								</div>
								
								 
								 
								 
								 
								 
								 <div class="tabCont">
										<label>Search Employee Name : </label>
																	<input type="text" @keyup="searhStudent" class="form-control" v-model="form.autocomplete" />
																	<ul>
																			<li class="auto_itm" v-for="(user, indexe) in list_users"    @click="getUser(user)"  :value="user.id" :key="indexe">
																						{{ user.first_name }} 
																			</li>
																	</ul>
														    <h4>Chooesed EmpName</h4>
															<h5>Employee Name : {{ form.emp_name }}</h5>		 
															<h5>Emp Id : {{ form.emp_id }}</h5>		 
										</div>
								 
								 
								 
								 
								 
								 	  <select v-model="form.task_status_id">
											  <option  v-for="task_status  in taskstatuses" :value="task_status.id">
													{{ task_status.name }}
											  </option>
									  </select>
								 
								 
								 
								 
								 
								 
								 
												 
								 
								<button @click="submit()"
								class="btn btn-primary"
								type="submit">Submit</button>
					  </form>
			  </div>
		  </div>
  </AppLayout>
</template>

 