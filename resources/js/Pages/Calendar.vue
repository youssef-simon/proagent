<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'; 
import { Modal } from 'usemodal-vue3'; 

</script>
<script>

 export default {
	 components: { 
		Modal,
	},
  data() {
    return {
	  successform:false,
	  isVisibleShow:false,
	  isVisible:false,
	  isModalBook:false,
	  loadstate:true,
	  chosed_event:0,
      message: 'Hello World!',
      monthdays: 'Hello World!',
      month:0,
      year: 0,
      selected_doctor: 1,
      fulldate: '',
      first_day_month: 0,
      dayevents: [],
      events: [ ],
      doctors: [ ],
	  	bookform:{
			first_name: '',
			last_name: '',
			email:'',
			phone: '',
			birth_date: '',
			notes: '',
			available_slot_id: 0,
			admin_id:this.$page.props.auth.user.id,
		},
		 showdata:{
			first_name: '',
			last_name: '',
			email:'',
			phone: '',
			birth_date: '',
			notes: '',
			id: 0,
		},
    }
  },

  created() {
	  
    this.month =  new Date().getMonth()+1;
    this.year = new Date().getFullYear();
	this.fetchData();
	this.fatchDocors();
	this.getFirstDayMonth();
   this.monthdays=this.getDaysInMonth(this.month,this.year);
  }
	, methods: {
		async  greet(day){
			  var day=this.year+"-"+this.month+"-"+day;
			  const self=this;
			    axios.get("http://127.0.0.1:8000/api/day_freeslots?day="+day+"&teacher="+this.selected_doctor)
					  .then( function(response) {
									self.dayevents = response.data.data;
									self.isVisible=true;	 
								 	
								}
							)
					  .catch(error => {
						console.error(error);
					  });
			  
			  
			  
			  
			  
			  
			  
			  
		  },
		  changeCalendar(){
			  
			  this.getFirstDayMonth();
			   
			  this.monthdays=this.getDaysInMonth(this.year ,this.month);
			  this.fetchData();
			  
		  },
		   bookNow(id){
			  this.isModalBook=true;
			  this.chosed_event=id;
			  this.bookform.available_slot_id=id;
				this.fetchData();
			  
		  },
		getDaysInMonth(year, month) {
			return new Date(year, month, 0).getDate();
		},
		getFirstDayMonth(){
			const d = new Date(this.month+"-1-"+this.year);
			this.first_day_month = d.getDay();

		}
	  ,
	      getArray() {
					  const array = [];
					  var ii=0;
					  array[0]=[];
					  array[1]=[];
					  array[2]=[];
					  array[3]=[]; 
					  array[4]=[]; 
					  array[5]=[];
					  
					  var iii=0
					  for (let i = 1; i <= 42; i++) {
						  
						  if(i>this.first_day_month ){
							  if(iii!=9999){
								iii=iii+ 1;
							  }
						  }
						  
						   if(this.monthdays<iii){
							   iii=9999;
						   }
						  if (array[ii]) {
							  var eventAvailable='';
							  var eventReserved='';
								this.events.available.forEach(function(event) {
									 if(event.day==iii ){
										 eventAvailable=event;
									 }
								});
								
								this.events.reserved.forEach(function(event) {
									 if(event.day==iii ){
										 eventReserved=event;
									 }
								});
								
								array[ii].push({'row':i,'day':iii,'event_available':eventAvailable ,'event_reserved':eventReserved });
						  }
						  
						    if(i%7==0){
							  
							 ii= ii+1;
						  }
					  }
					  return array;
			},
			async fetchData() {
				this.fulldate=   this.year+"-"+this.month; 
			 
				  var self = this;
				   axios.get("http://127.0.0.1:8000/api/all_calendar_slots?month="+this.month+"&year="+this.year+"&teacher="+this.selected_doctor)
					  .then( function(response) {
											const getData =response.data.data;
											 
											self.events = getData;
											 
									}
							)
					  .catch(error => {
						console.error(error);
					  });
			  
				
				
				
				
				
				
				
				
      
			} ,
			 async fatchDocors() { 
					 var self = this;
					 axios.get("http://127.0.0.1:8000/api/teachers")
					  .then( function(response) {
									console.log('fff');
									console.log(response.data.data);
									 console.log('fff');
								 	self.doctors=response.data.data;
								  
								}
							)
					  .catch(error => {
						console.error(error);
					  });
		  
				}  ,
			 async okfn() { 
			  var self = this;
			  
			   axios.post("http://127.0.0.1:8000/api/admin_reserve_slot",this.bookform)
					  .then( function(response) {
										self.isModalBook=false; 
										self.successform=true;
								 }
							)
					  .catch(error => {
						console.error(error);
					  });
					 
					  
					// const user = await fetchWrapper.post('http://127.0.0.1:8000/api/logincode', { email, password });
					
		  
				},
				
				async viewDetailsRes(id){
							 
						  const self=this;
			 this.isVisibleShow=true;
					  axios.get('http://127.0.0.1:8000/api/reserve_details/'+id)
					  .then( function(response) {
									var getData =response.data.data;
									 
									 self.showdata.first_name= getData.first_name;
									 self.showdata.last_name= getData.last_name;
									 self.showdata.email= getData.email;
									 self.showdata.notes= getData.notes;
									 self.showdata.phone= getData.phone;
									 self.showdata.birth_date= getData.birth_date;
									 self.showdata.id= getData.id;
									   
								}
							)
					  .catch(error => {
						console.error(error);
					  });
			 
					 
				}
				,onUnVisible(){
						//this.successform=false;
				 }	
			} 
			
  }
  
