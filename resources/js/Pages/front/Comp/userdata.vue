<template>
<h2>{{ user.full_name	 }}</h2>  
						<h5>{{ user.work_title	 }}</h5>  
						<div class="col-md-12">
							<p>{{ user.small_bio }}</p> 
		
						<template v-if="cur_user&&user.id!= cur_user.id">								
							<p><a class="btn btn-danger" :href="'/message_thread/'+user.id">Send Message</a></p>  
							</template>
						</div>
						</template>