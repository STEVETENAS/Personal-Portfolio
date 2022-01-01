<script>
import ProfilerService from "../../src/services/ProfilerService.js";

export default {
  name: "Skills",
  data() {
    return {
      skills: [],
    }
  },
  created() {
    ProfilerService.getItem('skill', 'profiler_infos_id', 1)
        .then(
            response => {
              this.skills = response.data.data;
            })
        .catch(
            error => {
              console.log(error.response);
            })
  }
}
</script>

<template>
  <div id="skills_body" class="py-8 bg-gray-50 dark:bg-slate-600">
    <div v-for="skill in skills" :key="skill.id" class="w-11/12 flex m-auto py-2 space-x-4">
      <i class="fas fa-check-square text-3xl text-blue-600"></i>
      <div class="w-[90%] m-auto text-left">
        <div class="flex justify-between">
          <p class="text-2xl font-bold"> {{ skill.skill_title }} </p>
          <i class="fas fa-star text-sm text-yellow-600"></i>
        </div>
        <p>{{ skill.skill_description }}</p>
        <div class="bg-gray-300 w-full h-2 rounded-full ">
          <div id="backend" class="bg-blue-600 h-full  rounded-full" :style="'width:' + skill.skill_level +'%'">
          </div>
          <div class="endball"></div>
        </div>
      </div>
    </div>
  </div>
</template>