</script> 
<template>
<AppLayout title="Dashboard">
   <div class="card">
   
  <div class="card-header">
                <h3 class="card-title">calendar</h3>
              </div>
		









<div>
  	<div class="filterCont">
				<div class="row">
						
							<div class="col-md-3 form-group">
								<label>Month</label>
								<select class="form-control rounded-3" v-model="month">
									<option>1</option>
									<option>2</option>
									<option>3</option>
									
									<option>4</option>
									<option>5</option>
									<option>6</option>
									
									<option>7</option>
									<option>8</option>
									<option>9</option>
									
									<option>10</option>
									<option>11</option>
									<option>12</option>
								</select>
							</div>
							<div class="col-md-3">
							<label>year</label>
								<select class="form-control rounded-3" v-model="year">
									<option>2023</option>
									<option>2024</option>
									<option>2025</option>
									<option>2026</option>
									<option>2027</option>
								</select> 
							</div>
							<div class="col-md-3">
							<label>Doctors</label>
								<select v-model="selected_doctor" class="form-control rounded-3">
									  	<option  v-for="(doctor, indexe) in doctors" :value="doctor.id" :key="indexe">
												  {{ doctor.full_name }} 
									 	</option>
								</select> 
							</div>
							<div class="col-md-3 txtCenter ">
								<button class="btn btn-primary goSubmit" @click="changeCalendar()">submit</button>
							</div>
						
				</div>
				</div>
				
					 
					<h1 class="txtCenter">{{ fulldate }}</h1>
					<table  class="table table-sm table-bordered">
					<tbody>
					<tr>
						<td> Sunday </td>
						<td> Monday </td>
						<td> Tuesday </td>
						<td> Wednesday </td>
						<td> Thursday </td>
						<td> Friday </td>
						<td> Saturday </td>
					</tr>
					  <tr v-for="(items, index) in getArray()" :key="index">
							<td v-for="(item, indexa) in items" :key="index">
							 
							  <br>
							  <span v-if="item.day!=0 && item.day!=9999">
							  {{ item.day }}
							  </span>
							  <br>
							  
									   <a class="badge rounded-pill bg-primary" v-if="item.event_available" @click="greet(item.event_available.day)" href="javascript:void(0)"> {{ item.event_available.count }} available slots</a>
									   <br>
									   <a class="badge rounded-pill bg-danger" v-if="item.event_reserved" @click="greet(item.event_reserved.day)" href="javascript:void(0)"> {{ item.event_reserved.count }} reserved slots</a>
							  
							</td>
						</tr>
						</tbody>
					</table> 	
					<Modal v-model:visible="isVisible" title="Avaible slots" width="800px">
						<div class="avaibleAppoin bookmodal">
								<ul>
									<li  v-for="(event, indexe) in dayevents" :key="indexe">
									
									    <div class="row" style="margin-bottom:20px;"> 
											<div class="col-md-8"> 
												{{ event.from_time }} - {{ event.to_time }} - {{ event.notes }}
											</div>
											 <div class="col-md-4"> 
											 
												<button v-if="event.reserved==1" @click="bookNow(event.id)" class="btn btn-danger" disabled >Reserved</button>
												<button v-if="event.reserved==1" @click="viewDetailsRes(event.id)" class="btn btn-danger" >view Details</button>
												<button v-if="event.reserved==0" @click="bookNow(event.id)" class="btn btn-primary" >Book Now</button>
											 </div>
										 </div>
										 
									</li>
								</ul>
						</div>
					</Modal>	


					<Modal v-model:visible="isModalBook"  v-bind:loadstate="loadstate" title="Book Now"
						 @onUnVisible="onUnVisible"
						 v-bind:okButton="{
							onclick: okfn,
							loading: loadstate
						  }"
					>
					
				 <div  v-if="successform==false"  class="avaibleAppoin">
						
							<ul>
									<template  v-for="(event, indexe) in dayevents" :key="indexe">
											<li  v-if="chosed_event==event.id"  >
											
												<div class="row"> 
													<div class="col-md-12"> 
														{{ event.from_time }} - {{ event.to_time }} - {{ event.notes }}
													</div>
													 
												 </div>
												 
											</li>
									</template>
								</ul>
				    <div> 
		<div  class="col-md-12 form-group">
											 <label>First Name</label>
											 <input v-model="bookform.first_name" type="text" class="form-control" />
										</div>
								
										<div class="col-md-12 form-group">
											 <label>Last Name</label>
											 <input v-model="bookform.last_name" type="text" class="form-control" />
										</div>
								
								
										<div class="col-md-12 form-group">
											 <label>Email</label>
											 <input  v-model="bookform.email" type="text" class="form-control" />
										</div>
							
										<div class="col-md-12 form-group">
											 <label>Phone</label>
											 <input v-model="bookform.phone" type="text" class="form-control" />
										</div>
										
										 <div class="col-md-12 form-group">
											 <label>birth_date</label>
											 <input v-model="bookform.birth_date" type="date" class="form-control" />
										</div>
										
										
										 <div class="col-md-12 form-group">
											 <label>Notes</label>
											 
											 <textarea  v-model="bookform.notes" class="form-control"></textarea>
										</div>
										<input  v-model="bookform.available_slot_id"  type="hidden" />
										<input  v-model="bookform.admin_id"    type="hidden" />
	
	</div>
								
						</div>
						
								 <div  v-if="successform==true"  class="avaibleAppoin alert alert-success alert-dismissible fade show">
										<p>your reservation is succeded</p>
										<br>
										<p>code : oooo</p>
										
										<p>cancelationcode:3333</p>
								 </div>
					</Modal>	



		<Modal v-model:visible="successform"  title="Book Now"
						 @onUnVisible="onUnVisible"
						  
					>
			 
						
								 <div  v-if="successform==true"  class="avaibleAppoin alert alert-success alert-dismissible fade show">
										<p>your reservation is succeded</p>
										<br>
										<p>code : oooo</p>
										
										<p>cancelationcode:3333</p>
								 </div>
					</Modal>					
	 
	
	
	
	
	
	
	
	
     <Modal v-model:visible="isVisibleShow"   	
		title="Reserve slot"
		onUnVisible="onUnVisible"
		 
	  
	  >
						<div> 
							<div class="col-md-12 form-group">
																 <label>First Name</label>
																 <p>{{ showdata.first_name }}</p>
															</div>
													
															<div class="col-md-12 form-group">
																 <label>Last Name</label>
																 <p>{{ showdata.last_name }}</p>
															</div>
													
													
															<div class="col-md-12 form-group">
																 <label>Email</label>
																  <p>{{ showdata.last_name }}</p>
															</div>
												
															<div class="col-md-12 form-group">
																 <label>Phone</label>
																  <p>{{ showdata.last_name }}</p>
															</div>
															
															 <div class="col-md-12 form-group">
																 <label>birth_date</label>
																  <p>{{ showdata.last_name }}</p>
															</div>
															
															
															 <div class="col-md-12 form-group">
																 <label>Notes</label>
																  <p>{{ showdata.last_name }}</p>
															</div>
						
						</div>
</Modal>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
</div>


		
    </div>
	  
	 
  </AppLayout>
</template>
 