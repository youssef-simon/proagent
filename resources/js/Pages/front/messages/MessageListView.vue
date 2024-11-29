<template>
   
				  <div class="container">
						  <div class="row">
										  <div class="col-md-12 serviceCont">
											<h1>Message</h1> 	 
										  </div> 
										  <div class="comment">
												  <div class="item_comment"   v-for="(item, indexe) in users">
														 
															<p> {{  item.name }} </p>
															<p> {{  item.email }} </p>
															<a class="btn btn-danger" :href="'/message_thread/'+item.id">Send Message</a>
												  </div>
										  </div>
										 
						  </div>
				  </div>
 
</template>

<style>
 .item_comment{
		width:100%;
		padding:25px;
		border:1px solid  #000;
		margin-bottom:20px;
 }
 
 .serviceCont .row img{
	width:100%;
 }
 
 
  
   .serviceCont{
    margin-top: 30px;
   }
   .item p span { font-weight:bold; }
</style>
<script>
import { Modal } from 'usemodal-vue3'; 


 export default {
	 components: { 
		Modal,
	},
  data() {
    return {
		users:[]
    }
  },

  created() {
	   var id=  this.$route.params.id; 
		 this.fetchAdmins(); 
		
  }
	, methods: {  
				 async fetchAdmins() {
						 const comments = await fetchWrapper.get("/api/message_threads").then((res) => {
																				this.users=res.data;  
						 });
				 }    
		  } 
			
  }
  
</script> 
