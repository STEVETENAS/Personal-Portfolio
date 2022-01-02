<template>
  <section id="academic_body">
    <div class="academic_head">
      <div class="head_body">
        <div class="academic_head_start">
          <i class="fas fa-graduation-cap fa-2x"></i>
          <div class="academic_head_txt">
            <h1>Cursus academique</h1>
            <i>Diplomes et formations certifiantes</i>
          </div>
        </div>
        <i class="fas fa-plus-circle fa-2x" @click="toggleModal(undefined)"></i>
      </div>
    </div>
    <div class="academic_body">
      <div v-for="aca in academics" :key="aca.id" class="academic_item">
        <div class="first_line">
          <h3> {{ aca.diploma_title }} - <b>@{{ aca.institution_attended }} </b></h3>
          <i id="edit-btn" :title="'Edit ' + aca.diploma_title + ' info'" class="fas fa-edit edit_fas"
             @click="toggleModal(aca.id)"></i>
        </div>
        <p>
          <span class="duration">{{ aca.finished_on ? aca.finished_on : "to date" }}
          </span> - <span class="desciption">
          <i>{{ aca.diploma_description }}</i></span>
        </p>
      </div>
    </div>
  </section>
  <teleport to="#app">
    <academicModal v-if="isShowModal" :id="id" :acaError="acaError"
       :isShowModal="toggleModal" @newAcademic="addNewAcademicLine($event)"/>
  </teleport>
</template>

<script>
import profilerService from "@/services/ProfilerService";
import academicModal from "@/components/modalComponents/AcademicModal";

export default {
  name: "Academic",
  components: {
    academicModal
  },
  data() {
    return {
      academics: [],
      acaError: [],
      isShowModal: false,
      id: undefined
    }
  },
  methods: {
    toggleModal(id) {
      this.id = id;
      this.isShowModal = !this.isShowModal;
    },
    addNewAcademicLine(newAcademic) {
      console.log('newAcademic');
      console.log(newAcademic);
      this.academics.push(newAcademic);
    }
  },
  created() {
    profilerService.getItem('academic', 'profiler_exp', 1)
        .then((response) => {
          this.academics = response?.data?.data;
        })
        .catch((error) => {
          console.log(error?.response?.data);
        })
  }
}
</script>

<style scoped>
#academic_body {
  width: 100%;
  height: 100%;
  overflow-y: scroll;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.academic_head {
  width: 100%;
  background-color: #015F9F;
  border-radius: 10px 10px 0 0;
  color: #f1f1f1;
}

.head_body {
  width: 90%;
  margin: auto;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 12px 0;
}

.academic_head_txt {
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  text-align: start;
}

.academic_head_start {
  display: flex;
  flex-direction: row;
  align-items: center;
  gap: 20px;
}

.first_line {
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 100%
}

.academic_body {
  width: 100%;
  height: 100%;
  color: black;
  background-color: white;
  overflow-x: hidden;
  scroll-behavior: smooth;
}

.academic_item {
  width: 90%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: flex-start;
  border-bottom: 2px solid grey;
  text-align: start;
  padding: 15px 0;
  font-size: 1.5em;
  margin: 10px auto;
}

.duration {
  color: #015F9F;
}

.edit_fas {
  color: #015F9F;
}

.edit_fas:hover {
  color: gray;
}

@media screen and (max-width: 768px) {
  #academic_body {
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  .academic_body {
    width: 100%;
    height: 100%;
  }

  .academic_head {
    width: 100%;
    background-color: #015F9F;
    border-radius: 0;
    color: #f1f1f1;
  }
}

</style>
