<template>
  <section id="academic">
    <div class="academic_head">
      <div class="academic_head_start">
        <svg height="48" style=" fill:#000000;" viewBox="0 0 172 172"
             width="48" x="0px"
             xmlns="http://www.w3.org/2000/svg"
             y="0px">
          <g fill="none" fill-rule="nonzero" font-family="none" font-size="none" font-weight="none" stroke="none"
             stroke-dasharray="" stroke-dashoffset="0" stroke-linecap="butt" stroke-linejoin="miter"
             stroke-miterlimit="10" stroke-width="1" style="mix-blend-mode: normal" text-anchor="none">
            <path d="M0,172v-172h172v172z" fill="none"></path>
            <g fill="#ecf0f1">
              <path
                  d="M86,42.42611l-86,36.40723l28.66667,18.19661v31.97006h114.66667v-31.97006l14.33333,-9.09831v41.06836h14.33333v-50.16667z"></path>
            </g>
          </g>
        </svg>
        <div class="academic_head_txt">
          <h1>Cursus academique</h1>
          <i>Diplomes et formations certifiantes</i>
        </div>
      </div>
      <div class="menuIcon">
        <svg height="30" style=" fill:#000000;" viewBox="0 0 172 172"
             width="30" x="0px"
             xmlns="http://www.w3.org/2000/svg"
             y="0px">
          <g fill="none" fill-rule="nonzero" font-family="none" font-size="none" font-weight="none" stroke="none"
             stroke-dasharray="" stroke-dashoffset="0" stroke-linecap="butt" stroke-linejoin="miter"
             stroke-miterlimit="10" stroke-width="1" style="mix-blend-mode: normal" text-anchor="none">
            <path d="M0,172v-172h172v172z" fill="none"></path>
            <g fill="#ffffff">
              <path
                  d="M86,22.93333c-9.4993,0 -17.2,7.7007 -17.2,17.2c0,9.4993 7.7007,17.2 17.2,17.2c9.4993,0 17.2,-7.7007 17.2,-17.2c0,-9.4993 -7.7007,-17.2 -17.2,-17.2zM86,68.8c-9.4993,0 -17.2,7.7007 -17.2,17.2c0,9.4993 7.7007,17.2 17.2,17.2c9.4993,0 17.2,-7.7007 17.2,-17.2c0,-9.4993 -7.7007,-17.2 -17.2,-17.2zM86,114.66667c-9.4993,0 -17.2,7.7007 -17.2,17.2c0,9.4993 7.7007,17.2 17.2,17.2c9.4993,0 17.2,-7.7007 17.2,-17.2c0,-9.4993 -7.7007,-17.2 -17.2,-17.2z"></path>
            </g>
          </g>
        </svg>

      </div>
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
  flex-direction: row;
  justify-content: space-between;
  background-color: #015F9F;
  padding: 10px 0px;
  color: #f1f1f1;
  align-items: start;
}

.academic_head_start {
  display: flex;
  flex-direction: row;
  gap: 20px;
}

.duration {
  color: #015F9F;
}

.academic_body {
  height: 620px;
  margin: 5px;
  color: black;
  font-size: 1.2em;
  background-color: white;
  overflow-x: hidden;
  scroll-behavior: smooth;
}

.academic_item {
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
</style>
