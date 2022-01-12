<script>
import ProfilerService from "../../src/services/ProfilerService.js";
import HobbiesModal from "./modalComponents/hobbiesModal.vue";
import LanguageModal from "./modalComponents/LanguageModal.vue";

export default {
  name: "Pi_Lang",
  components: {LanguageModal, HobbiesModal},
  data() {
    return {
      ip_id: null,
      lang_id: null,
      ips: [],
      langs: [],
      isShowIpModal: false,
      isShowLangModal: false
    }
  },
  methods:{
    toggleLangModal(id) { this.lang_id = id; this.isShowLangModal = !this.isShowLangModal; },
    toggleIpModal(id) { this.ip_id = id; this.isShowIpModal = !this.isShowIpModal; },
    refreshIpComponent() {
      ProfilerService.getItem('ip', 'profiler_info_id', 1)
          .then(response => { this.ips = response?.data?.data; })
          .catch( error => { console.log(error?.response);})
    },
    refreshLangComponent() {
      ProfilerService.getItem('lang', 'profiler_info_id', 1)
          .then(response => { this.langs = response?.data?.data; })
          .catch( error => { console.log(error?.response);})
    }
  },
  created() {
    ProfilerService.getItem('lang', 'profiler_infos_id', 1)
        .then( response => { this.langs = response.data.data; })
        .catch( error => { console.log(error.response); })

    ProfilerService.getItem('ip', 'profiler_infos_id', 1)
        .then( response => { this.ips = response.data.data; })
        .catch( error => { console.log(error.response); })
  }
}
</script>

<template>
  <div id="pi_lang_body" class="w-full space-y-2 xl:flex xl:space-x-2">

    <div id="interest" class="w-full xl:h-[170px] rounded-lg bg-gray-50 dark:bg-slate-600 dark:text-gray-50 m-auto p-4">
      <div class="int_head">
        <p class="text-2xl">
          Hobbies
          <i class="fas fa-plus-circle hover:rounded-full hover:bg-gray-500 hover:p-2" @click="toggleIpModal(null)"></i>
        </p>
        <i>Thinks i like to do</i>
      </div>
      <div class="flex justify-between pt-2">
        <div v-for="ip in ips" :key="ip.id">
          <img v-if="!ip.ip_img" :title="ip.ip_description" alt="test" @click="toggleIpModal(ip.id)"
               class="w-16" src="../assets/q.png">
          <img v-else
               :alt="ip.ip_name" :src=" 'http://127.0.0.1:8000/'+ip.ip_img" @click="toggleIpModal(ip.id)"
               :title="ip.ip_description" class="w-16">
        </div>
      </div>
      <teleport to="#app">
        <hobbies-modal v-if="isShowIpModal" :id="ip_id"  :isShowModal="toggleIpModal" @refresh="refreshIpComponent"/>
      </teleport>
    </div>

    <div id="lang" class="w-full xl:h-[170px] rounded-lg xl:w-2/5 bg-gray-50 dark:bg-slate-600 dark:text-gray-50 m-auto p-4">
      <div class="lang_head">
        <p class="text-2xl">
          Languages
          <i class="fas fa-plus-circle hover:rounded-full hover:bg-gray-500 hover:p-2" @click="toggleLangModal(null)"></i>
        </p>
        <i>Professional languages</i>
      </div>
      <div class="lang_body">
        <div v-for="lang in langs" :key="lang.id" class="flex space-x-3 items-center justify-center pt-2">
          <i class="fas fa-check-square " style="color: dodgerblue; font-size: 2.0em;" @click="toggleLangModal(lang.id)"></i>
          <h3>{{ lang.language }}</h3>
        </div>
      </div>
      <teleport to="#app">
        <language-modal v-if="isShowLangModal" :id="lang_id"  :isShowModal="toggleLangModal" @refresh="refreshLangComponent"/>
      </teleport>
    </div>
  </div>
</template>
