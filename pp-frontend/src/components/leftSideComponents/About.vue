<template>
  <div id="about" style="width: 100%;
                  display: flex;
                  flex-direction: column;
                  justify-content: center;
                  align-items: start;
                  background-color: #015F9F;
                  font-size: 1.7em;
                  color: #f1f1f1;
              ">

    <div id="item-1" class="about_item">
      <i class="fas fa-birthday-cake"></i>
      <div class="about_item_text">
        <p>Born on : {{ user.date_of_birth }}</p>
        <p>Tribe : {{ user.place_of_origin }}</p>
        <p>Married : {{ user.married ? "Yes" : "No" }} -
          Health : <span :title=" medical.medical_status"> {{
              medical.length ? medical.length + ' issues' : "RAS"
            }} </span></p>
      </div>
    </div>

    <div id="item-2" class="about_item">
      <i class="fas fa-map-marker-alt"></i>
      <div class="about_item_text">
        <p>Resident at : {{ resident.place_of_residence }}</p>
        <p>{{ resident.city_of_residence }} - {{ resident.country_of_residence }}</p>
        <p>Map:
          <small>
            {{ resident.residence_latitude }},
            {{ resident.residence_longitude }}
          </small>
        </p>
      </div>
    </div>

    <div id="item-3" class="about_item">
      <i class="fas fa-phone-alt"></i>
      <div class="about_item_text">
        <p>{{ telephone.profiler_phone_number }}</p>
        <small>{{ telephone.phone_number_description }}</small>
      </div>
    </div>

    <div id="item-4" class="about_item">
      <i class="fas fa-envelope"></i>
      <div class="about_item_text">
        <p>{{ email.profiler_email }}</p>
        <small>{{ email.email_description }}</small>
      </div>
    </div>

    <div id="item-5" class="about_recap">
      <a href="#" style="border-bottom: 5px solid #B2717E;">+ {{ project.length }} PROJECTS</a>
      <a href="#">+ {{ contract.length }} CONTRACTS</a>
      <a href="#">{{ new Date(exp.job_start_date).getFullYear() - new Date().getFullYear() + 1 }} WORK YEARS</a>
    </div>

  </div>
</template>

<script>

import ProfilerService from "@/services/ProfilerService";

export default {
  name: "About",
  data() {
    return {
      profileId: undefined,
      user: [],
      medical: [],
      resident: [],
      contract: [],
      project: [],
      telephone: [],
      email: [],
      exp: [],
    }
  },
  methods: {},
  created() {
    ProfilerService.getResponse('info', 1)
        .then(
            response => {
              this.user = response.data.data;
              this.profileId = response.data.data.id;
              console.log(this.profileId);
            })
        .catch(
            error => {
              console.log(error.response);
            })

    ProfilerService.getItem('medical', 'profiler_infos_id', this.profileId)
        .then(
            response => {
              this.medical = response.data.data;
            })
        .catch(
            error => {
              console.log(error.response);
            })

    ProfilerService.getItem('resident', 'profiler_infos_id', 1)
        .then(
            response => {
              this.resident = response.data.data[0];
            })
        .catch(
            error => {
              console.log(error.response);
            })

    ProfilerService.getItem('telephone', 'profiler_infos_id', 1)
        .then(
            response => {
              this.telephone = response.data.data[0];
            })
        .catch(
            error => {
              console.log(error.response);
            })
    ProfilerService.getItem('email', 'profiler_infos_id', 1)
        .then(
            response => {
              this.email = response.data.data[0];
              console.log(response.data.data[0]);
            })
        .catch(
            error => {
              console.log(error.response);
            })
    ProfilerService.getItem('project', 'profiler_infos_id', 1)
        .then(
            response => {
              this.project = response.data.data;
            })
        .catch(
            error => {
              console.log(error.response);
            })
    ProfilerService.getItem('contract', 'profiler_infos_id', 1)
        .then(
            response => {
              this.contract = response.data.data;
            })
        .catch(
            error => {
              console.log(error.response);
            })
    ProfilerService.getItem('exp', 'profiler_infos_id', 1)
        .then(
            response => {
              this.exp = response.data.data[0];
              console.log(response.data.data[0]);
            })
        .catch(
            error => {
              console.log(error.response);
            })
  }
}
</script>

<style scoped>

.about_item {
  width: 100%;
  display: flex;
  align-items: center;
  padding: 20px;
  text-align: start;
}

.about_item_text {
  width: 100%;
  padding: 15px 0;
  border-bottom: 1px solid lightgray;
}

.about_recap {
  width: 95%;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: space-between;
  font-size: 24px;
  margin: auto;
}

.fas {
  width: 100px;
  font-size: 2.1em;
  padding-bottom: 20px;
}

.about_recap a {
  text-decoration: none;
  color: whitesmoke;
  padding-bottom: 10px;
}

@media screen and (max-width: 768px) {

  .about_item {
    width: fit-content;
  }

  .about_recap {
    gap: 10px;
    width: fit-content;
  }
}
</style>
