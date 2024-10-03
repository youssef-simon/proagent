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
						submit_form:false   
				   
					}
		  } 
	 
	 ,props:{
			
		 errors:Object
	 },setup(){
		 const form = reactive({
		 
				title: '', 
			})
			return { form }
	 }, methods:{
	 
	 submit() {
		   router.post('/area/store', this.form, {
															onProgress: () => (this.submit_form=true),
															  onError: () =>(this.submit_form=false),

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
					  <label for="title">الاسم</label>
				 	  <input id="title" class="form-control" v-model="form.title" />
					 <div class="error_val" v-if="errors.title">هذا الحقل مطلوب</div>
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

 