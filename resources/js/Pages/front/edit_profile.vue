<script>
import AppLayout from '@/Layouts/AppFrontLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import SideMenu from '@/Pages/front/Comp/SideMenu.vue';

import Multiselect from '@vueform/multiselect'
 
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import VuePictureCropper, { cropper } from 'vue-picture-cropper'
import { Modal } from 'usemodal-vue3'; 

export default{
	components:{
		AppLayout
		,reactive
		,router
		,SideMenu
		,QuillEditor
		,Multiselect
		,VuePictureCropper
		,Modal
	 },
	 
	 
	   data() {
		return {
			 editPic: false,
		 
			 
     }
  } 
	 ,props:{
		  	  serviceCats:Object,
			  userCategories:Object,
			  departments:Object,
			  tagsInput:Object,
			  user:Object,
			  errors:Object,
	 },setup(props){
		 const form = reactive({
						first_name: props.user.first_name,
						last_name: props.user.last_name,
						work_title: props.user.work_title,
						small_bio: props.user.small_bio,
						email: props.user.email, 
						phone: props.user.phone,  
						biograph: props.user.biograph,  
						image_blob: '',  
						  
						
						imagpath:  props.user.imagpath ,
						imagpathshow:  props.user.image_path_show ,
						main_image_id: props.user.main_image_id,
						 user_categories: props.userCategories,
						 tags:props.tagsInput,
			}) ;
			
		const	result = reactive({
      dataURL: '',
      blobURL: '',
    })
			const user = props.user ;
			
			 
			const options=[
					{"name":"d","code":1}
			,	{"name":"ddd","code":2}
			,	{"name":"dww","code":3}
			];
			
			const value=[];
			return { form,user,options,value,result }
	 }, 
    
  methods:{
 
			addTag (newTag) { 
			  const tag = {
				name: newTag,
				code: Math.floor((Math.random() * 10000000))
			  }
			  this.options.push(tag)
			  this.form.tags.push(tag)
			},
			 submit() {
				 console.log();
					 router.post('/update_profile', this.form)
			}
			
			
				, uploadImage(event, index) {
                var self = this;
                // this.form.refields[index].img="Ddd";

                const URL = '/api/uploadimg';

                let data = new FormData();
                data.append('name', 'my-picture');
                data.append('file', event.target.files[0]);

                let config = {
                    header: {
                        'Content-Type': 'multipart/form-data'
                    }
                };

                axios.post(URL,data,config).then(function (response) { 
							 	self.form.imagpathshow =  response.data.pathshow;
								self.form.imagpath =  response.data.path;
							//	self.form.main_image_id = response.data.img_id;
								return true; 
					}
                )
            }
			  ,async fetchTags(query){
					  const response = await fetch('/search_tags?term=' + query);
					  const dataa = await response.json();; // Here you have the data that you need
	 
					  return dataa.data.map((item) => {
						return { value: item.id, label: item.name }
					  });
					},	 		
				async  getResult() {
				  if (!cropper) return
				  const base64 = cropper.getDataURL()
				  const blob = await cropper.getBlob();
				  if (!blob) return;

				  const file = await cropper.getFile({
					fileName:"F",
				  });

				  console.log({ base64, blob, file });
				  this.result.dataURL = base64;
				  this.form.image_blob = base64;
				  this.form.imagpathshow = base64;
				   this.result.blobURL = URL.createObjectURL(blob);
				//  isShowModal.value = false
					this.editPic=false;
				},showEditPic(){
					this.editPic=true;
				}

			
			
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
					 <div class="card">
			 
    <div class="content">
	
	 <form @submit.prevent="submit">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
          
            <div class="card-body">
              <div class="form-group">
					  <label for="name">  first_name:</label>
					<input id="first_name" class="form-control" v-model="form.first_name" />
              </div>
			  <div class="form-group">
					  <label for="name">  last_name:</label>
					<input id="last_name" class="form-control" v-model="form.last_name" />
              </div>
			   <div class="form-group">
					  <label for="name">  work_title:</label>
					<input id="work_title" class="form-control" v-model="form.work_title" />
              </div>
			  
			 <div class="form-group">
					  <label for="name">small_bio:</label>
					<textarea id="small_bio" class="form-control" v-model="form.small_bio"  ></textarea>
              </div>
			  
			    <div class="form-group">
					  <label for="name">biograph:</label>
				 
						  <QuillEditor v-model:content="form.biograph"  id="biograph" class="form-control txtEdior"  contentType="html"  theme="snow" /> 
					   
              </div>
              <div class="form-group">
					<p>{{ user.email }}</p>
              </div>
			  
			    <div class="form-group">
					<label for="phone">phone:</label>
					<input id="phone" class="form-control" v-model="form.phone" />
				  <div v-if="errors.phone">{{ errors.phone }}</div>
              </div>
			  
            
			  
			  
 
					 <div class="form-group">
								  <label for="name">  Tags:</label>
								<Multiselect
						 
						  placeholder="Choose or Write Tags"
						    mode="tags"
						  :filter-results="false"
						  :min-chars="1"
						    :object="true" 
						  :delay="0"
						 v-model="form.tags" 
						 
						   :create-option="true"
							:close-on-select="false"
  
						  :searchable="true"
						  :options="async function(query) {
							return await fetchTags(query)  
						  }"
						/>	
					</div>
			  
			  
			  <div class="repeater col-md-12 p15">
                        <h3>photo</h3> 
                        <div class="row">
                            <div class="col-md-12" >
                                <div class="control-group w-100">
                                     
                                   
                                   
											<div class="row">
													<div class="col-md-12">
														    <img :src="form.imagpathshow" />
												</div>
									  
											<a class="btn btn-primary" @click="showEditPic" href="javascript::void(0)">change image</a>
											<section class="section" v-if="result.dataURL && result.blobURL">
														   <div class="preview">
																<img :src="result.dataURL" />
															  </div>
															   
											</section>
  		
                                </div>
                            </div>
                        </div>  
                    </div>
			 
			 
			    <button   class="btn btn-success float-right col-md-12" type="submit">Save</button>
  
  
  
   	<Modal v-model:visible="editPic"
	v-bind:okButton="{ 
	onclick: getResult
	,text :'Crop'
	
	}"  >
								<div class="row">
									 <div class="col-md-12">
									 		<VuePictureCropper
																			 
																			:img="form.imagpathshow"
																		   
																			
																			:options="{
																			  viewMode: 1,
																			  dragMode: 'move',
																			  aspectRatio: 1,
																			  cropBoxResizable: false,
																			}"
																			:presetMode="{
																			  mode: 'fixedSize',
																			  width: 250,
																			  height: 250,
																			}"
																			@ready="ready"
																		  />
																		   
													</div>
									</div>
									<label>Upload Image</label>
									<br>
								   <input type="file" accept="image/*" @change="uploadImage($event,index)" id="file-input" />
								 
								 	 <div class="form-group">
		 	<a  @click="getResult"  class="btn btn-primary" href="javascript::void(0)">Crop</a>
			  </div>
							</Modal>	
			  
			  
	 
  
  
  
  
  
  
  
  
  
		
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
       </div>
      
	
    </div>
		 </form> 	
			
			 
			
			
			
			
			
					</div>
			   </div>
			</div>  
	</div> 
	</div> 
  
   
  
  
  
  
  
   
  </AppLayout>
</template>

 