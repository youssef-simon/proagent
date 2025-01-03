<script>
import { Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'; 
import { router } from '@inertiajs/vue3'
import { reactive } from 'vue'

export default {
  props: {
    verifiedRequest: {
      type: Object,
      required: true,
    },
  },  components: {
        Link,reactive
		
    },setup(){
						const form = reactive({
									verify_status: '',  
						 })
			 	return { form }
			},methods:{
		  destroy(id) {
				if (confirm("Are you sure you want to Delete")) {
         
					router.delete(route("user.delete", id));
				}
			},changeStatus(){
						this.form.id=this.verifiedRequest.id;
					router.post(route("update_status"),this.form);

			},
			
	}
  
};
</script>
<template>
<AppLayout title="Dashboard">
      <section class="content-header">
			  <div class="container-fluid">
				<div class="row mb-2">
				  <div class="col-sm-6">
					<h1>Verified Users</h1>
				  </div>
				 
				</div>
			  </div> 
     </section>

    <div class="card">
	
	  <div class="card-header">
                <h3 class="card-title">Verified users</h3>
              </div>
			  
			
 <div class="imagesContanier">
 
		<img :src="verifiedRequest.front_image_show" />
		<img :src="verifiedRequest.back_image_show" />
		<img :src="verifiedRequest.selffront_image_show" />
 </div>
 
  
		 <div class="formData">
		  
		 <label>verfiy status</label>
		 
		 <select v-model="form.verify_status"  >
		 <option value="1">VERIFIED_UNDER</option>
		 <option value="2">VERIFIED_APPROVED</option>
		 <option value="3">STATUS_REFUSED</option>
		  </select>
		  <button class="btn btn-primary" @click="changeStatus()">Update</button>
		 </div>
		  

    
    </div> 
  </AppLayout>
</template>
