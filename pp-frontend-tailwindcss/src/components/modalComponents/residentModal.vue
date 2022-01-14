<template>
  <div class="w-full h-full fixed z-50 bg-blue-900/50 xl:inset-0 modal-zone">
    <div class="bg-gray-100 w-4/5 md:w-1/3 relative mx-auto my-16 rounded p-4 modal-container">
      <i class="fas fa-times absolute -top-2 -right-2 hover:bg-red-500 hover:text-white rounded-full bg-gray-200 p-2" title="close" @click="isShowModal"></i>
      <form @submit.prevent="modalAction" class="space-y-2 overflow-y-scroll scrollbar-hide">
        <p id="error-signal" hidden class="p-2 bg-red-300 rounded text-red-600 text-center"> An Error occurred! </p>
        <div class="flex flex-col items-start text-xl space-y-1">
          <label>PLace of residence: *</label>
          <input id="place_of_residence" v-model="Resident.place_of_residence" autofocus name="place_of_residence"
                 placeholder="Place of residence" required
                 class="w-full text-center p-2 rounded" type="text">
          <p v-if="errors.place_of_residence" class="text-sm text-red-500 pb-2">{{ errors.place_of_residence[0] }}</p>
        </div>

        <div class="flex flex-col items-start text-xl space-y-1">
          <label>City of residence: *</label>
          <input id="city_of_residence" v-model="Resident.city_of_residence" autofocus name="city_of_residence"
                 placeholder="City of residence" required
                 class="w-full text-center p-2 rounded" type="text">
          <p v-if="errors.city_of_residence" class="text-sm text-red-500 pb-2">{{ errors.city_of_residence[0] }}</p>
        </div>

        <div class="flex flex-col items-start text-xl space-y-1">
          <label>Country of residence: *</label>
          <input id="country_of_residence" v-model="Resident.country_of_residence" autofocus name="country_of_residence"
                 placeholder="Country of residence" required
                 class="w-full text-center p-2 rounded" type="text">
          <p v-if="errors.country_of_residence" class="text-sm text-red-500 pb-2">{{ errors.country_of_residence[0] }}</p>
        </div>

        <div class="flex flex-col items-start text-xl space-y-1">
          <label>Profiler: *</label>
          <select v-model="Resident.profiler_info_id" class="w-full text-center p-2 rounded" name="profiler_info_id" id="profiler_info_id">
            <option v-for="profiler in profilers" :key="profiler.id" :value="profiler.id">
              {{ profiler['first_name'] }}
            </option>
          </select>
          <p v-if="errors.profiler_info_id" class="text-sm text-red-500 pb-2">{{ errors.profiler_info_id[0] }}</p>
        </div>

        <div class="flex flex-col items-start text-xl space-y-1">
          <label>Residence Latitude:</label>
          <input id="latitude" v-model="Resident.residence_latitude" autofocus name="residence_latitude"
                 title="Latitude"
                 class="w-full text-center p-2 rounded" type="number" step="0.000001">
          <p v-if="errors.residence_latitude" class="text-sm text-red-500 pb-2">{{ errors.residence_latitude[0] }}</p>
        </div>

        <div class="flex flex-col items-start text-xl space-y-1">
          <label>Residence longitude:</label>
          <input id="longitude" v-model="Resident.residence_longitude" autofocus name="residence_longitude"
                 title="Latitude"
                 class="w-full text-center p-2 rounded" type="number" step="0.000001">
          <p v-if="errors.residence_longitude" class="text-sm text-red-500 pb-2">{{ errors.residence_longitude[0] }}</p>
        </div>


        <input v-if="id" title="edit" type="submit" value="Edit" class="w-full bg-blue-700 rounded p-2 text-gray-50">
        <input v-else title="save" type="submit" value="Save" class="w-full bg-blue-700 rounded p-2 text-gray-50">
      </form>
    </div>
  </div>
</template>

<script>
import profilerService from "../../services/ProfilerService";

export default {
  name: "residentModal",
  props: {
    id: undefined,
    isShowModal: Function
  },
  data() {
    return {
      errors: [],
      profilers: [],
      Resident: {
        place_of_residence: null,
        city_of_residence: null,
        country_of_residence: null,
        residence_longitude: null,
        residence_latitude: null,
        profiler_info_id: null,
      },
    }
  },
  created() {
    if (this.id) {
      profilerService.getResponse('resident', this.id)
          .then((response) => { this.Resident = response?.data?.data; })
          .catch((error) => { console.log(error?.response?.data);})
    }
    profilerService.getResponses('info')
        .then((response) => { this.profilers = response?.data?.data;})
        .catch((error) => { console.log(error?.response?.data);})
  },
  methods: {
    async modalAction() {
      this.errors = [];
      if (this.id){
        await profilerService.apiClient.put('resident/'+this.id+'/', this.Resident)
            .then((response) => {
              this.Resident = {
                place_of_residence: null,
                city_of_residence: null,
                country_of_residence: null,
                residence_longitude: null,
                residence_latitude: null,
                profiler_info_id: null,
              };
              this.isShowModal()
              this.$emit('refresh', response?.data?.data);
            })
            .catch((error) => {
              this.errors = error?.response?.data?.errors;
              document.getElementById('error-signal').style.display = 'block';
            });
        return 1;
      }
      await profilerService.apiClient.post('resident', this.Resident)
          .then((response) => {
            this.Resident = {
              place_of_residence: null,
              city_of_residence: null,
              country_of_residence: null,
              residence_longitude: null,
              residence_latitude: null,
              profiler_info_id: null,
            };
            this.isShowModal()
            this.$emit('refresh', response?.data?.data);
          })
          .catch((error) => {
            this.errors = error?.response?.data.errors;
            document.getElementById('error-signal').style.display = 'block';
          });
    },
  }
}
</script>

<style scoped>

</style>