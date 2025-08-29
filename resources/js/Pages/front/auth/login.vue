<script>
import AppLayout from '@/Layouts/AppFrontLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { reactive } from 'vue'
import { router, usePage } from '@inertiajs/vue3'
 

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
		 
		  verf:String,
		  errorscode:String,
		  errors:Object,
	 },setup(){
		 
		 const page = usePage()

		 const form = reactive({
				email: '',
				password: '',
				   _token: page.props.csrf_token,
			 
			})
			return { form }
	 }, methods:{
	 
	 submit() {
		 
			 router.post('/user_login', this.form)
	}
	 
	
	
	
	
	
	 }
}
</script>

<template>
<AppLayout title="Dashboard">
    <div class="card-deck whContAll LoginPage">
			
			
			<div class="loginCont">
						<h6 class="error_val" v-if="errorscode">{{ errorscode }}</h6>
						<h6 class="error_val green" v-if="verf==1">
						{{ __("you_will_get_vertification_mail_login") }}
						</h6>
						<h2>{{ __("login") }}</h2>
					   <form @submit.prevent="submit">
										<div class="form-group">
											<label for="title"> {{ __("email") }}</label>
											<input id="title" class="form-control" v-model="form.email" />
											  <div v-if="errors.email">{{ errors.email }}</div>
										</div>
										
											<div class="form-group margZero">
											<label for="title">{{ __("password") }}</label>
											<input id="title" class="form-control" type="password" v-model="form.password" />
											  <div v-if="errors.password">{{ errors.password }}</div>
										</div>
										
										 <div class="col-md-12">
								<a class="forgetPass" href="/forgot-password">{{ __("forget_password") }}</a>						 
										 </div>
										 <div class="btmCont">
										<button  
										class="btn btn-primary"
										type="submit">{{ __("login") }}</button>
										</div>
							  </form>
							<div class="regisCont">
							<p>{{ __("do_u_have_account") }}</p>
							<a href="/register">{{ __("register") }}</a>
							</div>
				</div>	  
					  
	</div>
  </AppLayout>
</template>

 