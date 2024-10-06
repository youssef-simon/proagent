<script>
import AppLayout from '@/Layouts/AppLayout.vue';
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
						submit_form:false  , 
				   serviceCategories:[]
					}
		  } 
	 
	 ,props:{
		departments:Object,	
		 errors:Object
	 },setup(){
		 const form = reactive({
		 
				title: '', 
				description: '', 
				department_id: '', 
				parent_id: '', 
			})
			return { form }
	 }, methods:{
	 
	 submit() {
		   router.post('/admin/service_category/store', this.form, {
															onProgress: () => (this.submit_form=true),
															  onError: () =>(this.submit_form=false),

														});
		},departmentChange(){
				var self = this;
				   axios.get("/changedepart/"+ this.form.department_id)
					  .then( function(response) {
											const getData =response.data.data;
											 self.serviceCategories = getData;
								 	}
							)
					  .catch(error => {
						console.error(error);
					  });
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
            <h1>اضف منطقة</h1>
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
            <div class="card-body">
              <div class="form-group">
					  <label for="title">title</label>
				 	  <input id="title" class="form-control" v-model="form.title" />
					 <div class="error_val" v-if="errors.title">هذا الحقل مطلوب</div>
			   </div>
			   
			   
			   <div class="form-group">
					  <label for="desc">description</label>
				 	  <input id="desc" class="form-control" v-model="form.description" />
					 <div class="error_val" v-if="errors.description">هذا الحقل مطلوب</div>
			   </div>
			   
			   
			    <div class="form-group">
										<label for="category_id">departement</label>
											<select  @change="departmentChange"  class="form-control" v-model="form.department_id">
												 <option v-for="departmentItm in departments"  
														 :value="departmentItm.id">
														 {{ departmentItm.name }}
												 </option> 
											</select>
										<div class="error_val" v-if="errors.category_id">هذا الحقل مطلوب</div>
				</div>
			   
			    <div class="form-group">
										<label for="parent_id">parent category</label>
											<select   class="form-control" v-model="form.parent_id">
											     <option>No Parent</option>
												 <option v-for="serviceCategory in serviceCategories"  
														 :value="serviceCategory.id">
														 {{ serviceCategory.title }}
												 </option> 
											</select>
										<div class="error_val" v-if="errors.parent_id">هذا الحقل مطلوب</div>
				</div>
			   
			   
			   
			   
			   <div class="row">
							<div class="col-12">
								 	<button   class="btn btn-primary" v-if="submit_form==false"	type="submit">حفظ</button>
								<button  class="btn btn-primary" 	 v-if="submit_form==true" type="submit" disabled>حفظ</button>
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

 