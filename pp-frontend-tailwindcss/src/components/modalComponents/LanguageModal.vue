<template>
  <div class="w-full h-full fixed z-50 bg-blue-900/50 xl:inset-0 modal-zone">
    <div class="bg-gray-100 w-[fit-content] relative mx-auto my-16 rounded p-4 modal-container">
      <i class="fas fa-times absolute -top-2 -right-2 hover:bg-red-500 hover:text-white rounded-full bg-gray-200 p-2" title="close" @click="isShowModal"></i>
      <form @submit.prevent="modalAction" class="space-y-2">
        <p id="error-signal" hidden class="p-2 bg-red-300 rounded text-red-600 text-center"> An Error occurred! </p>
        <div class="flex flex-col items-start text-xl space-y-1">
          <label>Language Name: *</label>
          <input id="language" v-model="Lang.language" autofocus name="language"
                 placeholder="Language name" required
                 class="w-full text-center p-2 rounded" type="text">
          <p v-if="errors.language" class="text-sm text-red-500 pb-2">{{ errors.language[0] }}</p>
        </div>

        <div class="flex flex-col items-start text-xl space-y-1">
          <label>Language Level: *</label>
          <input id="language_level" v-model="Lang.language_level" autofocus name="language_level"
                 placeholder="Language Level" required
                 class="w-full text-center p-2 rounded" type="number" max="10" min="0">
          <p v-if="errors.language_level" class="text-sm text-red-500 pb-2">{{ errors.language_level[0] }}</p>
        </div>

        <div class="flex flex-col items-start text-xl space-y-1">
          <label>Profiler: *</label>
          <select v-model="Lang.profiler_info_id" class="w-full text-center p-2 rounded" name="profiler_info_id" id="profiler_info_id">
            <option v-for="profiler in profilers" :key="profiler.id" :value="profiler.id">
              {{ profiler['first_name'] }}
            </option>
          </select>
          <p v-if="errors.profiler_info_id" class="text-sm text-red-500 pb-2">{{ errors.profiler_info_id[0] }}</p>
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
  name: "LanguageModal",
  props: {
    id: undefined,
    isShowModal: Function
  },
  data() {
    return {
      errors: [],
      profilers: [],
      Lang: {
        language: null,
        language_level: null,
        profiler_info_id: null,
      },
    }
  },
  created() {
    if (this.id) {
      profilerService.getResponse('lang', this.id)
          .then((response) => { this.Lang = response?.data?.data; })
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
        await profilerService.apiClient.put('lang/'+this.id+'/', this.Lang)
            .then((response) => {
              this.Lang = {
                language: null,
                language_level: null,
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
      await profilerService.apiClient.post('lang', this.Lang)
          .then((response) => {
            this.Lang = {
              language: null,
              language_level: null,
              profiler_info_id: null,
            };
            this.isShowModal()
            this.$emit('refresh', response?.data?.data);
          })
          .catch((error) => {
            this.errors = error?.response?.data?.errors;
            document.getElementById('error-signal').style.display = 'block';
          });
    },
  }
}
</script>

<style scoped>

</style>