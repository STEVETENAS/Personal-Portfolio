<script>
import ProfilerService from "../../src/services/ProfilerService.js";
// import experienceModal from "@/components/modalComponents/ExperienceModal";

export default {
  name: "experience",
  data() {
    return {
      exps: [],
      expsError: [],
      isShowModal: false,
      id: undefined
    }
  },
  created() {
    ProfilerService.getItem('exp', 'profiler_exp', 1)
        .then(
            response => {
              this.exps = response.data.data;
            }
        )
        .catch(
            error => {
              this.expsError = error.response;
              console.log(error.response);
            }
        )
  },
  methods: {
    toggleModal(id) {
      this.id = id;
      this.isShowModal = !this.isShowModal;
    }
  }
}
</script>


<template>
 
 <div class="">
    <div class="w-full bg-blue-600 dark:bg-slate-700 text-white">
       <div class="w-11/12 m-auto flex justify-between items-center p-2">
        <div class="flex space-x-4 text-left items-center">
            <i class="fas fa-city fa-2x"></i>
            <div class="pe_head_txt">
                <p class="text-2xl font-bold">Professional Experience</p>
                <i>Company Expertise</i>
            </div>
        </div>
        <i class="fas fa-plus-circle fa-2x hover:bg-blue-700 hover:p-2" @click="toggleModal(undefined)"></i>
       </div>
    </div>
    <div class="py-4 w-full bg-gray-50 dark:bg-slate-600 max-h-[600px] overflow-y-scroll">
      <div v-for="exp in exps" :key="exp.id" class= "w-11/12 m-auto text-left p-4 border-b-2 text-lg">
        <div class="flex justify-between items-center">
          <p class="text-xl font-semibold"> {{ exp.job_title }} - <b>@{{ exp.company_name }}</b></p>
          <i id="edit-btn" :title="'Edit '+exp.job_title  + ' infos'" class="fas fa-edit edit_fas hover:text-blue-600"
             @click="toggleModal(exp.id)"></i>
        </div>
        <p class="text-blue-500">From {{ exp.job_start_date }} to {{ exp.job_end_date ? exp.job_end_date : "Date" }}
          {{ exp.company_website ? '- ' + exp.company_website : "" }} </p>
        <p class="realisation">{{ exp.job_description }}</p>
      </div>
    </div>
  </div>

  <teleport to="#app">
    <experienceModal v-if="isShowModal" :id="id" :expsError="expsError" :isShowModal="toggleModal"/>
  </teleport>

</template>