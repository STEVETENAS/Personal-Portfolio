<template>
  <div id="pro_exp">
    <div class="pro_exp_head">
      <div class="head_body" style="">
        <div class="pro_head_start">
          <i class="fas fa-city fa-2x"></i>
          <div class="pe_head_txt">
            <h2>Professional Experience</h2>
            <i>Company Expertise</i>
          </div>
        </div>
        <i class="fas fa-plus-circle fa-2x" @click="toggleModal(undefined)"></i>
      </div>
    </div>
    <div class="pro_exp_body">
      <div v-for="exp in exps" :key="exp.id" class="pe_item">
        <div class="first_line">
          <h3> {{ exp.job_title }} - <b>@{{ exp.company_name }}</b></h3>
          <i id="edit-btn" :title="'Edit '+exp.job_title  + ' infos'" class="fas fa-edit edit_fas"
             @click="toggleModal(exp.id)"></i>
        </div>
        <p class="duration">From {{ exp.job_start_date }} to {{ exp.job_end_date ? exp.job_end_date : "Date" }}
          {{ exp.company_website ? '- ' + exp.company_website : "" }} </p>
        <p class="realisation">{{ exp.job_description }}</p>
      </div>
    </div>
  </div>
  <teleport to="#app">
    <experienceModal v-if="isShowModal" :id="id" :expsError="expsError" :isShowModal="toggleModal"/>
  </teleport>
</template>

<script>
import profilerService from "@/services/ProfilerService";
import experienceModal from "@/components/modalComponents/ExperienceModal";

export default {
  name: "Experience",
  components: {
    experienceModal,
  },
  data() {
    return {
      exps: [],
      expsError: [],
      isShowModal: false,
      id: undefined
    }
  },
  created() {
    profilerService.getItem('exp', 'profiler_exp', 1)
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

<style scoped>
#pro_exp {
  width: 100%;
  height: 600px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  font-size: 1.2em;
}

.pro_exp_head {
  width: 100%;
  background-color: #015F9F;
  border-radius: 10px 10px 0 0;
  color: #f1f1f1;
}

.pro_head_start {
  display: flex;
  flex-direction: row;
  align-items: center;
  gap: 20px;
}

.head_body {
  width: 90%;
  margin: auto;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 12px 0;
}

.first_line {
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 100%
}

.pe_head_txt {
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  text-align: start;
}

.pro_exp_body {
  width: 100%;
  height: 100%;
  color: black;
  background-color: white;
  overflow-x: hidden;
  scroll-behavior: smooth;
}

.pe_item {
  width: 90%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: flex-start;
  border-bottom: 2px solid grey;
  text-align: start;
  padding: 15px 0;
  font-size: 1.2em;
  margin: 10px auto;
}

.duration {
  color: #015F9F;
}

.edit_fas {
  color: #015F9F;
}

.edit_fas:hover {
  color: gray;
}

@media screen and (max-width: 768px) {
  .pro_exp_head {
    width: 100%;
    border-radius: 0;
  }
}
</style>
