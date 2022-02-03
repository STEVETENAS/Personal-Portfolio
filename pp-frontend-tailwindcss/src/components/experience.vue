<template>
  <div class="">
    <div class="w-full bg-blue-600 dark:bg-slate-700 text-white rounded">
       <div class="w-11/12 m-auto flex justify-between items-center p-2">
        <div class="flex space-x-4 text-left items-center">
            <i class="fas fa-city fa-2x"></i>
            <div class="pe_head_txt">
                <p class="text-2xl font-bold">Professional Experience</p>
                <i>Company Expertise</i>
            </div>
        </div>
        <i class="fas fa-plus-circle fa-2x hover:rounded-full hover:bg-gray-500 hover:p-2" @click="toggleModal(null)"></i>
       </div>
    </div>
    <div class="py-2 w-full bg-gray-100 dark:bg-slate-600 md:h-[450px] md:overflow-scroll scrollbar-hide">
      <div v-for="exp in exps" :key="exp.id" @click="toggleModal(exp.id)" class="w-full m-auto text-left px-12 py-4 border-b-2 border-gray-300 dark:border-b-red-50 text-lg hover:bg-blue-200 dark:hover:bg-slate-500">
        <div class="flex justify-between items-center">
          <p class="text-xl font-semibold"> {{ exp.job_title }} - <b>@{{ exp.company_name }}</b></p>
        </div>
        <p class="text-blue-500">From {{ exp.job_start_date }} to {{ exp.job_end_date ? exp.job_end_date : "Date" }}
          {{ exp.company_website ? ' - ' + exp.company_website : "" }} </p>
        <p class="realisation">{{ exp.job_description }}</p>
      </div>
    </div>
  </div>

  <teleport to="#app">
    <experienceModal v-if="isShowModal" :id="experience_id"  :isShowModal="toggleModal" @refresh="refreshComponent"/>
  </teleport>

</template>

<script>
import ProfilerService from "../../src/services/ProfilerService.js";
import experienceModal from "../components/modalComponents/experienceModal.vue";

export default {
  name: "experience",
  components:{
    experienceModal
  },
  data() {
    return {
      exps: [],
      isShowModal: false,
      experience_id: undefined
    }
  },
  created() {
    ProfilerService.getItem('exp', 'profiler_info_id', 1)
        .then( response => { this.exps = response.data.data; })
        .catch( error => { console.log(error.response); } )
  },
  methods: {
    toggleModal(id) { this.experience_id = id; this.isShowModal = !this.isShowModal; },
    refreshComponent() {
      ProfilerService.getItem('exp', 'profiler_info_id', 1)
          .then(response => { this.exps = response?.data?.data; })
          .catch( error => { console.log(error?.response);})
    }
  }
}
</script>
