<template>
  <div id="pi_lang">
    <section id="intrest">
      <div class="int_head">
        <h1>Hobbies</h1>
        <i>Thinks i like to do</i>
      </div>
      <div class="int_body">
        <div v-for="ip in ips" :key="ip.id">
          <img :src="'http://127.0.0.1:8000'+ip.ip_img" height="50px" width="100px">
        </div>
      </div>
    </section>

    <section id="lang">
      <div class="lang_head">
        <h1>Langues</h1>
        <i>Pratiquees en entreprise</i>
      </div>
      <div class="lang_body">
        <div v-for="lang in langs" :key="lang.id" class="lang_item">
          <img src="https://img.icons8.com/office/32/000000/checked-2--v1.png"/>
          <p>{{ lang.language }}</p>
        </div>
      </div>
    </section>

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
    profilerService.getItem('ip', 'profiler_exp', 1)
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
    profilerService.getItem('lang', 'profiler_exp', 1)
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
#pi_lang {
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  gap: 10px;
  margin: 2% 2% 2% 0;
}

#intrest {
  width: 60%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  gap: 10px;
  align-items: flex-start;
  background-color: white;
  border-radius: 5px;
  color: black;
  padding: 30px;
  text-align: start;
}

.int_body {
  display: flex;
  flex-direction: row;
  float: left;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  gap: 5px;
}

#lang {
  width: 30%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: flex-start;
  background-color: white;
  color: black;
  border-radius: 5px;
  text-align: start;
  padding: 30px;
}

.lang_body {
  display: flex;
  flex-direction: column;
  padding: 10px;
}

.lang_item {
  display: flex;
  flex-direction: row;
  align-items: center;
  gap: 10px;
  padding: 10px 0px;
}

@media screen and (max-width: 768px) {
  #pi_lang {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }

  #lang {
    align-items: center;
    width: 90%;
    padding: 10px;
  }

  #intrest {
    justify-content: center;
    align-items: center;
    width: 90%;
    padding: 10px;
  }
}
</style>
