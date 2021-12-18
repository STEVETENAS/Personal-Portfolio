<template>
  <div id="pro_exp">
    <div class="pro_exp_head">
      <div class="pro_head_start">
        <i class="fas fa-city fa-2x"></i>
        <div class="pe_head_txt">
          <h1>Experience professionnelle</h1>
          <i>Expertise en entreprise</i>
        </div>
      </div>
      <i class="fas fa-ellipsis-v " style="padding-right: 20px"></i>
    </div>
    <div class="pro_exp_body">
      <div v-for="exp in exps" :key="exp.id" class="pe_item">
        <h3> {{ exp.job_title }} - <b>@{{ exp.company_name }}</b></h3>
        <p class="duration">From {{ exp.job_start_date }} to {{ exp.job_end_date ? exp.job_end_date : "Date" }}
          {{ exp.company_website ? '- ' + exp.company_website : "" }}</p>
        <p class="realisation">{{ exp.job_description }}</p>
      </div>
      <div v-for="exp in exps" :key="exp.id" class="pe_item">
        <h3> {{ exp.job_title }} - <b>@{{ exp.company_name }}</b></h3>
        <p class="duration">From {{ exp.job_start_date }} to {{ exp.job_end_date ? exp.job_end_date : "Date" }}
          {{ exp.company_website ? '- ' + exp.company_website : "" }}</p>
        <p class="realisation">{{ exp.job_description }}</p>
      </div>
    </div>
  </div>
</template>

<script>
import profilerService from "@/services/ProfilerService";

export default {
  name: "Experience",
  data() {
    return {
      exps: []
    }
  },
  created() {
    profilerService.getItem('exp', 'profiler_exp', 1).then(
        response => {
          this.exps = response.data.data;
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
#pro_exp {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  color: #f1f1f1;
}

.pro_exp_head {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
  background-color: #015F9F;
  padding: 12px 0px;
}

.pro_head_start {
  display: flex;
  flex-direction: row;
  align-items: center;
  gap: 20px;
  padding-left: 20px;
}

.pe_head_txt {
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  text-align: start;
}

.pro_exp_body {
  color: black;
  font-size: 1.2em;
  background-color: white;
  overflow-x: hidden;
  scroll-behavior: smooth;
  height: 600px;
}

.pe_item {
  width: 90%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: flex-start;
  border-bottom: 2px solid grey;
  text-align: start;
  padding: 25px 0px;
  margin-left: 40px;
}

.duration {
  color: #015F9F;
}

</style>
