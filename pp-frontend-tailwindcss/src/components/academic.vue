<template>
  <div class="">
    <div class="w-full bg-blue-600 dark:bg-slate-700  text-white">
      <div class="w-11/12 m-auto flex justify-between items-center p-2">
        <div class="flex space-x-4 text-left items-center">
          <i class="fas fa-graduation-cap fa-2x"></i>
          <div class="academic_head_txt">
            <p class="text-2xl font-bold">Academic curriculum</p>
            <i>Diplomas and professional certificates</i>
          </div>
        </div>
        <i class="fas fa-plus-circle fa-2x hover:rounded-full hover:bg-gray-500 hover:p-2"
           @click="toggleModal(null)"></i>
      </div>
    </div>
    <div class="py-4 w-full h-[410px] overflow-y-scroll bg-gray-50 dark:bg-slate-600">
      <div v-for="academic in academics" :key="academic.id" class="w-11/12 m-auto text-left p-4 border-b-2 text-lg">
        <div class="flex justify-between items-center">
          <p class="text-xl font-semibold"> {{ academic.diploma_title }} - <b>@{{ academic.institution_attended }} </b></p>
          <i id="edit-btn" :title="'Edit : ' + academic.diploma_title + ' info'" class="fas fa-edit edit_fas hover:text-blue-600"
             @click="toggleModal(academic.id)"></i>
        </div>
        <p>
          <span class="text-blue-500">{{ academic?.finished_on ? academic.finished_on : "to date" }}
          </span> - <span class="description">
          <i>{{ academic.diploma_description }}</i></span>
        </p>
      </div>
    </div>
  </div>

  <teleport to="#app">
    <academic-modal v-if="isShowModal" :id="academic_id" :isShowModal="toggleModal" @refresh="refreshComponent()"/>
  </teleport>

</template>

<script>
import ProfilerService from "../../src/services/ProfilerService.js";
import academicModal from "../components/modalComponents/academicModal.vue";

export default {
  name: "academic",
  components:{
    academicModal
  },
  data() {
    return {
      academics: [],
      isShowModal: false,
      academic_id: undefined
    }
  },
  created() {
    ProfilerService.getItem('academic', 'profiler_info_id', 1)
        .then(response => { this.academics = response?.data?.data; })
        .catch( error => { console.log(error?.response);})
  },
  methods: {
    toggleModal(id) { this.academic_id = id; this.isShowModal = !this.isShowModal; },
    refreshComponent() {
      ProfilerService.getItem('academic', 'profiler_info_id', 1)
        .then(response => { this.academics = response?.data?.data; })
        .catch( error => { console.log(error?.response);})
    }
  },
}
</script>
