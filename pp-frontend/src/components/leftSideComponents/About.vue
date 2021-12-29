<template>
  <div id="about_body">
    <div id="item-1" class="about_item">
      <i class="fas fa-birthday-cake" @click="toggleModal(user.id)"></i>
      <div class="about_item_text">
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

    <div id="item-2" class="about_item">
      <i class="fas fa-map-marker-alt" @click="toggleModal1(resident.id)"></i>
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
      <teleport to="#app">
        <resident-modal v-if="isShowResidentModal" :id="id" :isShowResidentModal="toggleModal1" :resError="errors"/>
      </teleport>
    </div>

    <div id="item-3" class="about_item">
      <i class="fas fa-phone-alt" @click="toggleModal2(telephone.id)"></i>
      <div class="about_item_text">
        <p>{{ telephone.profiler_phone_number }}</p>
        <small>{{ telephone.phone_number_description }}</small>
      </div>
      <teleport to="#app">
        <telephone-modal v-if="isShowTelModal" :id="id" :isShowTelModal="toggleModal2" :telError="errors"/>
      </teleport>
    </div>

    <div id="item-4" class="about_item">
      <i class="fas fa-envelope" @click="toggleModal3(email.id)"></i>
      <div class="about_item_text">
        <p>{{ email.profiler_email }}</p>
        <small>{{ email.email_description }}</small>
      </div>
      <teleport to="#app">
        <email-modal v-if="isShowEmailModal" :id="id" :emailError="errors" :isShowEmailModal="toggleModal3"/>
      </teleport>
    </div>

    <div id="item-5" class="about_recap">
      <a href="#">+ {{ project.length }} PROJECTS</a>
      <a href="#">+ {{ contract.length }} CONTRACTS</a>
      <a href="#">+ {{ new Date(exp.job_start_date).getFullYear() - new Date().getFullYear() + 1 }} WORK YEARS</a>
    </div>

  </div>
</template>

<script>

import ProfilerService from "@/services/ProfilerService";
import aboutModal from "@/components/modalComponents/AboutModal";
import residentModal from "@/components/modalComponents/ResidentModal";
import telephoneModal from "@/components/modalComponents/TelephoneModal";
import emailModal from "@/components/modalComponents/EmailModal";


export default {
  name: "About",
  components: {
    aboutModal,
    residentModal,
    telephoneModal,
    emailModal,
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

<style scoped>

#about_body {
  width: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  background-color: #015F9F;
  color: #f1f1f1;
  padding-top: 2%;
}

.about_item {
  width: 85%;
  margin: auto;
  display: flex;
  align-items: center;
  text-align: start;
}

.about_item_text {
  width: 100%;
  padding: 16px 0;
  border-bottom: 1px solid lightgray;
}

.about_recap {
  width: 100%;
  padding-top: 8%;
  display: flex;
  align-items: center;
  justify-content: space-around;
  font-size: .6em;
}

.fas {
  width: 70px;
  font-size: 2em;
}

.about_recap a {
  text-decoration: none;
  color: whitesmoke;
  padding-bottom: 5px;
}

.about_recap a:hover {
  border-bottom: 5px solid #B2717E;
}
</style>
