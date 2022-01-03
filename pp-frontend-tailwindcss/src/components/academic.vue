<script>
import ProfilerService from "../../src/services/ProfilerService.js";
// import academicModal from "@/components/modalComponents/AcademicModal";

export default {
  name: "academic",
  data() {
    return {
      academics: [],
      acasError: [],
      isShowModal: false,
      id: undefined
    }
  },
  methods: {
    toggleModal(id) {
      this.id = id;
      this.isShowModal = !this.isShowModal;
    }
  },
  created() {
    ProfilerService.getItem('academic', 'profiler_exp', 1).then(
        response => {
          this.academics = response.data.data;
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

<template>
  <div class="">
    <div class="w-full bg-blue-600 dark:bg-slate-700  text-white">
      <div class="w-11/12 m-auto flex justify-between items-center p-2">
        <div class="flex space-x-4 text-left items-center">
          <i class="fas fa-graduation-cap fa-2x"></i>
          <div class="academic_head_txt">
            <p class="text-2xl font-bold">Cursus academique</p>
            <i>Diplomes et formations certifiantes</i>
          </div>
        </div>
        <i class="fas fa-plus-circle fa-2x hover:bg-blue-700 hover:p-2" @click="toggleModal(undefined)"></i>
      </div>
    </div>
    <div class="py-4 w-full h-[320px] overflow-y-scroll bg-gray-50 dark:bg-slate-600">
      <div v-for="aca in academics" :key="aca.id" class="w-11/12 m-auto text-left p-4 border-b-2 text-lg">
        <div class="flex justify-between items-center">
          <p class="text-xl font-semibold"> {{ aca.diploma_title }} - <b>@{{ aca.institution_attended }} </b></p>
          <i id="edit-btn" :title="'Edit ' + aca.diploma_title + ' info'" class="fas fa-edit edit_fas hover:text-blue-600"
             @click="toggleModal(aca.id)"></i>
        </div>
        <p>
          <span class="text-blue-500">{{ aca.finished_on ? aca.finished_on : "to date" }}
          </span> - <span class="desciption">
          <i>{{ aca.diploma_description }}</i></span>
        </p>
      </div>
    </div>
  </div>

  <teleport to="#app">
    <academicModal v-if="isShowModal" :id="id" :acaError="acasError" :isShowModal="toggleModal"/>
  </teleport>

</template>