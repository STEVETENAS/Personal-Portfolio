<template>
  <div class="modalZone">
    <div class="modalContainer">
      <i class="fas fa-times" title="close" @click="isShowTelModal"></i>
      <form action="" method="post">
        <div class="form-group">
          <label>Profiler phone number:</label>
          <input id="profiler_phone_number"
                 :value=" telephone.profiler_phone_number ? telephone.profiler_phone_number : null" autofocus
                 name="profiler_phone_number" placeholder="Profiler phone number" required
                 type="tel">
          <p v-if="!telError.profiler_phone_number">{{ telError.profiler_phone_number }}</p>
        </div>

        <div class="form-group">
          <select>
            <option v-for="profiler in profilers" :key="profiler.id" :value="profiler.first_name">
              {{ profiler.first_name }}
            </option>
          </select>
          <p v-if="!telError.profiler_infos_id">{{ telError.profiler_infos_id }}</p>
        </div>

        <div class="form-group">
          <label>Description:</label>
          <textarea id="phone_number_description"
                    :value="telephone.phone_number_description ? telephone.phone_number_description : null"
                    name="phone_number_description" placeholder="telephone description"
                    rows="4">
          </textarea>
          <p v-if="!telError.phone_number_description">{{ telError.phone_number_description }}</p>
        </div>

        <input title="save" type="submit" value="Save">
      </form>
    </div>
  </div>
</template>

<script>
import profilerService from "@/services/ProfilerService";

export default {
  name: "TelephoneModal",
  props: {
    id: Number,
    telError: Object,
    isShowTelModal: Function
  },
  data() {
    return {
      profilers: [],
      telephone: Object,
    }
  },
  created() {
    if (this.id !== undefined) {
      profilerService.getResponse('telephone', this.id)
          .then(
              response => {
                this.telephone = response.data.data;
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
