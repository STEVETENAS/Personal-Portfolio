<template>
  <div id="profile_body" class="w-full min-w-[250px] bg-no-repeat bg-center bg-cover"
        :style="{ 'background-image': 'url('+'http://127.0.0.1:8000' + user.background_image + ')' }">
    <div id="profile_bg" class="space-y-8 xl:space-y-12  backdrop-blur-sm bg-blue-400/30 py-8 text-gray-100">
      
      <div id="searchGroup" class="w-[85%] flex justify-between m-auto items-center min-w-[250px] bg-white dark:bg-slate-600 p-2 rounded text-gray-400 dark:text-gray-200">
        <i class="fas fa-bars hover:text-black"></i>
        <input id="searchBar" class="text-center w-[70%] text-gray-700 dark:bg-slate-700 rounded" placeholder="Need a software Developer?" type="text">
        <div class="flex items-center">
          <i class="fas fa-search hover:text-black"></i>
          <i class="far fa-horizontal-rule rotate-90"></i>
          <i class="fas fa-times hover:text-black" @click="cleared"></i>
        </div>
      </div>

      <div class="w-[85%] m-auto xl:flex space-y-4 items-center">
        <img :src="'http://127.0.0.1:8000'+user.profiler_image" alt="TENAS img"
          class="rounded-full w-2/5 xl:w-1/3 m-auto border-4">
        <div class="justify-start">
          <p class="text-2xl font-bold">{{ user.first_name }} {{ user.last_name }}</p>
          <i>{{ user.profession }}</i>
        </div>
      </div>

      <i id="share" class="fas fa-paper-plane p-4 text-lg bg-red-600 hover:bg-red-800 rounded-full fixed -bottom-8 right-4"></i>
    
    </div>
  </div>
</template>

<script>
import ProfilerService from "../../src/services/ProfilerService.js";

export default {
  name: "profile",
  data() {
    return {
      user: [],
    }
  },
  created() {
    ProfilerService.getResponse('info', 1)
        .then(
            response => {
              this.user = response.data.data;
            })
        .catch(
            error => {
              console.log(error.response);
            })
  },
  methods: {
    cleared() {
      document.getElementById("searchBar").value = '';
    }
  }
}
</script>

<style scoped>
</style>
