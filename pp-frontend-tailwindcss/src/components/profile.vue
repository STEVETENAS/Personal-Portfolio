<template>
  <div id="profile_body" class="md:h-[320px] w-full min-w-[250px] bg-no-repeat bg-center bg-cover"
        :style="{ 'background-image': 'url(' + user.background_image + ')' }">
    <div id="profile_bg" class="w-full h-full space-y-8 xl:space-y-12  backdrop-blur-sm bg-blue-400/30 py-8 text-gray-100">
      
      <div id="searchGroup" class="w-[85%] flex justify-between m-auto items-center min-w-[250px] bg-white dark:bg-slate-600 p-2 rounded text-gray-400 dark:text-gray-200">
        <i class="fas fa-bars hover:text-black"></i>
        <input id="searchBar" class="text-center w-[70%] text-gray-700 dark:bg-slate-700 rounded" placeholder="Need a software Developer?" type="text">
        <div class="flex items-center">
          <i class="fas fa-search hover:text-black"></i>
          <i class="far fa-horizontal-rule rotate-90"></i>
          <i class="fas fa-times hover:text-black" @click="cleared"></i>
        </div>
      </div>

      <div class="w-[85%] m-auto xl:flex space-y-4 items-center">
        <img :src="user.profiler_image" alt="TENAS image"
          class="rounded-full w-2/5 xl:w-1/3 m-auto border-4">
        <div class="justify-start">
          <p class="text-2xl font-bold">{{ user.first_name }} {{ user.last_name }}</p>
          <i>{{ user.profession }}</i>
        </div>
      </div>

      <i id="share" @click="vueModal" class="fas fa-paper-plane p-4 text-lg bg-red-600 hover:bg-red-800 rounded-full absolute -bottom-8 right-4"></i>
    
    </div>
    <teleport to="#app">
      <div v-if="isShowModal" class="w-full h-full fixed z-50 bg-blue-900/50 xl:inset-0 modal-zone">
        <div class="bg-gray-100 w-[fit-content] relative mx-auto my-16 rounded p-4 modal-container">
          <i class="fas fa-times absolute -top-2 -right-2 hover:bg-red-500 hover:text-white rounded-full bg-gray-200 p-2" title="close" @click="vueModal"></i>
          <form class="space-y-4" @submit.prevent="sendMail">
            <div class="flex flex-col items-start text-xl space-y-2">
              <label for="email">Email:</label>
              <input type="email" name="email" id="email" placeholder="example@email.com" class="rounded p-2 text-center text-xl" autofocus>
            </div>

            <div class="flex justify-around space-x-2">
              <input type="radio" name="attachment" id="pdf" checked>
              <label for="pdf" class="label">
                <i class="faa fa fa-file-pdf" aria-hidden="true"></i>
                <span>PDF</span>
              </label>
              <input type="radio" name="attachment" id="img">
              <label for="img" class="label">
                <i class="faa fas fa-image" aria-hidden="true"></i>
                <span>IMG</span>
              </label>
            </div>
            <button type="submit" id="email-btn" class="bg-blue-600 rounded text-xl text-white p-2 hover:bg-blue-800">
              <div v-if="loading" class="flex items-center space-x-2">
                <i class="fas fa-paper-plane"></i>
                <p>Send</p>
              </div>
              <div v-else class="flex items-center space-x-2">
                <i class="fa fa-spinner fa-spin"></i>
                <p>Sending...</p>
              </div>
            </button>
          </form>
        </div>
      </div>
    </teleport>
  </div>
</template>

<script>
import ProfilerService from "../../src/services/ProfilerService.js";

export default {
  name: "profile",
  data() {
    return {
      user: [],
      isShowModal:false,
      loading: true,
    }
  },
  created() {
    ProfilerService.getResponse('info', 1)
        .then(
            response => {
              this.user = response.data.data;
            })
        .catch(
            error => {
              console.log(error.response);
            })
  },
  methods: {
    cleared() {
      document.getElementById("searchBar").value = '';
    },
    vueModal(){
      this.isShowModal = ! this.isShowModal;
    },
    sendMail(){
      this.loading = false;
      let email = document.getElementById('email').value;

      if (document.getElementById('img').checked){
        ProfilerService.getResponse('sendMailIMG', email)
            .then(response => {
                  response.data ? alert('mail sent to' + email): alert('mail not sent');
                  this.vueModal();})
            .catch(error => { console.log(error.response); this.loading = false;});
      }
      else {
        ProfilerService.getResponse('sendMailPDF', email)
            .then(response => {
              response.data ? alert('mail sent to ' + email): alert('mail not sent');
              this.vueModal();})
            .catch(error => { console.log(error.response); this.loading = false;});
      }

    }
  }
}
</script>

<style scoped>
.modal-zone{
  animation-name: fadeIn;
  animation-duration: 1.4s;
  -webkit-animation-name: fadeIn;
  -webkit-animation-duration: 1.4s;
}

.modal-container{
  -webkit-animation-name: slideIn;
  -webkit-animation-duration: 1.4s;
  animation-name: slideIn;
  animation-duration: 1.4s
}
input[type="radio"]{
  -webkit-appearance: none;
}
.label{
  height: 5rem;
  width: 7rem;
  border: 6px solid #2563e9;
  margin: auto;
  padding: 44px;
  border-radius: 10px;
  position: relative;
  color: #2563e9;
  transition: 0.5s;
}

.faa {
  font-size: 40px;
  position: absolute;
  top: 55%;
  left: 50%;
  transform: translate(-50%, -80%);
}

label>span {
  font-size: 15px;
  font-family: "Poppins", sans-serif;
  font-weight: 500;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, 80%);
}

input[type="radio"]:checked + label {
  background-color: #2563e9;
  color: #ffffff;
  box-shadow: 0 15px 45px rgb(160, 162, 164);
}
</style>
