<template>
  <section id="academic">
    <div class="academic_head">
      <div class="academic_head_start">
        <i class="fas fa-graduation-cap fa-3x"></i>
        <div class="academic_head_txt">
          <h1>Cursus academique</h1>
          <i>Diplomes et formations certifiantes</i>
        </div>
      </div>
      <i class="fas fa-ellipsis-v " style="padding-right: 20px"></i>
    </div>
    <div class="academic_body">
      <div v-for="aca in academics" :key="aca.id" class="academic_item">
        <h3> {{ aca.diploma_title }} - <b>@{{ aca.institution_attended }} </b></h3>
        <p>
          <span class="duration">{{ aca.finished_on ? aca.finished_on : "to date" }}
          </span> - <span class="desciption">
          <i>{{ aca.diploma_description }}</i></span>
        </p>
      </div>
    </div>
  </section>
</template>

<script>
import profilerService from "@/services/ProfilerService";

export default {
  name: "Academic",
  data() {
    return {
      academics: []
    }
  },
  created() {
    profilerService.getItem('academic', 'profiler_exp', 1).then(
        response => {
          this.academics = response.data.data;
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
#academic {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: start;
  background-color: white;
}

.academic_head {
  width: 100%;
  display: flex;
  justify-content: space-between;
  background-color: #015F9F;
  padding: 12px 0;
  color: #f1f1f1;
  align-items: center;
}

.academic_head_txt {
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  text-align: start;
}

.academic_head_start {
  display: flex;
  align-items: center;
  gap: 20px;
  padding-left: 20px;
}

.duration {
  color: #015F9F;
}

.academic_body {
  width: 95%;
  height: 620px;
  margin: 5px;
  color: black;
  font-size: 1.2em;
  background-color: white;
  overflow-x: hidden;
  scroll-behavior: smooth;
}

.academic_item {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: flex-start;
  border-bottom: 2px solid grey;
  text-align: start;
  padding: 25px 0px;
  margin-left: 40px;
}
</style>
