<script>
import AppLayout from '@/Layouts/AppFrontLayout.vue';
 
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import SideMenu from '@/Pages/front/Comp/SideMenu.vue';
  

export default{
	components:{
		AppLayout,reactive,router,SideMenu  
	 }  ,
	   data() {
					return {
						submit_form:false   
				   
					}
		  } 
	 ,props:{
		  userlink:Object,   
		  errors:Object
	 },setup(props){ 
		 const form = reactive({ 
			    title:  props.userlink.title , 
				description:  props.userlink.description ,
				link:  props.userlink.link ,
				
				 
			 }) 
			return { form  }
	 }, methods:{
			  submit() {
				     router.post('/link/update/'+this.userlink.id, this.form)
			  }
			   
			  /***************************/
		 
			 
		/***************************/
		 
	 }
}
</script>

<template>
<AppLayout title="Dashboard">
    <div class="whContAll">
  <div class="row">
		<div class="col-md-3">
			<SideMenu />
		</div>  
		<div class="col-md-9">

    <div class="formMainCont">
	
     <h2>Edit Link </h2>
		 
 	
	
	 <form @submit.prevent="submit">
      <div class="col-md-9">
      
            <div class="formCont">
              <div class="form-group">
					  <label for="title">title</label>
				 	  <input id="title" class="form-control" v-model="form.title" />
					 <div class="error_val" v-if="errors.title">{{ errors.title }}</div>
			   </div>
			   
		<div class="form-group">
					  <label for="link">link</label>
				 	  <input id="link" class="form-control" v-model="form.link" />
					 <div class="error_val" v-if="errors.link">{{ errors.link }}</div>
			   </div>
			   
			   
			    
                
              <div class="form-group">
					  <label for="description">description</label>
				 	  <textarea v-model="form.description"  id="description" class="form-control  "  > 
					   </textarea>
					 <div class="error_val" v-if="errors.description">{{ errors.description }}</div>
			   </div>
			    
			     
				
				
			   <div class="row">
							<div class="col-12">
								 	<button   class="btn btn-primary col-md-12" v-if="submit_form==false"	type="submit">save</button>
								<button  class="btn btn-primary col-md-12" 	 v-if="submit_form==true" type="submit" disabled>save</button>
							</div>
				</div>
            
            <!-- /.card-body -->
        
          <!-- /.card -->
        </div>
       </div>
      
	 </form> 
 
 
 
 
 
 
    </div>
	  
	
 

		</div>
	</div>  
	</div>  
  </AppLayout>
</template>

 