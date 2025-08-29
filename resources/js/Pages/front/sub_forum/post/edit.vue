<script   lang="ts">
import AppLayout from '@/layouts/AppFrontLayout.vue';

import { Head } from '@inertiajs/vue3';

import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import axios from 'axios';

import { Editor, EditorContent } from '@tiptap/vue-3'

import StarterKit from '@tiptap/starter-kit'
import Highlight from '@tiptap/extension-highlight'




export default{
	components:{
		AppLayout,reactive,router,EditorContent
	 }
	  ,
	   data() {
					return {
						submit_form:false ,
				   	filter:{
							subjects:[]
						},
						   editor: null,
					}
		  } 
	 
	 ,props:{
			categories:Object,
		 
			post:Object,
			errors:Object
	 },setup(props){
		 const form = reactive({ 
				title:props.post.title, 
				description: props.post.description,  
				category_id: props.post.category_id, 
				subject_id: props.post.subject_id, 
				imgfields: props.post.images,
				filefields: props.post.files
			});
			
			const post = props.post;
			return { form,post }
	 }, methods:{
	 
	 submit() {
		  
	 this.form.description=this.editor.getHTML();
	 console.log( this.form.imgfields);
	 
	 
	  router.post(route('post.update',this.post.id), this.form, {
															onProgress: () => (this.submit_form=true),
															  onError: () =>(this.submit_form=false),

														});  
		},
		changeCat(){
		 
				 var self=this;
				 
				 axios.get("/getsubjectbycat/"+this.form.category_id)
									  .then( function(response) {
												//self.form.systems=response.data; 
													self.filter.subjects=response.data;  
												}
											)
									  .catch(error => {
										console.error(error);
									  });  
				 
			 },
	 
            uploadMulitImage(event, index) {
                var self = this;
                // this.form.refields[index].img="Ddd";

                const URL = '/uploadimgforum';

			if(event.target.files[0].size > 2097152) {
				   alert("ملف كبير");
				   return false;
				 }



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
                    console.log(self.form.imgfields[index].img);
						//let result = response.data.path.replace("public", "storage");
                    self.form.imgfields[index].original_name =  response.data.original_name;
                    self.form.imgfields[index].path =  response.data.path;
                    self.form.imgfields[index].image_show =  response.data.pathshow;
				 
                    return true;

                }
                )
            } ,AddField: function () {
                this.form.imgfields.push({
                    title: '',
                    img: '',
                 //   img_id: 0,

                });

            }, removeField: function (index) {
                this.form.imgfields.splice(index, 1);
            } 
			,
			  getFileIcon(fileType) {
    if (!fileType) return 'fas fa-file';
    
    const type = fileType.split('/')[0];
    const subtype = fileType.split('/')[1];
    
    switch(type) {
      case 'image':
        return 'fas fa-file-image';
      case 'audio':
        return 'fas fa-file-audio';
      case 'video':
        return 'fas fa-file-video';
      case 'application':
        if (subtype.includes('pdf')) return 'fas fa-file-pdf';
        if (subtype.includes('msword') || subtype.includes('wordprocessing')) return 'fas fa-file-word';
        if (subtype.includes('spreadsheet')) return 'fas fa-file-excel';
        if (subtype.includes('presentation')) return 'fas fa-file-powerpoint';
        if (subtype.includes('zip')) return 'fas fa-file-archive';
        return 'fas fa-file-code';
      case 'text':
        return 'fas fa-file-alt';
      default:
        return 'fas fa-file';
    }
  },
  
  formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
  },
  
  uploadFile(event, index) {
	   
	        var self = this;
                // this.form.refields[index].img="Ddd";

				this.showload=true;

                const URL = '/uploadfileforum';

                let data = new FormData();
                data.append('name', 'my-picture');
                data.append('file', event.target.files[0]);

                let config = {
                    header: {
                        'Content-Type': 'multipart/form-data'
                    }
                };

                axios.post(URL,data,config).then(function (response) { 
				 
                    self.form.filefields[index].original_name =  response.data.file_name;
                    self.form.filefields[index].path =  response.data.path;
                    self.form.filefields[index].filepathshow =  response.data.pathshow;
                    self.form.filefields[index].filetype =  response.data.filetype;
				 
								return true; 
					}
                )
     
  },
  
  addFileField() {
	  
    this.form.filefields.push({
      filename: '',
      filetype: '',
      filesize: 0,
      filepath: '',
      file_id: '',
      file: null
    });
  },
  
  removeFileField(index) {
    this.form.filefields.splice(index, 1);
  }
			
			
	 },created(){ 
		 this.changeCat();
		 
		 
		  this.editor = new Editor({
      extensions: [
        StarterKit,
        Highlight
      ],
      content: this.form.description,
    });
	
	console.log(this.editor);
	 }
	 ,  
    beforeUnmount() {
       this.editor.destroy();
    },
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
}
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
    <div class="w-full mx-auto">
	
	
		
	<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
  <div class="w-full mx-auto bg-white rounded-xl shadow-md overflow-hidden   p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">{{ __("edit_post") }}</h2>
   <form class="space-y-6" @submit.prevent="submit"> 
      <div>
        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">{{ __("title") }}</label>
        <input 
          type="text" 
          id="title" 
          name="title" 
          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
          placeholder="Enter title"
		  v-model="form.title"
        >
      </div>
      
  
	 
	 <label for="title" class="block text-sm font-medium text-gray-700 mb-1">{{ __("body") }}</label>
	       
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
         
        </div>
      
	   
	  
	  
	  <div>
	  
	  
	  	
			  
			           <div class="p-4 bg-white rounded-lg shadow-sm">
  <h3 class="text-lg font-medium text-gray-800 mb-4">{{ __("image_gallery") }}</h3>
  
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    <!-- Image Upload Cards -->
    <div v-for="(field, index) in form.imgfields" :key="index" class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow duration-200">
      <div class="p-3 flex flex-col h-full">
        <!-- Image Preview -->
        <div class="relative aspect-square bg-gray-100 rounded-md mb-3 flex items-center justify-center overflow-hidden">
        
		<img v-if="field.image_show"
            :src="field.image_show || 'https://via.placeholder.com/300x200?text=Upload+Image'" 
            class="object-cover w-full h-full"
            :alt="'Uploaded image ' + (index + 1)"
          >
		   <div v-if="!field.image_show" class="text-center p-4"><i class="fas fa-file text-4xl text-gray-500 mb-2"></i><p class="text-gray-700 font-medium text-sm truncate w-full"> {{ __("no_file_selected") }}</p><!--v-if--></div>
        </div>
        
        <!-- Upload Button -->
        <label 
          :for="'mfile-input'+index" 
          class="inline-flex items-center justify-center px-3 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 cursor-pointer mb-2"
        >
          <i class="fas fa-upload mr-2 text-gray-500"></i>
          {{ field.imagepathshow ? 'Change' : 'Upload' }}
        </label>
        <input 
          type="file" 
          class="hidden" 
          accept="image/*" 
          @change="uploadMulitImage($event,index)" 
          :id="'mfile-input'+index"
        >
        
        <!-- Hidden ID Field -->
        <input type="hidden" v-model="field.img_id">
        
        <!-- Remove Button -->
        <button 
          @click="removeField(index)" 
          class="mt-auto inline-flex items-center justify-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
        >
          <i class="fas fa-trash mr-2"></i>
          Remove
        </button>
      </div>
    </div>
    
    <!-- Add New Image Button -->
    <div 
      @click="AddField" 
      class="border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center cursor-pointer hover:border-gray-400 transition-colors duration-200 aspect-square"
    >
      <div class="text-center p-4">
        <i class="fas fa-plus-circle text-3xl text-gray-400 mb-2"></i>
        <p class="text-gray-500 font-medium">{{ __("add_image") }}</p>
      </div>
    </div>
  </div>
