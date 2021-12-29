<template>
  <div class="modalZone">
    <div class="modalContainer">
      <i class="fas fa-times" title="close" @click="isShowResidentModal"></i>
      <form action="" method="post">
        <div class="form-group">
          <label>Place of residence:</label>
          <input id="place_of_residence" :value=" resident.place_of_residence ? resident.place_of_residence : null"
                 autofocus name="place_of_residence" placeholder="Place of residence" required
                 type="text">
          <p v-if="!resError.place_of_residence">{{ resError.place_of_residence }}</p>
        </div>

        <div class="form-group">
          <label>City of residence:</label>
          <input id="city_of_residence" :value=" resident.city_of_residence ? resident.city_of_residence: null"
                 autofocus name="city_of_residence" placeholder="City of residence" required
                 type="text">
          <p v-if="!resError.city_of_residence">{{ resError.city_of_residence }}</p>
        </div>

        <div class="form-group">
          <label>Country of residence:</label>
          <input id="country_of_residence" :value=" resident.country_of_residence ? resident.country_of_residence: null"
                 autofocus name="country_of_residence" placeholder="Country of residence"
                 type="text">
          <p v-if="!resError.country_of_residence">{{ resError.country_of_residence }}</p>
        </div>

        <div class="form-group">
          <label>Residence longitude:</label>
          <input id="residence_longitude" :value=" resident.residence_longitude ? resident.residence_longitude: null"
                 autofocus name="residence_longitude" placeholder="Residence longitude" required
                 type="number">
          <p v-if="!resError.residence_longitude">{{ resError.residence_longitude }}</p>
        </div>

        <div class="form-group">
          <label>Residence latitude:</label>
          <input id="residence_latitude" :value=" resident.residence_latitude ? resident.residence_latitude: null"
                 autofocus name="residence_latitude" placeholder="Residence latitude" required
                 type="number">
          <p v-if="!resError.residence_latitude">{{ resError.residence_latitude }}</p>
        </div>

        <div class="form-group">
          <select>
            <option v-for="profiler in profilers" :key="profiler.id" :value="profiler.first_name">
              {{ profiler.first_name }}
            </option>
          </select>
          <p v-if="!resError.profiler_infos_id">{{ resError.profiler_infos_id }}</p>
        </div>

        <input title="save" type="submit" value="Save">
      </form>
    </div>
  </div>
</template>

<script>
import profilerService from "@/services/ProfilerService";

export default {
  name: "ResidentModal",
  props: {
    id: Number,
    resError: Object,
    isShowResidentModal: Function
  },
  data() {
    return {
      profilers: [],
      resident: Object,
    }
  },
  created() {
    if (this.id !== undefined) {
      profilerService.getResponse('resident', this.id)
          .then(
              response => {
                this.resident = response.data.data;
              }
          )
          .catch(
              error => {
                console.log(error.response);
              }
          )
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

}
</script>

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
    margin: 600% auto;
    padding: 8% 1%;
  }
}
</style>
