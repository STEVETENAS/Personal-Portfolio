<template>
  <div id="pi_lang_body">

    <div id="interest">
      <div class="int_head">
        <h1>Hobbies</h1>
        <i>Thinks i like to do</i>
      </div>
      <div class="int_body">
        <div v-for="ip in ips" :key="ip.id">
          <img v-if="!ip.ip_img" :title="ip.ip_description" alt="test"
               class="int_item" src="@/assets/q.png">
          <img v-else
               :alt="ip.ip_name" :src=" 'http://127.0.0.1:8000'+ip.ip_img"
               :title="ip.ip_description" class="int_item">
        </div>
      </div>
    </div>

    <div id="lang">
      <div class="lang_head">
        <h1>Languages</h1>
        <i>Professional languages</i>
      </div>
      <div class="lang_body">
        <div v-for="lang in langs" :key="lang.id" class="lang_item">
          <i class="fas fa-check-square " style="color: dodgerblue; font-size: 2.0em;"></i>
          <h3>{{ lang.language }}</h3>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
import profilerService from "@/services/ProfilerService";

export default {
  name: "Pi_Lang",
  data() {
    return {
      ips: [],
      langs: [],
    }
  },
  created() {
    profilerService.getItem('ip', 'profiler_infos_id', 1)
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
    profilerService.getItem('lang', 'profiler_infos_id', 1)
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

<style scoped>
#pi_lang_body {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

#interest {
  width: 60%;
  height: 100%;
  background-color: #fdfdfd;
  display: flex;
  flex-direction: column;
  border-radius: 10px;
  padding: 10px 0;
}

.int_body {
  width: 90%;
  height: 100%;
  margin: auto;
  display: flex;
  justify-content: space-around;
  /*overflow-x: scroll;*/
}

.int_item {
  padding: 8px 0;
  width: 60px;
  height: 60px;
}

#lang {
  width: 39%;
  height: 100%;
  background-color: #fdfdfd;
  display: flex;
  flex-direction: column;
  border-radius: 10px;
  padding: 10px 0;
}

.lang_body {
  width: 100%;
  height: 100%;
  display: flex;
  flex-direction: column;
}

.lang_item {
  width: 50%;
  margin: auto;
  display: flex;
  align-items: center;
  gap: 12px;
}

@media screen and (max-width: 768px) {
  #pi_lang_body {
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
  }

  #lang {
    width: 96%;
    margin: auto;
  }

  #interest {
    width: 96%;
    margin: auto;
  }
}
</style>
