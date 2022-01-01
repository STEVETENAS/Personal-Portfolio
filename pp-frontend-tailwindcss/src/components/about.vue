<script>
import ProfilerService from "../../src/services/ProfilerService.js";
import aboutModal from "./modalComponents/aboutModal.vue";

export default {
  name: "About",
  components:{
      aboutModal
  },
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
      errors: [],
      isShowModal: false,
      isShowResidentModal: false,
      isShowTelModal: false,
      isShowEmailModal: false,
      id: undefined
    }
  },
  created() {
    ProfilerService.getResponse('info', 1)
        .then(
            response => {
              this.user = response.data.data;
              this.profileId = response.data.data.id;
            })
        .catch(
            error => {
              this.errors = error.response;
              console.log(error.response);
            })

    ProfilerService.getItem('medical', 'profiler_infos_id', this.profileId)
        .then(
            response => {
              this.medical = response.data.data;
            })
        .catch(
            error => {
              this.errors = error.response;
              console.log(error.response);
            })

    ProfilerService.getItem('resident', 'profiler_infos_id', 1)
        .then(
            response => {
              this.resident = response.data.data[0];
            })
        .catch(
            error => {
              this.errors = error.response;
              console.log(error.response);
            })

    ProfilerService.getItem('telephone', 'profiler_infos_id', 1)
        .then(
            response => {
              this.telephone = response.data.data[0];
            })
        .catch(
            error => {
              this.errors = error.response;
              console.log(error.response);
            })
    ProfilerService.getItem('email', 'profiler_infos_id', 1)
        .then(
            response => {
              this.email = response.data.data[0];
            })
        .catch(
            error => {
              this.errors = error.response;
              console.log(error.response);
            })
    ProfilerService.getItem('project', 'profiler_infos_id', 1)
        .then(
            response => {
              this.project = response.data.data;
            })
        .catch(
            error => {
              this.errors = error.response;
              console.log(error.response);
            })
    ProfilerService.getItem('contract', 'profiler_infos_id', 1)
        .then(
            response => {
              this.contract = response.data.data;
            })
        .catch(
            error => {
              this.errors = error.response;
              console.log(error.response);
            })
    ProfilerService.getItem('exp', 'profiler_infos_id', 1)
        .then(
            response => {
              this.exp = response.data.data[0];
            })
        .catch(
            error => {
              this.errors = error.response;
              console.log(error.response);
            })
  },
  methods: {
    toggleModal(id) {
      this.id = id;
      this.isShowModal = !this.isShowModal;
    },
    toggleModal1(id) {
      this.id = id;
      this.isShowResidentModal = !this.isShowResidentModal;
    },
    toggleModal2(id) {
      this.id = id;
      this.isShowTelModal = !this.isShowTelModal;
    },
    toggleModal3(id) {
      this.id = id;
      this.isShowEmailModal = !this.isShowEmailModal;
    },
  }
}
</script>
<template>
  <div id="about_body" class="bg-blue-600 dark:bg-slate-600 text-white text-2xl w-full pt-6 px-2 space-y-4">
    <div id="item-1" class="flex items-center w-11/12 m-auto">
      <i class="fas fa-birthday-cake text-4xl pr-8" @click="toggleModal(user.id)"></i>
      <div class="text-left border-b-2 py-2 w-full">
        <p>Born on : {{ user.date_of_birth }}</p>
        <p>Tribe : {{ user.place_of_origin }}</p>
        <p>Married : {{ user.married ? "Yes" : "No" }} -
          Health : <span :title=" medical.medical_status"> {{
              medical.length ? medical.length + ' issues' : "RAS"
            }} </span></p>
      </div>
      <teleport to="#app">
        <about-modal v-if="isShowModal" :id="id" :abtError="errors" :isShowModal="toggleModal"/>
      </teleport>
    </div>

    <div id="item-2" class="flex items-center w-11/12 m-auto">
      <i class="fas fa-map-marker-alt text-4xl pr-8" @click="toggleModal1(resident.id)"></i>
      <div class="text-left border-b-2 py-2 w-full">
        <p>Resident at : {{ resident.place_of_residence }}</p>
        <p>{{ resident.city_of_residence }} - {{ resident.country_of_residence }}</p>
        <p>Map:
          <small>
            {{ resident.residence_latitude }},
            {{ resident.residence_longitude }}
          </small>
        </p>
      </div>
      <teleport to="#app">
        <resident-modal v-if="isShowResidentModal" :id="id" :isShowResidentModal="toggleModal1" :resError="errors"/>
      </teleport>
    </div>

    <div id="item-3" class="flex items-center w-11/12 m-auto">
      <i class="fas fa-phone-alt text-3xl pr-8" @click="toggleModal2(telephone.id)"></i>
      <div class="text-left border-b-2 py-2 w-full">
        <p>{{ telephone.profiler_phone_number }}</p>
        <small>{{ telephone.phone_number_description }}</small>
      </div>
      <teleport to="#app">
        <telephone-modal v-if="isShowTelModal" :id="id" :isShowTelModal="toggleModal2" :telError="errors"/>
      </teleport>
    </div>

    <div id="item-4" class="flex items-center w-11/12 m-auto">
      <i class="fas fa-envelope text-3xl pr-8" @click="toggleModal3(email.id)"></i>
      <div class="text-left border-b-2 py-2 w-full">
        <p>{{ email.profiler_email }}</p>
        <small>{{ email.email_description }}</small>
      </div>
      <teleport to="#app">
        <email-modal v-if="isShowEmailModal" :id="id" :emailError="errors" :isShowEmailModal="toggleModal3"/>
      </teleport>
    </div>

    <div id="item-5" class="w-full flex justify-around pt-6 text-sm">
      <a href="#" class="hover:border-b-4 hover:border-red-400 ">+ {{ project.length }} PROJECTS</a>
      <a href="#" class="hover:border-b-4 hover:border-red-400 ">+ {{ contract.length }} CONTRACTS</a>
      <a href="#" class="hover:border-b-4 hover:border-red-400 ">+ {{ (new Date().getFullYear() - new Date(exp.job_start_date).getFullYear()) + 1 }} WORK YEARS</a>
    </div>

  </div>
</template>
