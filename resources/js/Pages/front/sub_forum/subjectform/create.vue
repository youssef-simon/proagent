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
			id:Object,
			subject:Object,
			postFields:Object,
			categories:Object,
			errors:Object
	 },setup(props){
		 const form = reactive({
		 
			 
				 formfields: props.postFields, 
			})
			return { form }
	 }, methods:{
	 
	 submit() {
		   router.post(route('subject_form.store',{id: this.id }), this.form, {
															onProgress: () => (this.submit_form=true),
															  onError: () =>(this.submit_form=false),

														});  
		},  
		 AddField: function () {
                this.form.formfields.push({
                    field_label: '',
                    field_type: '',
                    field_key: this.generateRandomNumberText(10),
                    field_options: [{
						option_text:''
					}  ]
                });

            }, removeField: function (index) {
                this.form.formfields.splice(index, 1);
            } ,
			addSubField: function (index) {
				 this.form.formfields[index].field_options.push({
                      option_text:''
				  });
				
			}, removeSubField: function (index,iindex) {
                this.form.formfields[index].field_options.splice(iindex, 1);
				} ,generateRandomNumberText(length) {
					  let result = '';
					  const characters = 'ewfewfqwewertyuixcvbnm0123456789';
					  const charactersLength = characters.length;
					  for (let i = 0; i < length; i++) {
						result += characters.charAt(Math.floor(Math.random() * charactersLength));
					  }
					  return result;
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
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Subject Fields : {{ subject.title }}</h2>
    <form class="space-y-6" @submit.prevent="submit"> 
      

				
				
				
				
				
				
				
				
				
				
				
				
	<div class="p-6 bg-white rounded-lg shadow-md">
  <h3 class="text-xl font-semibold text-gray-800 mb-6">Form Builder</h3>
  
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Field Cards -->
    <div 
      v-for="(field, index) in form.formfields" 
      :key="index" 
      class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-all duration-200 bg-gray-50"
    >
      <div class="p-4 flex flex-col h-full">
        <!-- Field Header -->
        <div class="flex justify-between items-start mb-3">
          <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
            Field {{ index + 1 }}
          </span>
          <button 
            @click="removeField(index)" 
            class="text-gray-400 hover:text-red-500 transition-colors"
            title="Remove field"
          >
            <i class="fas fa-times"></i>
          </button>
        </div>
        
        <!-- Field Content -->
        <div class="space-y-4 flex-grow">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Label</label>
            <input 
              type="text" 
              v-model="field.field_label"
              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
              placeholder="Enter field label"
            >
          </div>
          
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
            <select 
              v-model="field.field_type"
              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
            >
              <option value="text">Text</option>
              <option value="select">Dropdown</option>
              <option value="textarea">Text Area</option>
            </select>
          </div>
          
          <div class="flex items-center">
            <input 
              type="checkbox" 
             
              value="1" 
              true-value="1" 
              false-value="0"  
              v-model="field.field_required" 
              class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
            >
            <label  class="ml-2 block text-sm text-gray-700">
              Required
            </label>
          </div>
          
          <!-- Options for select fields -->
          <template v-if="field.field_type=='select'">
            <div class="border-t border-gray-200 pt-3 mt-3">
              <label class="block text-sm font-medium text-gray-700 mb-2">Options</label>
              <div class="space-y-2">
                <template v-for="(optionItm, iindex) in field.field_options">
                  <div class="flex items-center space-x-2">
                    <input 
                      type="text" 
                      v-model="optionItm.option_text" 
                      placeholder="Enter option" 
                      class="flex-grow px-3 py-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm"
                    >
                    <button 
                      @click="removeSubField(index, iindex)" 
                      class="text-red-400 hover:text-red-600 transition-colors"
                      title="Remove option"
                    >
                      X
                    </button>
					
					
                  </div>
                </template>
              </div>
              <a href="javascript::void(0)"
                @click="addSubField(index)" 
                class="mt-2 inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
              >
                <i class="fas fa-plus mr-1 text-xs"></i>
                Add Option
              </a>
            </div>
          </template>
        </div>
		
		
		
		
		<a @click="removeField(index)"  class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="javascript::void(0)">Remove Field</a>
      </div>
    </div>
    
    <!-- Add New Field Button -->
    <div 
      @click="AddField" 
      class="border-2 border-dashed border-gray-300 rounded-lg flex flex-col items-center justify-center cursor-pointer hover:border-blue-400 transition-colors duration-200 bg-gray-50 hover:bg-blue-50 min-h-[200px]"
    >
      <div class="text-center p-4 flex flex-col items-center">
        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mb-2">
          <i class="fas fa-plus text-blue-500"></i>
        </div>
        <p class="text-gray-600 font-medium">Add New Field</p>
        <p class="text-xs text-gray-400 mt-1">Click to create a new form field</p>
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
