<script>
import AppLayout from '@/Layouts/AppFrontLayout.vue';
 
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import SideMenu from '@/Pages/front/Comp/SideMenu.vue';
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';




import { Editor, EditorContent } from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit' 

import Highlight from '@tiptap/extension-highlight'




export default{
	components:{
		AppLayout,reactive,router,SideMenu,QuillEditor,EditorContent
	 }  ,
	   data() {
					return {
						submit_form:false  , 
						 editor: null,
					}
		  } 
	 ,props:{
		  userproject:Object,  
		  userProjectImageArr:Object,
		  errors:Object
	 },setup(props){ 
		 const form = reactive({ 
			    title:  props.userproject.title , 
				description:  props.userproject.description ,
				
				
				imgfields:  props.userProjectImageArr ,
				imagpath:  props.userproject.imagpath ,
				imagpathshow:  props.userproject.image_path_show ,
			 })
			const userproject=props.userproject;
			return { form ,userproject }
	 }, methods:{
			  submit() {
				  
				    this.form.description=this.editor.getHTML(); 
				     router.post('/update_work/'+this.userproject.id, this.form)
			  }
			  
			  
			  /***************************/
		
		, uploadImage(event, index) {
                var self = this;
                // this.form.refields[index].img="Ddd";

						if(event.target.files[0].size > 3297152) {
						   alert("file should not be bigger then 3MB");
						   return false;
				 }





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
								 //let result = response.data.path.replace("public", "storage");
								self.form.imagpathshow =  response.data.pathshow;
								self.form.imagpath =  response.data.path;
								self.form.main_image_id = response.data.img_id;
								return true; 
					}
                )
            }, 	   
            uploadMulitImage(event, index) {
                var self = this;
                // this.form.refields[index].img="Ddd";



					if(event.target.files[0].size > 3297152) {
						   alert("file should not be bigger then 3MB");
						   return false;
				 }


                const URL = '/api/uploadimg';


                let data = new FormData();
                data.append('name', 'my-picture');
                data.append('file', event.target.files[0]);

                let config = {
                    header: {
                        'Content-Type': 'multipart/form-data'
                    }
                };

                axios.post(
                        URL,
                        data,
                        config
                        ).then(function (response) {
								self.form.imgfields[index].path =  response.data.path;
								self.form.imgfields[index].imagpathshow =  response.data.pathshow;
							 
								self.form.imgfields[index].img_id = response.data.img_id;
								return true;

                }
                )
            } 
			
			
			
			
			 ,AddField: function () {
                this.form.imgfields.push({
                    title: '',
                    img: '',
                    img_id: 0,

                });

            }, removeField: function (index) {
                this.form.imgfields.splice(index, 1);
            }
			
			
			
	 },
		/***************************/
					created() {
							  this.editor = new Editor({
							  extensions: [
								StarterKit,
								Highlight
							  ],
							 content: this.form.description,
							});
							
							console.log(this.editor);
					}, 
					beforeUnmount() {
					   this.editor.destroy();
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
	
     <h2>{{ __("edit_prev_project") }}</h2>
			  
			   					
<div class="refusedReasonCont col-md-6">
	<p>
	{{ userproject.reason }}
	</p>
</div>	
 
 
 
 	
	 <form @submit.prevent="submit">
      <div class="col-md-9">
      
            <div class="formCont">
              <div class="form-group">
					  <label for="title">{{ __("title") }}</label>
				 	  <input id="title" class="form-control" v-model="form.title" />
					 <div class="error_val" v-if="errors.title">{{ errors.title }}</div>
			   </div>
			   
			   
			    
                
 
	          <label for="title" class="block text-sm font-medium text-gray-700 mb-1">{{ __("description") }}</label>
        <!-- شريط الأدوات المحسن -->
        <div class="toolbar flex flex-wrap gap-2 p-3 border border-gray-300 rounded-t-lg bg-gray-50">
            <!-- Text Formatting -->
            <button type="button"
                @click="editor.chain().focus().toggleBold().run()" 
                :disabled="!editor.can().chain().focus().toggleBold().run()" 
                :class="{ 'is-active': editor.isActive('bold') }"
                class="toolbar-btn p-2 text-gray-700 rounded hover:bg-gray-200 disabled:opacity-50 disabled:cursor-not-allowed"
                title="عريض"
            >
                <i class="fa-solid fa-bold"></i>
            </button>
            
            <button type="button"
                @click="editor.chain().focus().toggleItalic().run()" 
                :disabled="!editor.can().chain().focus().toggleItalic().run()" 
                :class="{ 'is-active': editor.isActive('italic') }"
                class="toolbar-btn p-2 text-gray-700 rounded hover:bg-gray-200 disabled:opacity-50 disabled:cursor-not-allowed"
                title="مائل"
            >
                <i class="fa-solid fa-italic"></i>
            </button>
            
            <button type="button"
                @click="editor.chain().focus().toggleStrike().run()" 
                :disabled="!editor.can().chain().focus().toggleStrike().run()" 
                :class="{ 'is-active': editor.isActive('strike') }"
                class="toolbar-btn p-2 text-gray-700 rounded hover:bg-gray-200 disabled:opacity-50 disabled:cursor-not-allowed"
                title="يتوسطه خط"
            >
                <i class="fa-solid fa-strikethrough"></i>
            </button>
            
            <div class="border-r border-gray-300 h-6 my-auto"></div>
            
            <!-- Headings -->
            <button type="button"
                @click="editor.chain().focus().toggleHeading({ level: 1 }).run()" 
                :class="{ 'is-active': editor.isActive('heading', { level: 1 }) }"
                class="toolbar-btn p-2 text-gray-700 rounded hover:bg-gray-200"
                title="عنوان رئيسي"
            >
                <i class="fa-solid fa-heading"></i> 1
            </button>
            
            <button type="button"
                @click="editor.chain().focus().toggleHeading({ level: 2 }).run()" 
                :class="{ 'is-active': editor.isActive('heading', { level: 2 }) }"
                class="toolbar-btn p-2 text-gray-700 rounded hover:bg-gray-200"
                title="عنوان فرعي"
            >
                <i class="fa-solid fa-heading"></i> 2
            </button>
            
            <div class="border-r border-gray-300 h-6 my-auto"></div>
            
            <!-- Lists -->
            <button type="button"
                @click="editor.chain().focus().toggleBulletList().run()" 
                :class="{ 'is-active': editor.isActive('bulletList') }"
                class="toolbar-btn p-2 text-gray-700 rounded hover:bg-gray-200"
                title="قائمة نقطية"
            >
                <i class="fa-solid fa-list-ul"></i>
            </button>
            
            <button type="button"
                @click="editor.chain().focus().toggleOrderedList().run()" 
                :class="{ 'is-active': editor.isActive('orderedList') }"
                class="toolbar-btn p-2 text-gray-700 rounded hover:bg-gray-200"
                title="قائمة رقمية"
            >
                <i class="fa-solid fa-list-ol"></i>
            </button>
            
            <div class="border-r border-gray-300 h-6 my-auto"></div>
            
            <!-- Other controls -->
            <button type="button"
                @click="editor.chain().focus().setHorizontalRule().run()" 
                class="toolbar-btn p-2 text-gray-700 rounded hover:bg-gray-200"
                title="خط أفقي"
            >
                <i class="fa-solid fa-ruler-horizontal"></i>
            </button>
            
            <button type="button"
                @click="editor.chain().focus().toggleHighlight().run()" 
                :class="{ 'is-active': editor.isActive('highlight') }"
                class="toolbar-btn p-2 text-gray-700 rounded hover:bg-gray-200 disabled:opacity-50 disabled:cursor-not-allowed"
                title="تمييز"
            >
                <i class="fa-solid fa-highlighter"></i>
            </button>
            
            <div class="border-r border-gray-300 h-6 my-auto"></div>
            
            <button type="button"
                @click="editor.chain().focus().undo().run()" 
                :disabled="!editor.can().chain().focus().undo().run()"
                class="toolbar-btn p-2 text-gray-700 rounded hover:bg-gray-200 disabled:opacity-50 disabled:cursor-not-allowed"
                title="تراجع"
            >
                <i class="fa-solid fa-rotate-left"></i>
            </button>
            
            <button type="button"
                @click="editor.chain().focus().redo().run()" 
                :disabled="!editor.can().chain().focus().redo().run()"
                class="toolbar-btn p-2 text-gray-700 rounded hover:bg-gray-200 disabled:opacity-50 disabled:cursor-not-allowed"
                title="إعادة"
            >
                <i class="fa-solid fa-rotate-right"></i>
            </button>
        </div>
        
        <!-- منطقة المحرر -->
        <div class="editor-container border border-gray-300 border-t-0 rounded-b-lg bg-white">
            <editor-content :editor="editor" class="block p-4 min-h-[200px] prose max-w-none" />
        </div>
        
        <!-- معلومات إضافية -->
        <div class="mt-3 text-xs text-gray-500 flex justify-between">
            <div>يدعم التنسيق المتقدم والوسائط</div>
            <div> </div>
        </div>
			    
			   
			   
			   
			 
			   
			   
				
				 
					
					
					
					
					 <div class="repeater col-md-12 p15">
                       <h3>{{ __("main_image") }}</h3>
									<p class="descPhoto">Max 2MB</p>
                        <div class="row">
                            <div class="col-md-12" >
                                <div class="control-group w-100 imgUploadCont">
                                     <label for="file-input">
									 <i class="fa fa-image"></i>
									 {{ __("upload_image") }}
									 
									 </label>
                                    <input type="file" class="imgfile" accept="image/*" @change="uploadImage($event,index)" id="file-input">
                                  
                                    <img :src="form.imagpathshow" />
                                </div>
                            </div>
                        </div>  
                    </div>

			  
			  

				
				
				
				          <div class="repeater col-md-12 p15">
                     <h3>{{ __("other_images") }}</h3>
                        <div class="borders" v-for="(field, index) in form.imgfields">
                            <div class="row">
                                <div class="col-md-12" >
                                    <div class="control-group w-100 imgUploadCont">
                                           <label :for="'mfile-input'+index"> 
										   <i class="fa fa-image"></i>
												 {{ __("upload_image") }}
											</label>
                                        <input type="file" class="imgfile" accept="image/*" @change="uploadMulitImage($event,index)" :id="'mfile-input'+index">
                                     
                                        <img :src="field.imagpathshow" />
                                    </div>
                                </div>
                              
                                <div class="col-md-12">
                                    <a @click="removeField(index)" href="javascript:void(0)" class="removeField btn btn-danger col-md-12"><span class="icon trash-icon"></span>
                                        Remove
                                    </a>
                                </div>
                            </div>
                        </div>
                        <a href="javascript:void(0)" @click="AddField" class="btn btn-dark text-white  col-md-12 addField">ADD</a>
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

 