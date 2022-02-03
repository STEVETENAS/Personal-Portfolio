<script>
import ProfilerService from "../../src/services/ProfilerService.js";
import aboutModal from "./modalComponents/aboutModal.vue";
import ResidentModal from "./modalComponents/residentModal.vue";
import TelephoneModal from "./modalComponents/telephoneModal.vue";
import EmailModal from "./modalComponents/emailModal.vue";

export default {
  name: "About",
  components:{
    EmailModal,
    TelephoneModal,
    ResidentModal,
      aboutModal
  },
  data() {
    return {
      user: [],
      medicals: [],
      residents: [],
      contracts: [],
      projects: [],
      telephones: [],
      emails: [],
      exps: [],
      isShowUserModal: false,
      isShowResidentModal: false,
      isShowTelModal: false,
      isShowEmailModal: false,
      id: 1,
      item: null,
    }
  },
  created() {
    ProfilerService.getResponse('info', this.id)
        .then(response => { this.user = response.data.data;})
        .catch(error => { console.log(error.response);})

    ProfilerService.getResponse('medical', this.id)
        .then(response => { this.medicals = response?.data?.data; })
        .catch( error => { console.log(error?.response); })

    ProfilerService.getResponse('resident', this.id)
        .then( response => {this.residents = response?.data?.data;})
        .catch( error => {console.log(error.response);})

    ProfilerService.getResponse('telephone', this.id)
        .then( response => {this.telephones = response?.data?.data;})
        .catch( error => { console.log(error.response);})

    ProfilerService.getResponse('email', this.id)
        .then( response => { this.emails = response?.data?.data; })
        .catch( error => { console.log(error.response);})

    ProfilerService.getItem('project','profiler_info_id', this.id)
        .then( response => { this.projects = response?.data?.data;})
        .catch( error => { console.log(error.response);})

    ProfilerService.getItem('contract','profiler_info_id', this.id)
        .then( response => { this.contracts = response?.data?.data; })
        .catch( error => { console.log(error.response);})

    ProfilerService.getResponse('exp', this.id)
        .then( response => { this.exps = response?.data?.data; })
        .catch( error => { console.log(error.response);})
  },
  methods: {
    toggleModal(id) { this.item = id; this.isShowUserModal = !this.isShowUserModal;},
    refreshAboutComponent() {
      ProfilerService.getResponse('info', 1)
          .then(response => { this.user = response?.data?.data; })
          .catch( error => { console.log(error?.response);})
    },

    toggleModal1(id) { this.item = id; this.isShowResidentModal = !this.isShowResidentModal;},
    refreshResidentComponent() {
      ProfilerService.getResponse('resident', 1)
          .then(response => { this.residents = response?.data?.data; })
          .catch( error => { console.log(error?.response);})
    },

    toggleModal2(id) { this.item = id; this.isShowTelModal = !this.isShowTelModal;},
    refreshTelComponent() {
      ProfilerService.getResponse('telephone', 1)
          .then(response => { this.telephones = response?.data?.data; })
          .catch( error => { console.log(error?.response);})
    },

    toggleModal3(id) { this.item = id; this.isShowEmailModal = !this.isShowEmailModal;},
    refreshEmailComponent() {
      ProfilerService.getResponse('email', 1)
          .then(response => { this.emails = response?.data?.data; })
          .catch( error => { console.log(error?.response);})
    },

  }
}
</script>
<template>
  <div class="min-h-[400px] bg-blue-600 dark:bg-slate-600 md:overflow-scroll scrollbar-hide">
    <div id="about_body" class="h-full text-white text-xl w-full pt-4 justify-between">
      <div id="item-1" @click="toggleModal(user.id)" class="flex items-center w-full px-6 py-2 m-auto hover:bg-blue-700 dark:hover:bg-slate-500">
        <i class="fas fa-birthday-cake text-4xl pr-8" ></i>
        <div class="text-left border-b-2 py-2 w-full">
          <p>Born on : {{ user.date_of_birth }}</p>
          <p>Tribe : {{ user.place_of_origin }}</p>
          <p>Married : {{ user.married ? "Yes" : "No" }} -
            Health : <span :title="medicals.medical_status"> {{
                medicals.length ? medicals.length + ' issues' : "RAS"
              }} </span></p>
        </div>
        <teleport to="#app">
          <about-modal v-if="isShowUserModal" :id="item" :isShowModal="toggleModal" @refresh="refreshAboutComponent"/>
        </teleport>
      </div>

      <div id="item-2" @click="toggleModal1(residents.id)" class="flex items-center w-full px-6 py-2 m-auto hover:bg-blue-700 dark:hover:bg-slate-500">
        <i class="fas fa-map-marker-alt text-4xl pr-8"></i>
        <div class="text-left border-b-2 py-2 w-full">
          <p>Resident at : {{ residents.place_of_residence }}</p>
          <p>{{ residents.city_of_residence }} - {{ residents.country_of_residence }}</p>
          <p>Map:
            <small>
              {{ residents.residence_latitude }},
              {{ residents.residence_longitude }}
            </small>
          </p>
        </div>
        <teleport to="#app">
          <resident-modal v-if="isShowResidentModal" :id="item" :isShowModal="toggleModal1" @refresh="refreshResidentComponent"/>
        </teleport>
      </div>

      <div id="item-3" @click="toggleModal2(telephones.id)" class="flex items-center w-full px-6 py-2 m-auto hover:bg-blue-700 dark:hover:bg-slate-500">
        <i class="fas fa-phone-alt text-3xl pr-8"></i>
        <div class="text-left border-b-2 py-2 w-full">
          <p>{{ telephones.profiler_phone_number }}</p>
          <small>{{ telephones.phone_number_description }}</small>
        </div>
        <teleport to="#app">
          <telephone-modal v-if="isShowTelModal" :id="item" :isShowModal="toggleModal2" @refresh="refreshTelComponent"/>
        </teleport>
      </div>

      <div id="item-4" @click="toggleModal3(emails.id)" class="flex items-center w-full px-6 py-2 m-auto hover:bg-blue-700 dark:hover:bg-slate-500">
        <i class="fas fa-envelope text-3xl pr-8"></i>
        <div class="text-left border-b-2 py-2 w-full">
          <p>{{ emails.profiler_email }}</p>
          <small>{{ emails.email_description }}</small>
        </div>
        <teleport to="#app">
          <email-modal v-if="isShowEmailModal" :id="item" :isShowModal="toggleModal3" @refresh="refreshEmailComponent"/>
        </teleport>
      </div>

      <div id="item-5" class="w-full flex justify-around pt-6 text-sm">
        <a href="#" class="hover:border-b-4 hover:border-red-400 ">+ {{ projects.length }} PROJECTS</a>
        <a href="#" class="hover:border-b-4 hover:border-red-400 ">+ {{ contracts.length }} CONTRACTS</a>
        <a href="#" class="hover:border-b-4 hover:border-red-400 ">+ {{ (new Date().getFullYear() - new Date(exps.job_start_date).getFullYear()) + 1 }} WORK YEARS</a>
      </div>

    </div>
  </div>
</template>
