<template>
  <div class="modalZone">
    <div class="modalContainer">
      <i class="fas fa-times" title="close" @click="isShowEmailModal"></i>
      <form action="" method="post">
        <div class="form-group">
          <label>Profiler email:</label>
          <input id="profiler_email" :value=" email.profiler_email ? email.profiler_email : null" autofocus
                 name="profiler_email" placeholder="Profiler email" required
                 type="text">
          <p v-if="!emailError.profiler_email">{{ emailError.profiler_email }}</p>
        </div>

        <div class="form-group">
          <select>
            <option v-for="profiler in profilers" :key="profiler.id" :value="profiler.first_name">
              {{ profiler.first_name }}
            </option>
          </select>
          <p v-if="!emailError.profiler_infos_id">{{ emailError.profiler_infos_id }}</p>
        </div>

        <div class="form-group">
          <label>Description:</label>
          <textarea id="email_description" :value="email.email_description ? email.email_description : null"
                    name="email_description" placeholder="Email description"
                    rows="4">
          </textarea>
          <p v-if="!emailError.email_description">{{ emailError.email_description }}</p>
        </div>

        <input title="save" type="submit" value="Save">
      </form>
    </div>
  </div>
</template>

<script>
import profilerService from "@/services/ProfilerService";

export default {
  name: "EmailModal",
  props: {
    id: Number,
    emailError: Object,
    isShowEmailModal: Function
  },
  data() {
    return {
      profilers: [],
      email: Object,
    }
  },
  created() {
    if (this.id !== undefined) {
      profilerService.getResponse('email', this.id)
          .then(
              response => {
                this.email = response.data.data;
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