</div>











<div class="p-4 bg-white rounded-lg shadow-sm">
  <h3 class="text-lg font-medium text-gray-800 mb-4">{{ __("files") }}</h3>
  
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    <!-- File Upload Cards -->
    <div v-for="(field, index) in form.filefields" :key="index" class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow duration-200">
      <div class="p-3 flex flex-col h-full">
        <!-- File Preview -->
        <div class="relative aspect-square bg-gray-100 rounded-md mb-3 flex items-center justify-center overflow-hidden">
          <div class="text-center p-4">
            <i :class="getFileIcon(field.filetype) + ' text-4xl text-gray-500 mb-2'"></i>
            <p class="text-gray-700 font-medium text-sm truncate w-full">{{ field.original_name ||   __("no_file_selected")  }}</p>
            <p v-if="field.filesize" class="text-gray-500 text-xs">{{ formatFileSize(field.filesize) }}</p>
          </div>
        </div>
        
        <!-- Upload Button -->
        <label 
          :for="'file-input'+index" 
          class="inline-flex items-center justify-center px-3 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 cursor-pointer mb-2"
        >
          <i class="fas fa-upload mr-2 text-gray-500"></i>
          {{ field.filepath ? 'Change' : 'Upload' }}
        </label>
        <input 
          type="file" 
          class="hidden" 
          @change="uploadFile($event, index)" 
          :id="'file-input'+index"
        >
         
        
        <!-- Remove Button -->
        <button 
          @click="removeFileField(index)" 
          class="mt-auto inline-flex items-center justify-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
        >
          <i class="fas fa-trash mr-2"></i>
          Remove
        </button>
      </div>
    </div>
    
    <!-- Add New File Button -->
    <div 
      @click="addFileField" 
      class="border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center cursor-pointer hover:border-gray-400 transition-colors duration-200 aspect-square"
    >
      <div class="text-center p-4">
        <i class="fas fa-plus-circle text-3xl text-gray-400 mb-2"></i>
        <p class="text-gray-500 font-medium">{{  __("add_file")  }}</p>
      </div>
    </div>
  </div>
</div>











				
	  
	  </div>
	  
      <div>
        <button 
          type="submit" 
		  v-if="submit_form==false"
          class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        >
          Submit
        </button>
		
		
		<button 
          type="submit" 
		  v-if="submit_form==true"
          class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        >
          Submit
        </button>
      </div>
    </form>
  </div>
</div>
		
		
		
		
		
    </div>
    </AppLayout>
</template>
