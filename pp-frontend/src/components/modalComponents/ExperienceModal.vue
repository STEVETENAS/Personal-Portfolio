<template>
  <div class="modalZone">
    <div class="modalContainer">
      <i class="fas fa-times" title="close" @click="isShowModal"></i>
      <form action="" method="post">
        <div class="form-group">
          <label>Job Title:</label>
          <input id="job_title" :value=" expInfo.job_title ? expInfo.job_title : null" autofocus name="job_title"
                 placeholder="Job title" required
                 type="text">
          <p v-if="!expsError.job_title">{{ expsError.job_title }}</p>
        </div>
        <div class="form-group">
          <label>Company Name:</label>
          <input id="company_name" :value=" expInfo.company_name ? expInfo.company_name: null" autofocus
                 name="company_name" placeholder="Company name" required
                 type="text">
          <p v-if="!expsError.company_name">{{ expsError.company_name }}</p>
        </div>
        <div class="form-group">
          <label>Company website:</label>
          <input id="company_website" :value=" expInfo.company_website ? expInfo.company_website: null" autofocus
                 name="company_website" placeholder="Link / Company website"
                 type="text">
          <p v-if="!expsError.company_website">{{ expsError.company_website }}</p>
        </div>
        <div class="form-group">
          <label>Job Start Date:</label>
          <input id="job_start_date" :value=" expInfo.job_start_date ? expInfo.job_start_date: null" autofocus
                 name="job_start_date" placeholder="Job start Date" required
                 type="date">
          <p v-if="!expsError.job_start_date">{{ expsError.job_start_date }}</p>
        </div>
        <div class="form-group">
          <label>Job End Date:</label>
          <input id="job_end_date" :value=" expInfo.job_end_date ? expInfo.job_end_date: null" autofocus
                 name="job_start_date" placeholder="Job end Date" required
                 type="date">
          <p v-if="!expsError.job_end_date">{{ expsError.job_end_date }}</p>
        </div>
        <div class="form-group">
          <select>
            <option v-for="profiler in profilers" :key="profiler.id" :value="profiler.first_name">
              {{ profiler.first_name }}
            </option>
          </select>
          <p v-if="!expsError.profiler_infos_id">{{ expsError.profiler_infos_id }}</p>
        </div>
        <input title="save" type="submit" value="Save">
      </form>
    </div>
  </div>
</template>

<script>

import profilerService from "@/services/ProfilerService";

export default {
  name: "ExperienceModal",
  props: {
    id: Number,
    expsError: Object,
    isShowModal: Function
  },
  data() {
    return {
      profilers: [],
      expInfo: Object,
    }
  },
  created() {
    if (this.id !== undefined) {
      profilerService.getResponse('exp', this.id)
          .then(
              response => {
                this.expInfo = response.data.data;
              }
          )
          .catch(
              error => {
                console.log(error.response);
              }
          )
    }
    profilerService.getResponses('info')
        .then(
            response => {
              this.profilers = response.data.data;
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

<style>
.modalZone {
  z-index: 1;
  height: 100%;
  width: 100%;
  -webkit-backdrop-filter: blur(6px);
  backdrop-filter: blur(6px);
  box-shadow: inset 0 0 0 900px rgba(47, 58, 87, 0.4);
  position: absolute;
  animation-name: fadeIn;
  animation-duration: 0.4s;
  -webkit-animation-name: fadeIn;
  -webkit-animation-duration: 1.4s;
}

.modalContainer {
  width: 25em;
  background-color: #f1f1f1;
  border-radius: 20px;
  display: flex;
  flex-direction: column;
  position: relative;
  margin: 10% auto;
  padding: 2% 1%;
  -webkit-animation-name: slideIn;
  -webkit-animation-duration: 0.4s;
  animation-name: slideIn;
  animation-duration: 0.4s
}

form {
  display: flex;
  flex-direction: column;
  gap: 16px;
  align-items: start;
  margin: auto;
}

.form-group {
  display: flex;
  flex-direction: column;
  align-items: start;
  gap: 4px;
}


input[type=date] {
  font-size: 1.3em;
}

input[type=submit] {
  background-color: #015F9F;
  color: white;
  width: 100%;
}

select {
  width: 260px;
  padding: 4px;
  font-size: 1.1em;
  outline-color: #015F9F;
}

textarea {
  width: 250px;
  padding: 4px;
  font-size: 1.1em;
  outline-color: #015F9F;
}

@-webkit-keyframes slideIn {
  from {
    bottom: -300px;
    opacity: 0
  }
  to {
    bottom: 0;
    opacity: 1
  }
}

@keyframes slideIn {
  from {
    bottom: -300px;
    opacity: 0
  }
  to {
    bottom: 0;
    opacity: 1
  }
}

@-webkit-keyframes fadeIn {
  from {
    opacity: 0
  }
  to {
    opacity: 1
  }
}

@keyframes fadeIn {
  from {
    opacity: 0
  }
  to {
    opacity: 1
  }
}
</style>

<style scoped>

input {
  width: 250px;
  padding: 4px;
  border-radius: 4px;
  font-size: 1.1em;
  outline-color: #015F9F;
}

.fas {
  position: absolute;
  color: red;
  right: 12px;
  top: 12px;
  font-size: 1.5em;
}

.fas:hover {
  font-size: 2em;
}

@media screen and (max-width: 768px) {
  .modalZone {
    z-index: 1;
    height: 100%;
    width: 100%;
    padding: 4%;
  }

  .modalContainer {
    width: 18em;
    border-radius: 20px;
    margin: 350% auto;
    padding: 8% 1%;
  }
}
</style>
