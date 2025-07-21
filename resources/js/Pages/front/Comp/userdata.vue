<script>



export default{
	 
	 props:{ 
		  user:Object, 
		  
	 }
	 
}
</script>

<template> 

		 <div class="row">
	
			<div class="col-md-3">
				<img :src="user.image_path_show" style="width:250px;height:250px;" /> 
			</div>
			<div class="col-md-9">
			 
						<h2>{{ user.full_name	 }}</h2>  
						<h5>{{ user.work_title	 }}</h5>  
						<div class="col-md-12">
							<p>{{ user.small_bio }}</p> 
		
						<template v-if="cur_user&&user.id!= cur_user.id">								
							<p><a class="btn btn-danger" :href="'/message_thread/'+user.id">Send Message</a></p>  
							</template>
						</div>
						
						
						<template v-if="user.vertified==2">
							<span class="verfiedUser"><i class="fa fa-check-circle"></i>Verfied</span>
						</template>
						<template v-if="user.vertified!=2">
							<span class="unverfiedUser"><i class="fa fa-flushed"></i>Not Verfied</span>
							 
						</template>
						
						<div class="colsss">   
							<div class="tagsCont">
								<ul>
									<template v-for="tagItm in user.tags">
										<li>
											<a href="#">
													{{ tagItm.name }}
											</a>
										</li>
									</template>
								</ul>
							</div>
						</div>
				</div>		
						
			</div>
	</template>