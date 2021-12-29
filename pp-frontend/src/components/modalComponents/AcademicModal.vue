<template>
  <div class="modalZone">
    <div class="modalContainer">
      <i class="fas fa-times" title="close" @click="isShowModal"></i>
      <form @submit.prevent="storeAcademic">
        <div class="form-group">
          <label>Diploma Title:</label>
          <input id="diploma_title" v-model="Academic.diploma_title" autofocus name="diploma_title"
                 placeholder="diploma title" required
                 type="text">
          <p v-if="!acaError.diploma_title">{{ acaError.diploma_title }}</p>
        </div>

        <div class="form-group">
          <label>Institution Attended:</label>
          <input id="institution_attended" v-model="Academic.institution_attended" autofocus name="institution_attended"
                 placeholder="institution attended" required
                 type="text">
          <p v-if="!acaError.institution_attended">{{ acaError.institution_attended }}</p>
        </div>

        <div class="form-group">
          <label>Started on:</label>
          <input id="started_on" v-model="Academic.started_on" autofocus name="started_on" placeholder="Start date"
                 required
                 type="date">
          <p v-if="!acaError.started_on">{{ acaError.started_on }}</p>
        </div>

        <div class="form-group">
          <label>Finished on:</label>
          <input id="finished_on" v-model="Academic.finished_on" autofocus name="finished_on"
                 placeholder="Finished Date" required
                 type="date">
          <p v-if="!acaError.finished_on">{{ acaError.finished_on }}</p>
        </div>

        <div class="form-group">
          <select>
            <option v-for="profiler in profilers" :key="profiler.id" :value="profiler.first_name">
              {{ profiler.first_name }}
            </option>
          </select>
          <p v-if="!acaError.profiler_infos_id">{{ acaError.profiler_infos_id }}</p>
        </div>

        <div class="form-group">
          <label>Description:</label>
          <textarea id="diploma_description" v-model="Academic.diploma_description" name="diploma_description"
                    placeholder="diploma description"
                    rows="4">
          </textarea>
          <p v-if="!acaError.diploma_description">{{ acaError.diploma_description }}</p>
        </div>

        <input title="save" type="submit" value="Save">
      </form>
    </div>
  </div>
</template>

<script>
import profilerService from "@/services/ProfilerService";

export default {
  name: "AcademicModal",
  props: {
    id: Number,
    acaError: Object,
    isShowModal: Function
  },
  data() {
    return {
      profilers: [],
      Academic: Object,
    }
  },
  created() {
    if (this.id !== undefined) {
      profilerService.getResponse('academic', this.id)
          .then(
              response => {
                this.Academic = response.data.data;
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
  },
  methods: {
    async storeAcademic() {
      await profilerService.apiClient.post(
          'academic',
          {
            diploma_title: "this.Academic.diploma_description",
            institution_attended: "this.Academic.institution_attended",
            started_on: "this.Academic.started_on",
            finished_on: "this.Academic.finished_on",
            profiler_infos_id: " this.Academic.profiler_infos_id"
          })
          .then(function (response) {
            console.log(response);
          })
          .catch(function (error) {
            console.log(error);
          });
    }
  }
}
</script>

<style scoped>
.modalContainer {
  margin: 60% auto;
}

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
    margin: 650% auto;
    padding: 8% 1%;
  }
}

</style>
