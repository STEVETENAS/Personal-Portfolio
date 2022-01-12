<script>
import profilerService from "../../services/ProfilerService";

export default {
  name: "aboutModal",
  props: {
    id: undefined,
    isShowModal: Function
  },
  data() {
    return {
      errors: [],
      profilers: [],
      Info: {
        first_name: null,
        last_name: null,
        profession: null,
        gender: null,
        place_of_birth: null,
        place_of_origin: null,
        date_of_birth: null,
        number_of_children: null,
        married: null,
        profiler_image: null,
        background_image: null,
      },
    }
  },
  created() {
    if (this.id) {
      profilerService.getResponse('info', this.id)
          .then((response) => { this.Info = response?.data?.data; })
          .catch((error) => { console.log(error?.response?.data);})
    }
  },
  methods: {
    async modalAction() {
      this.errors = [];
      if (this.id){
        await profilerService.apiClient.put('info/'+ this.id +'/', this.Info)
            .then((response) => {
              this.Info = {
                first_name: null,
                last_name: null,
                profession: null,
                gender: null,
                place_of_birth: null,
                place_of_origin: null,
                date_of_birth: null,
                number_of_children: null,
                married: null,
                profiler_image: null,
                background_image: null,
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
      await profilerService.apiClient.post('info', this.Info)
          .then((response) => {
            this.Info = {
              first_name: null,
              last_name: null,
              profession: null,
              gender: null,
              place_of_birth: null,
              place_of_origin: null,
              date_of_birth: null,
              number_of_children: null,
              married: null,
              profiler_image: null,
              background_image: null,
            };
            this.isShowModal()
            this.$emit('refresh', response?.data?.data);
          })
          .catch((error) => {
            this.errors = error?.response?.data.errors;
            document.getElementById('error-signal').style.display = 'block';
          });
    },
    imageName(path){
      let n = path.lastIndexOf('/');
      return  path.substring(n + 1);
    }

  }
}
</script>

<template>
  <div class="w-full h-full fixed z-50 bg-blue-900/50 xl:inset-0 modal-zone">
    <div class="bg-gray-100 w-[fit-content] relative mx-auto my-16 rounded p-4 modal-container">
      <i class="fas fa-times absolute -top-2 -right-2 hover:bg-red-500 hover:text-white rounded-full bg-gray-200 p-2" title="close" @click="isShowModal"></i>
      <form @submit.prevent="modalAction" class="space-y-2">
        <p id="error-signal" hidden class="p-2 bg-red-300 rounded text-red-600 text-center"> An Error occurred! </p>
        <div class="flex gap-2">
          <div class="space-y-2 w-full">
            <div class="flex flex-col items-start text-xl space-y-1">
              <label>First Name: *</label>
              <input id="first_name" v-model="Info.first_name" autofocus name="first_name"
                     placeholder="First name" required
                     class="w-full text-center p-2 rounded" type="text">
              <p v-if="errors.first_name" class="text-sm text-red-500 pb-2">{{ errors.first_name[0] }}</p>

              <div class="flex flex-col items-start text-xl space-y-1 w-full">
                <label>Place of birth: *</label>
                <input id="place_of_birth" v-model="Info.place_of_birth" autofocus name="place_of_birth"
                       placeholder="place of birth" required
                       class="w-full text-center p-2 rounded" type="text">
                <p v-if="errors.place_of_birth" class="text-sm text-red-500 pb-2">{{ errors.place_of_birth[0] }}</p>
              </div>

              <div class="flex flex-col items-start text-xl space-y-1 w-full">
                <label>Profession: *</label>
                <input id="profession" v-model="Info.profession" autofocus name="profession"
                       placeholder="Profession" required
                       class="w-full text-center p-2 rounded" type="text">
                <p v-if="errors.profession" class="text-sm text-red-500 pb-2">{{ errors.profession[0] }}</p>
              </div>

              <div class="flex flex-col items-start text-xl space-y-1 w-full">
                <label>Place of origin: *</label>
                <input id="place_of_origin" v-model="Info.place_of_origin" autofocus name="place_of_origin"
                       placeholder="Place of origin" required
                       class="w-full text-center p-2 rounded" type="text">
                <p v-if="errors.place_of_origin" class="text-sm text-red-500 pb-2">{{ errors.place_of_origin[0] }}</p>
              </div>

              <div class="flex flex-col items-start text-xl space-y-1 w-full">
                <label>Profile Picture: *</label>
                <input id="profiler_image" autofocus name="profiler_image" title="profile image"
                       class="w-full text-center p-2 rounded" type="file" accept="image/png, image/gif, image/jpeg, image/jpg">

                <p v-if="Info.profiler_image"> {{imageName(Info.profiler_image)}} </p>
                <p v-if="errors.profiler_image" class="text-sm text-red-500 pb-2">{{ errors.profiler_image[0] }}</p>
              </div>

            </div>
          </div>

          <div class="space-y-2 w-full">
            <div class="flex flex-col items-start text-xl space-y-1 w-full">
              <label>Last Name: *</label>
              <input id="last_name" v-model="Info.last_name" autofocus name="last_name"
                     placeholder="Last name" required
                     class="w-full text-center p-2 rounded" type="text">
              <p v-if="errors.last_name" class="text-sm text-red-500 pb-2">{{ errors.last_name[0] }}</p>
            </div>

            <div class="flex flex-col items-start text-xl space-y-1 w-full">
              <label>Date of Birth:</label>
              <input id="date_of_birth" v-model="Info.date_of_birth" autofocus name="date_of_birth"
                     title="Date of birth"
                     class="w-full text-center p-2 rounded" type="date">
              <p v-if="errors.date_of_birth" class="text-sm text-red-500 pb-2">{{ errors.date_of_birth[0] }}</p>
            </div>


            <div class="flex flex-col items-start text-xl space-y-1">
              <label>Number of kids:</label>
              <input id="number_of_children" v-model="Info.number_of_children" autofocus name="number_of_children"
                     title="Number of kids"
                     class="w-full text-center p-2 rounded" type="number" min="0">
              <p v-if="errors.number_of_children" class="text-sm text-red-500 pb-2">{{ errors.number_of_children[0] }}</p>
            </div>

            <div class="flex items-start text-xl space-y-1">
              <label>Gender : </label>
              <div class="flex items-center gap-2">
                <input type="radio" id="male" name="gender" value="male" v-model="Info.gender">
                <label for="male">Male</label>

                <input type="radio" id="female" name="gender" value="female" v-model="Info.gender">
                <label for="female">Female</label>
              </div>
            </div>

            <div class="flex items-start text-xl space-y-1 w-full">
              <label>Married : </label>
              <div class="flex items-center gap-2">
                <input type="radio" id="yes" name="married" value="true" v-model="Info.married">
                <label for="yes">yes</label>

                <input type="radio" id="no" name="married" value="false" v-model="Info.married" checked>
                <label for="no">no</label>
              </div>
            </div>

            <div class="flex flex-col items-start text-xl space-y-1">
              <label>Background Picture: *</label>
              <input id="background_image" autofocus name="background_image" title="background image"
                     class="w-full text-center p-2 rounded" type="file" accept="image/png, image/gif, image/jpeg, image/jpg">

              <p v-if="Info.background_image"> {{imageName(Info.background_image)}} </p>
              <p v-if="errors.background_image" class="text-sm text-red-500 pb-2">{{ errors.background_image[0] }}</p>
            </div>

          </div>
        </div>
        <input v-if="id" title="edit" type="submit" value="Edit" class="w-full bg-blue-700 rounded p-2 text-gray-50">
        <input v-else title="save" type="submit" value="Save" class="w-full bg-blue-700 rounded p-2 text-gray-50">
      </form>
    </div>
  </div>
</template>