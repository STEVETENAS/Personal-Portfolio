<script>
import ProfilerService from "../../src/services/ProfilerService.js";
import SkillModal from "./modalComponents/skillModal.vue";

export default {
  name: "Skills",
  components: {SkillModal},
  data() {
    return {
      skill_id: null,
      skills: [],
      isShowModal: false
    }
  },
  methods:{
    toggleModal(id) { this.skill_id = id; this.isShowModal = !this.isShowModal; },
    refreshComponent() {
      ProfilerService.getItem('skill', 'profiler_info_id', 1)
          .then(response => {
            this.skills = response?.data?.data;
            this.skills.sort(function (a, b){ return b-a })
          })
          .catch( error => { console.log(error?.response);})
    },
  },
  created() {
    ProfilerService.getItem('skill', 'profiler_infos_id', 1)
        .then( response => { this.skills = response.data.data; })
        .catch( error => { console.log(error.response); })
  }
}
</script>

<template>
  <div id="skills_body" class="md:h-[600px] py-8 bg-gray-100 dark:bg-slate-700 overflow-scroll scrollbar-hide">
    <div class="relative">
      <i class="absolute right-20 -top-6 fas fa-plus-circle fa-2x hover:rounded-full hover:bg-gray-500 hover:p-2"
         @click="toggleModal(null)"></i>
    </div>
    <div v-for="skill in skills" :key="skill.id" @click="toggleModal(skill.id)" class="w-12/12 flex m-auto p-4 space-x-4 hover:bg-blue-200 dark:hover:bg-slate-500">
      <i class="fas fa-check-square text-3xl text-blue-600"></i>
      <div class="w-[90%] m-auto text-left">
        <div class="flex justify-between">
          <p class="text-xl font-bold">
            {{ skill.skill_title }}
          </p>
          <i class="fas fa-star text-sm text-yellow-600"></i>
        </div>
        <p>{{ skill.skill_description }}</p>
        <div class="bg-gray-300 w-full h-2 rounded-full flex items-center -space-x-2">
          <div id="backend" :title="skill.skill_level + '%'" class="bg-blue-600 h-full  rounded-full" :style="'width:' + skill.skill_level +'%'"></div>
          <div class="rounded-full p-2 bg-blue-800" :title="skill.skill_level + '%'"></div>
        </div>
      </div>
    </div>
  </div>
  <teleport to="#app">
    <skill-modal v-if="isShowModal" :id="skill_id" :isShowModal="toggleModal" @refresh="refreshComponent()"/>
  </teleport>
</template>