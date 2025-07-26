<script   lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

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
						submit_form:false   
				   
					}
		  } 
	 
	 ,props:{
			
		 subject:Object,
		 errors:Object
	 },setup(props){
		 const form = reactive({
		  
				title: '', 
				description: '', 
				subject_id: props.subject.id, 
				form_data: {}, 
			})
			return { form }
	 }, methods:{
	 
	 submit() {
		  
		   router.post(route('post.store'), this.form, {
															onProgress: () => (this.submit_form=true),
															  onError: () =>(this.submit_form=false),

														});  
		}
	 }
}
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
    <div class="w-4/5 mx-auto">
	
	
	
	<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
  <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Create Form</h2>
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
        <label for="body" class="block text-sm font-medium text-gray-700 mb-1">Body</label>
        <textarea 
          id="description" 
          name="description" 
          rows="4" 
          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
          placeholder="Enter body"
		  
		  v-model="form.description"
        ></textarea>
      </div>
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	      <div v-for="(field, index) in entityForms" :key="index" class="form-field">
      <label :for="field.field_key">{{ field.field_label }}</label>
      
      <!-- Text Input -->
      <input 
        v-if="field.field_type === 'text' || field.field_type === 'email' || field.field_type === 'password'"
        :type="field.field_type"
        :id="field.field_key"
        v-model="form.form_data[field.field_key]"
        :placeholder="field.placeholder || ''"
        :required="field.required || false"
      >
      
      <!-- Textarea -->
      <textarea 
        v-else-if="field.field_type === 'textarea'"
        :id="field.field_key"
        v-model="form.form_data[field.field_key]"
        :placeholder="field.placeholder || ''"
        :required="field.required || false"
        :rows="field.rows || 3"
      ></textarea>
      
      <!-- Select Dropdown -->
      <select 
        v-else-if="field.field_type === 'select'"
        :id="field.field_key"
        v-model="form.form_data[field.field_key]"
        :required="field.required || false"
      >
        <option v-for="option in field.options" :value="option.value">
          {{ option.label }}
        </option>
      </select>
      
      <!-- Checkbox -->
      <input 
        v-else-if="field.field_type === 'checkbox'"
        type="checkbox"
        :id="field.field_key"
        v-model="form.form_data[field.field_key]"
      >
      
      <!-- Radio Buttons -->
      <div v-else-if="field.field_type === 'radio'" class="radio-group">
        <div v-for="option in field.options" :key="option.value">
          <input 
            type="radio"
            :id="`${field.field_key}-${option.value}`"
            :name="field.field_key"
            :value="option.value"
            v-model="form.form_data[field.field_key]"
          >
          <label :for="`${field.field_key}-${option.value}`">{{ option.label }}</label>
        </div>
      </div>
      
      <!-- Add more field types as needed -->
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
