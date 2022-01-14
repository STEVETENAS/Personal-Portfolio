<template>
  <div class="w-full h-full fixed z-50 bg-blue-900/50 xl:inset-0 modal-zone">
    <div class="bg-gray-100 w-4/5 md:w-1/3 relative mx-auto my-16 rounded p-4 modal-container">
      <i class="fas fa-times absolute -top-2 -right-2 hover:bg-red-500 hover:text-white rounded-full bg-gray-200 p-2" title="close" @click="isShowModal"></i>
      <form @submit.prevent="modalAction" class="space-y-2 overflow-scroll scrollbar-hide">
        <p id="error-signal" hidden class="p-2 bg-red-300 rounded text-red-600 text-center"> An Error occurred! </p>
        <div class="flex flex-col items-start text-xl space-y-1">
          <label>Diploma Title: *</label>
          <input id="diploma_title" v-model="Academic.diploma_title" autofocus name="diploma_title"
                 placeholder="diploma title" required
                 class="w-full text-center p-2 rounded" type="text">
          <p v-if="errors.diploma_title" class="text-sm text-red-500 pb-2">{{ errors.diploma_title[0] }}</p>
        </div>

        <div class="flex flex-col items-start text-xl space-y-1">
          <label>Institution Attended: *</label>
          <input id="institution_attended" v-model="Academic.institution_attended" autofocus name="institution_attended"
                 placeholder="institution attended" required
                 class="w-full text-center p-2 rounded" type="text">
          <p v-if="errors.institution_attended" class="text-sm text-red-500 pb-2">{{ errors.institution_attended[0] }}</p>
        </div>

        <div class="flex flex-col items-start text-xl space-y-1">
          <label>Started on: *</label>
          <input id="started_on" v-model="Academic.started_on" autofocus name="started_on" title="Start date"
                 required class="w-full text-center p-2 rounded" type="date">
          <p v-if="errors.started_on" class="text-sm text-red-500 pb-2">{{ errors.started_on[0] }}</p>
        </div>

        <div class="flex flex-col items-start text-xl space-y-1">
          <label>Finished on:</label>
          <input id="finished_on" v-model="Academic.finished_on" autofocus name="finished_on"
                 title="Finished Date"
                 class="w-full text-center p-2 rounded" type="date">
          <p v-if="errors.finished_on" class="text-sm text-red-500 pb-2">{{ errors.finished_on[0] }}</p>
        </div>

        <div class="flex flex-col items-start text-xl space-y-1">
          <label>Profiler: *</label>
          <select v-model="Academic.profiler_info_id" class="w-full text-center p-2 rounded" name="profiler_info_id" id="profiler_info_id">
            <option v-for="profiler in profilers" :key="profiler.id" :value="profiler.id">
              {{ profiler['first_name'] }}
            </option>
          </select>
          <p v-if="errors.profiler_info_id" class="text-sm text-red-500 pb-2">{{ errors.profiler_info_id[0] }}</p>
        </div>

        <div class="flex flex-col items-start text-xl space-y-1">
          <label>Description: *</label>
          <textarea id="diploma_description" v-model="Academic.diploma_description" name="diploma_description" required
                    placeholder="diploma description" class="w-full text-center p-2 rounded" rows="4">
          </textarea>
          <p v-if="errors.diploma_description" class="text-sm text-red-500 pb-2">{{ errors.diploma_description[0] }}</p>
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
  name: "academicModal",
  props: {
    id: undefined,
    isShowModal: Function
  },
  data() {
    return {
      errors: [],
      profilers: [],
      Academic: {
        diploma_title: null,
        diploma_description: null,
        institution_attended: null,
        started_on: null,
        finished_on: null,
        profiler_info_id: null,
      },
    }
  },
  created() {
    if (this.id) {
      profilerService.getResponse('academic', this.id)
          .then((response) => { this.Academic = response?.data?.data; })
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
        await profilerService.apiClient.put('academic/'+this.id+'/', this.Academic)
            .then((response) => {
              this.Academic = {
                diploma_title: null,
                diploma_description: null,
                institution_attended: null,
                started_on: null,
                finished_on: null,
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
      await profilerService.apiClient.post('academic', this.Academic)
          .then((response) => {
            this.Academic = {
              diploma_title: null,
              diploma_description: null,
              institution_attended: null,
              started_on: null,
              finished_on: null,
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