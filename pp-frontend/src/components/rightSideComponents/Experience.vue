<template>
  <div id="pro_exp">
    <div class="pro_exp_head">
      <div class="pro_head_start">
        <svg height="64" style=" fill:#000000;" viewBox="0 0 172 172"
             width="64" x="0px"
             xmlns="http://www.w3.org/2000/svg"
             y="0px">
          <g fill="none" fill-rule="nonzero" font-family="none" font-size="none" font-weight="none" stroke="none"
             stroke-dasharray="" stroke-dashoffset="0" stroke-linecap="butt" stroke-linejoin="miter"
             stroke-miterlimit="10" stroke-width="1" style="mix-blend-mode: normal" text-anchor="none">
            <path d="M0,172v-172h172v172z" fill="none"></path>
            <g fill="#ffffff">
              <path
                  d="M53.75,20.87012l-37.625,18.8125v110.81738h75.25h64.5v-96.75h-64.5v-14.06738zM53.75,32.87988l26.875,13.4375v93.43262h-53.75v-93.43262zM37.625,53.75v10.75h10.75v-10.75zM59.125,53.75v10.75h10.75v-10.75zM91.375,64.5h53.75v75.25h-53.75zM37.625,75.25v10.75h10.75v-10.75zM59.125,75.25v10.75h10.75v-10.75zM102.125,75.25v10.75h10.75v-10.75zM123.625,75.25v10.75h10.75v-10.75zM37.625,96.75v10.75h10.75v-10.75zM59.125,96.75v10.75h10.75v-10.75zM102.125,96.75v10.75h10.75v-10.75zM123.625,96.75v10.75h10.75v-10.75zM37.625,118.25v10.75h10.75v-10.75zM59.125,118.25v10.75h10.75v-10.75zM102.125,118.25v10.75h10.75v-10.75zM123.625,118.25v10.75h10.75v-10.75z"></path>
            </g>
          </g>
        </svg>
        <div class="pe_head_txt">
          <h1>Experience professionnelle</h1>
          <i>Expertise en entreprise</i>
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
    <div class="pro_exp_body">
      <div v-for="exp in exps" :key="exp.id" class="pe_item">
        <h3> {{ exp.job_title }} - <b>@{{ exp.company_name }}</b></h3>
        <p class="duration">From {{ exp.job_start_date }} to {{ exp.job_end_date ? "Date" : exp.job_end_date }} -
          {{ exp.company_website }}</p>
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
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: space-between;
  background-color: #015F9F;
  padding: 10px 0px;
}

.pro_head_start {
  display: flex;
  flex-direction: row;
  align-items: center;
  gap: 20px;
  padding-left: 20px;
}

.pe_head_txt, .academic_head_txt {
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
  height: 550px;

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
