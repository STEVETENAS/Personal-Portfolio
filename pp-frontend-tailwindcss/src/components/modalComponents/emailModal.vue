<template>
  <div class="w-full h-full fixed z-50 bg-blue-900/50 xl:inset-0 modal-zone">
    <div class="bg-gray-100 w-4/5 md:w-1/3 relative mx-auto my-16 rounded p-4 modal-container">
      <i class="fas fa-times absolute -top-2 -right-2 hover:bg-red-500 hover:text-white rounded-full bg-gray-200 p-2" title="close" @click="isShowModal"></i>
      <form @submit.prevent="modalAction" class="space-y-2">
        <p id="error-signal" hidden class="p-2 bg-red-300 rounded text-red-600 text-center"> An Error occurred! </p>
        <div class="flex flex-col items-start text-xl space-y-1">
          <label>Email address: *</label>
          <input id="profiler_email" v-model="Email.profiler_email" autofocus name="profiler_email"
                 placeholder="exampl@me.see" required
                 class="w-full text-center p-2 rounded" type="email">
<!--          <p v-if="errors.profiler_email" class="text-sm text-red-500 pb-2">{{ errors.profiler_email[0] }}</p>-->
        </div>


        <div class="flex flex-col items-start text-xl space-y-1">
          <label>Profiler: *</label>
          <select v-model="Email.profiler_info_id" class="text-center p-2 rounded" name="profiler_info_id" id="profiler_info_id">
            <option v-for="profiler in profilers" :key="profiler.id" :value="profiler.id">
              {{ profiler['first_name'] }}
            </option>
          </select>
<!--          <p v-if="errors.profiler_info_id" class="text-sm text-red-500 pb-2">{{ errors.profiler_info_id[0] }}</p>-->
        </div>

        <div class="flex flex-col items-start text-xl space-y-1">
          <label>Description: *</label>
          <textarea id="email_description" v-model="Email.email_description" name="email_description" required
                    placeholder="Email description" class="w-full text-center p-2 rounded" rows="4">
          </textarea>
<!--          <p v-if="errors.email_description" class="text-sm text-red-500 pb-2">{{ errors.email_description[0] }}</p>-->
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
  name: "emailModal",
  props: {
    id: undefined,
    isShowModal: Function
  },
  data() {
    return {
      errors: {
        profiler_email: null,
        email_description: null,
        profiler_info_id: null,
      },
      profilers: [],
      Email: {
        profiler_email: null,
        email_description: null,
        profiler_info_id: null,
      },
    }
  },
  created() {
    if (this.id) {
      profilerService.getResponse('email', this.id)
          .then((response) => { this.Email = response?.data?.data; })
          .catch((error) => { console.log(error?.response?.data);})
    }
    profilerService.getResponses('info')
        .then((response) => { this.profilers = response?.data?.data;})
        .catch((error) => { console.log(error?.response?.data);})
  },
  methods: {
    async modalAction() {
      // this.errors = [];
      if (this.id){
        await profilerService.apiClient.put('email/'+this.id+'/', this.Email)
            .then((response) => {
              this.Email = {
                profiler_phone_number: null,
                phone_number_description: null,
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
      await profilerService.apiClient.post('email', this.Email)
          .then((response) => {
            this.Email = {
              profiler_phone_number: null,
              phone_number_description: null,
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