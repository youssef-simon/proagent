<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

export default{
	components:{
		AppLayout,reactive,router
	 } ,props:{
		  task_statuses:Object, 
	 },
  data() {
    return {
	 
		list_users:[], 
 
    }
  }  ,setup(){
		 const form = reactive({
			  name:"",
			  description:"",
			  emp_id:"",
			  emp_name:"",
  
			})
			return { form }
	 }, methods:{
			    submit() {
						router.post('/task/store', this.form)
				}	,searhStudent(){
							var self=this;
								 axios.get("/searchusers?term="+this.autocomplete)
									  .then( function(response) {
														
														self.list_users=response.data .data;
														console.log(	self.list_users);
												 })
									  .catch(error => {
										console.error(error);
									  });
							
						} 
						,  getUser(emp){ 
								this.emp_name=emp.first_name;
								this.autocomplete=''; 
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
																	<input type="text" @keyup="searhStudent" class="form-control" v-model="autocomplete" />
																	<ul>
																			<li class="auto_itm" v-for="(user, indexe) in list_users"    @click="getUser(user)"  :value="user.id" :key="indexe">
																						{{ user.first_name }} 
																			</li>
																	</ul>
														    <h4>Chooesed EmpName</h4>
															<h5>Employee Name : {{ emp_name }}</h5>		 
															<h5>Emp Id : {{ emp_id }}</h5>		 
										</div>
								 
								 
								 
								 
								 
								 	  <select v-model="form.task_status_id">
											  <option  v-for="task_status  in task_statuses" :value="task_status.id">
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

 