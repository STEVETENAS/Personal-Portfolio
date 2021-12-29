<template>
  <div class="modalZone">
    <div class="modalContainer">
      <i class="fas fa-times" title="close" @click="isShowModal"></i>
      <form action="" method="post">
        <div class="form-group">
          <label>First name:</label>
          <input id="first_name" :value=" info.first_name ? info.first_name : null" autofocus name="first_name"
                 placeholder="First name" required
                 type="text">
          <p v-if="!abtError.first_name">{{ abtError.first_name }}</p>
        </div>

        <div class="form-group">
          <label>Last name:</label>
          <input id="last_name" :value=" info.last_name ? info.last_name : null" autofocus name="last_name"
                 placeholder="Last name" required
                 type="text">
          <p v-if="!abtError.last_name">{{ abtError.last_name }}</p>
        </div>

        <div class="form-group" style="display: flex; flex-direction: row">
          <label>Gender:</label>
          <input id="male" :checked="info.gender==='male'" name="male" style="width: 30px" type="radio" value="true">
          <label for="male">male</label>
          <br>
          <input id="female" :checked="info.gender==='female'" name="female" style="width: 30px" type="radio"
                 value="false">
          <label for="female">female</label>
        </div>

        <div class="form-group">
          <label>Date of birth:</label>
          <input id="date_of_birth" :value=" info.date_of_birth ? info.date_of_birth: null" autofocus
                 name="date_of_birth" placeholder="Date of birth" required
                 type="date">
          <p v-if="!abtError.date_of_birth">{{ abtError.date_of_birth }}</p>
        </div>

        <div class="form-group">
          <label>Place of birth:</label>
          <input id="place_of_birth" :value=" info.place_of_birth ? info.place_of_birth: null" autofocus
                 name="place_of_birth" placeholder="Place of birth" required
                 type="text">
          <p v-if="!abtError.place_of_birth">{{ abtError.place_of_birth }}</p>
        </div>

        <div class="form-group">
          <label>Profession:</label>
          <input id="profession" :value=" info.profession ? info.profession: null" autofocus name="profession"
                 placeholder="Profession" required
                 type="text">
          <p v-if="!abtError.profession">{{ abtError.profession }}</p>
        </div>


        <div class="form-group">
          <label>Place of origin:</label>
          <input id="place_of_origin" :value=" info.place_of_origin ? info.place_of_origin: null" autofocus
                 name="place_of_origin" placeholder="Place of origin" required
                 type="text">
          <p v-if="!abtError.place_of_origin">{{ abtError.place_of_origin }}</p>
        </div>

        <div class="form-group" style="display: flex; flex-direction: row">
          <label>Married:</label>
          <input id="yes" :checked="info.married" name="married" style="width: 30px" type="radio" value="true">
          <label for="yes">yes</label>
          <br>
          <input id="no" :checked="info.married" name="married" style="width: 30px" type="radio" value="false">
          <label for="no">no</label>
        </div>

        <div class="form-group">
          <label>Number of children:</label>
          <input id="number_of_children" :value=" info.number_of_children ? info.number_of_children: null" autofocus
                 name="number_of_children" placeholder="Number of children" required
                 type="number">
          <p v-if="!abtError.number_of_children">{{ abtError.number_of_children }}</p>
        </div>

        <div class="form-group">
          <label>Profile Image:</label>
          <input id="profiler_image" autofocus name="profiler_image" placeholder="Profile Image" type="file">
          <p v-if="!abtError.profiler_image">{{ abtError.profiler_image }}</p>
        </div>

        <div class="form-group">
          <label>Background Image:</label>
          <input id="background_image" autofocus name="background_image" placeholder="Background Image" type="file">
          <p v-if="!abtError.background_image">{{ abtError.background_image }}</p>
        </div>

        <input title="save" type="submit" value="Save">
      </form>
    </div>
  </div>
</template>

<script>
import profilerService from "@/services/ProfilerService";

export default {
  name: "AboutModal", props: {
    id: Number,
    abtError: Object,
    isShowModal: Function
  },
  data() {
    return {
      info: Object,
    }
  },
  created() {
    if (this.id !== undefined) {
      profilerService.getResponse('info', this.id)
          .then(
              response => {
                this.info = response.data.data;
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
