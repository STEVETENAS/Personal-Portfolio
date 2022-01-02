<script>
import ProfilerService from "../../src/services/ProfilerService.js";

export default {
  name: "Pi_Lang",
  data() {
    return {
      ips: [],
      langs: [],
    }
  },
  created() {
    ProfilerService.getItem('ip', 'profiler_infos_id', 1)
        .then(
            response => {
              this.ips = response.data.data;
            }
        )
        .catch(
            error => {
              console.log(error.response);
            }
        )
    ProfilerService.getItem('lang', 'profiler_infos_id', 1)
        .then(
            response => {
              this.langs = response.data.data;
            }
        )
        .catch(
            error => {
              console.log(error.response);
            }
        )
  }
}
</script>

<template>
  <div id="pi_lang_body" class="w-full space-y-2 xl:flex xl:space-x-2 pb-4">

    <div id="interest" class="w-11/12 rounded-lg bg-gray-50 dark:bg-slate-600 dark:text-gray-50 m-auto p-4">
      <div class="int_head">
        <p class="text-2xl">Hobbies</p>
        <i>Thinks i like to do</i>
      </div>
      <div class="flex justify-between pt-2">
        <div v-for="ip in ips" :key="ip.id">
          <img v-if="!ip.ip_img" :title="ip.ip_description" alt="test"
               class="w-16" src="../assets/q.png">
          <img v-else
               :alt="ip.ip_name" :src=" 'http://127.0.0.1:8000'+ip.ip_img"
               :title="ip.ip_description" class="w-16">
        </div>
      </div>
    </div>

    <div id="lang" class="w-11/12 rounded-lg xl:w-2/5 bg-gray-50 dark:bg-slate-600 dark:text-gray-50 m-auto p-4">
      <div class="lang_head">
        <p class="text-2xl">Languages</p>
        <i>Professional languages</i>
      </div>
      <div class="lang_body">
        <div v-for="lang in langs" :key="lang.id" class="flex space-x-3 items-center justify-center pt-2">
          <i class="fas fa-check-square " style="color: dodgerblue; font-size: 2.0em;"></i>
          <h3>{{ lang.language }}</h3>
        </div>
      </div>
    </div>

  </div>
</template>
