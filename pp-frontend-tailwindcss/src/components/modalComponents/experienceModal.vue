<template>
  <div class="w-full h-full fixed z-50 bg-blue-900/50 xl:inset-0 modal-zone">
    <div class="bg-gray-100 w-4/5 md:w-3/5 relative mx-auto my-16 rounded p-4 modal-container">
      <i class="fas fa-times absolute -top-2 -right-2 hover:bg-red-500 hover:text-white rounded-full bg-gray-200 p-2" title="close" @click="isShowModal"></i>
      <form @submit.prevent="modalAction" class="space-y-2 overflow-scroll scrollbar-hide">
        <p id="error-signal" hidden class="w-full p-2 bg-red-300 rounded text-red-600 text-center"> An Error occurred! </p>
        <div class="flex flex-col xl:flex-row items-center justify-between space-x-2 p-4">
          <div class="w-1/2 min-w-[250px]">
            <div class="flex flex-col items-start text-xl space-y-1">
              <label>Job Title: *</label>
              <input id="job_title" v-model="Experience.job_title" autofocus name="job_title"
                     placeholder="Job title" required
                     class="w-full text-center p-1 rounded" type="text">
              <p v-if="errors.job_title" class="text-sm text-red-500 pb-2">{{ errors.job_title[0] }}</p>
            </div>

            <div class="flex flex-col items-start text-xl space-y-1">
              <label>Company Name: *</label>
              <input id="company_name" v-model="Experience.company_name" autofocus name="company_name"
                     placeholder="Company Name" required
                     class="w-full text-center p-1 rounded" type="text">
              <p v-if="errors.company_name" class="text-sm text-red-500 pb-2">{{ errors.company_name[0] }}</p>
            </div>

            <div class="flex flex-col items-start text-xl space-y-1">
              <label>Company Website: </label>
              <input id="company_website" v-model="Experience.company_website" autofocus name="company_website"
                     placeholder="Company Website"
                     class="w-full text-center p-1 rounded" type="text">
              <p v-if="errors.company_website" class="text-sm text-red-500 pb-2">{{ errors.company_website[0] }}</p>
            </div>

          </div>
          <div class="w-1/2 min-w-[250px] flex flex-col">
            <div class="flex flex-col items-start text-xl space-y-1">
              <label>Started on: *</label>
              <input id="job_start_date" v-model="Experience.job_start_date" autofocus name="job_start_date" title="Start date"
                     required class="w-full text-center p-1 rounded" type="date">
              <p v-if="errors.job_start_date" class="text-sm text-red-500 pb-2">{{ errors.job_start_date[0] }}</p>
            </div>

            <div class="flex flex-col items-start text-xl space-y-1">
              <label>Finished on:</label>
              <input id="job_end_date" v-model="Experience.job_end_date" autofocus name="job_end_date"
                     title="Finished Date"
                     class="w-full text-center p-1 rounded" type="date">
              <p v-if="errors.job_end_date" class="text-sm text-red-500 pb-2">{{ errors.job_end_date[0] }}</p>
            </div>

            <div class="flex flex-col items-start text-xl space-y-1">
              <label>Profiler: *</label>
              <select v-model="Experience.profiler_info_id" class="w-full text-center p-2 rounded" name="profiler_info_id" id="profiler_info_id">
                <option v-for="profiler in profilers" :key="profiler.id" :value="profiler.id">
                  {{ profiler['first_name'] }}
                </option>
              </select>
              <p v-if="errors.profiler_info_id" class="text-sm text-red-500 pb-2">{{ errors.profiler_info_id[0] }}</p>
            </div>

          </div>
        </div>

        <div class="flex flex-col items-start text-xl space-y-1">
          <label>Description:   </label>
          <textarea id="job_description" v-model="Experience.job_description" name="job_description"
                    placeholder="Job Description" class="w-full h-28 text-center p-1 rounded ">
          </textarea>
          <p v-if="errors.job_description" class="text-sm text-red-500 pb-2">{{ errors.job_description[0] }}</p>
        </div>

        <input v-if="id" title="edit" type="submit" value="Edit" class="w-full bg-blue-700 rounded p-2 text-gray-50">
        <input v-else title="save" type="submit" value="Save" class=" w-full bg-blue-700 rounded p-2 text-gray-50">
      </form>
    </div>
  </div>
</template>

<script>
import profilerService from "../../services/ProfilerService";

export default {
  name: "experienceModal.vue",
  props: {
    id: undefined,
    isShowModal: Function
  },
  data() {
    return {
      errors: [],
      profilers: [],
      Experience: {
        job_title: null,
        company_name: null,
        company_website: null,
        job_start_date: null,
        job_end_date: null,
        profiler_info_id: null,
        job_description: null,
      },
    }
  },
  created() {
    if (this.id) {
      profilerService.getResponse('exp', this.id)
          .then((response) => { this.Experience = response?.data?.data; })
          .catch((error) => { console.log(error?.response?.data);})
    }
    profilerService.getResponses('info')
        .then((response) => { this.profilers = response?.data?.data;})
        .catch((error) => { console.log(error?.response?.data);})
  },
  methods:{
    async modalAction() {
      this.errors = [];
      if (this.id){
        await profilerService.apiClient.put('exp/'+this.id+'/', this.Experience)
            .then((response) => {
              this.Experience = {
                job_title: null,
                company_name: null,
                company_website: null,
                job_start_date: null,
                job_end_date: null,
                profiler_info_id: null,
                job_description: null,
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
      await profilerService.apiClient.post('exp', this.Experience)
          .then((response) => {
            this.Experience = {
              job_title: null,
              company_name: null,
              company_website: null,
              job_start_date: null,
              job_end_date: null,
              profiler_info_id: null,
              job_description: null,
            };
            this.isShowModal()
            this.$emit('refresh', response?.data?.data);
          })
          .catch((error) => {
            this.errors = error?.response?.data.errors;
            document.getElementById('error-signal').style.display = 'block';
          });
    },
  },
}
</script>

<style scoped>

</style>