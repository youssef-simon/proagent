<script   lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import axios from 'axios';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];


export default{
	components:{
		AppLayout,reactive,router
	 }
	  ,
	   data() {
					return {
						submit_form:false ,
						filter:{
							subjects:[]
						}
					}
		  } 
	 
	 ,props:{
			categories:Object,
			errors:Object
	 },setup(){
		 const form = reactive({
		 
				title: '', 
				description: '', 
				category_id: '', 
				subject_id: '', 
				 imgfields: [],
				  filefields: [   ]
			})
			return { form }
	 }, methods:{
	 
	 submit() {
		  
		   router.post(route('post.store'), this.form, {
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

                const URL = '/uploadimg';

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
                    self.form.imgfields[index].image_path =  response.data.path;
                    self.form.imgfields[index].imagepathshow =  response.data.pathshow;
				 
                //    self.form.imgfields[index].img_id = response.data.img_id;
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

                const URL = '/uploadfile';

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
                    self.form.filefields[index].filepath =  response.data.path;
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
			
			
			
	 }
}
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
    <div class="w-full mx-auto">
	
	
		
	<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
  <div class="w-full mx-auto bg-white rounded-xl shadow-md overflow-hidden   p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Create Post</h2>
    <form class="space-y-6" @submit.prevent="submit"> 
      <div>
        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
        <input 
          type="text" 
          id="title" 
          name="title" 
          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
          placeholder="Enter title"
		  v-model="form.title"
        >
      </div>
      
      <div>
        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
        <textarea 
          id="description" 
          name="description" 
          rows="4" 
          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
          placeholder="Enter description"
		  
		  v-model="form.description"
        ></textarea>
      </div>
      
	    <div>
        <label for="categories" class="block text-sm font-medium text-gray-700 mb-1">categories</label>
		<select  @change="changeCat" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"  
		v-model="form.category_id">
				 <option v-for="serviceCategory in categories"    :value="serviceCategory.id">
														 {{ serviceCategory.title }}
												 </option> 
		</select>
          
      </div>
	  
	      <div>
        <label for="categories" class="block text-sm font-medium text-gray-700 mb-1">subjects</label>
		<select   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"   v-model="form.subject_id">
				 <option v-for="subjectItm in filter.subjects"    :value="subjectItm.id">
														 {{ subjectItm.title }}
												 </option> 
		</select>
          
      </div>
	  
	  
	  <div>
	  
	  
	  	
			  
			           <div class="p-4 bg-white rounded-lg shadow-sm">
  <h3 class="text-lg font-medium text-gray-800 mb-4">Image Gallery</h3>
  
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    <!-- Image Upload Cards -->
    <div v-for="(field, index) in form.imgfields" :key="index" class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow duration-200">
      <div class="p-3 flex flex-col h-full">
        <!-- Image Preview -->
        <div class="relative aspect-square bg-gray-100 rounded-md mb-3 flex items-center justify-center overflow-hidden">
          <img 
            :src="field.imagepathshow || 'https://via.placeholder.com/300x200?text=Upload+Image'" 
            class="object-cover w-full h-full"
            :alt="'Uploaded image ' + (index + 1)"
          >
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
        <p class="text-gray-500 font-medium">Add Image</p>
      </div>
    </div>
  </div>
</div>











<div class="p-4 bg-white rounded-lg shadow-sm">
  <h3 class="text-lg font-medium text-gray-800 mb-4">File Gallery</h3>
  
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    <!-- File Upload Cards -->
    <div v-for="(field, index) in form.filefields" :key="index" class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow duration-200">
      <div class="p-3 flex flex-col h-full">
        <!-- File Preview -->
        <div class="relative aspect-square bg-gray-100 rounded-md mb-3 flex items-center justify-center overflow-hidden">
          <div class="text-center p-4">
            <i :class="getFileIcon(field.filetype) + ' text-4xl text-gray-500 mb-2'"></i>
            <p class="text-gray-700 font-medium text-sm truncate w-full">{{ field.original_name || 'No file selected' }}</p>
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
        <p class="text-gray-500 font-medium">Add File</p>
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
