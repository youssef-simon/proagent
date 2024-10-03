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
		  area:Object, 
		  errors:Object
	 },setup(props){ 
		 const form = reactive({ 
			  	title: props.area.title ,
			  
			})
			const area=props.area;
			return { form ,area }
	 }, methods:{
			  submit() {
				     router.post('/area/update/'+this.area.id, this.form)
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
            <h1>تعديل المنطقة</h1>
          </div>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>
	
	
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
								   <button @click="submit()"  class="btn btn-success float-right" type="submit">حفظ</button>
							</div>
				  </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
       </div>
      
	 </form> 
    </section> </AppLayout>
</template>

 