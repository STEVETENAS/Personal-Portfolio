<template>
  <div id="profile_body"
       v-bind:style="{ 'background-image': 'url('+'http://127.0.0.1:8000' + user.background_image + ')' }">
    <div class="profile_bg">
      <div class="searchbar">
        <i class="fas fa-bars"></i>
        <input id="searchBar" class="borderless" placeholder="Need a software Developer?" type="text">
        <div class="rightSide">
          <i class="fas fa-search"></i>
          <i class="far fa-horizontal-rule" style="transform: rotate(90deg);"></i>
          <i class="fas fa-times" @click="cleared"></i>
        </div>
      </div>

      <div class="userInfo">
        <img :src="'http://127.0.0.1:8000'+user.profiler_image" alt="TENAS img" class="profile_img">
        <div>
          <h2>{{ user.first_name }} {{ user.last_name }}</h2>
          <i>{{ user.profession }}</i>
        </div>
      </div>

      <i class="fas fa-paper-plane absolute_img" style=" "></i>
    </div>
  </div>
</template>

<script>
import ProfilerService from "@/services/ProfilerService";

export default {
  name: "profile",
  data() {
    return {
      user: [],
    }
  },
  created() {
    ProfilerService.getResponse('info', 1)
        .then(
            response => {
              this.user = response.data.data;
            })
        .catch(
            error => {
              console.log(error.response);
            })
  },
  methods: {
    cleared() {
      document.getElementById("searchBar").value = '';
    }
  }
}

</script>

<style scoped>
#profile_body {
  width: 100%;
  height: 300px;
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
  border-radius: 10px 10px 0 0;
}

.profile_bg {
  height: 100%;
  width: 100%;
  -webkit-backdrop-filter: blur(6px);
  backdrop-filter: blur(6px);
  box-shadow: inset 0 0 0 200px rgba(62, 92, 172, 0.578);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  align-items: center;
  color: whitesmoke;
  position: relative;
  border-radius: 10px 10px 0 0;
}

.searchbar {
  width: 85%;
  height: 40px;
  display: flex;
  align-items: center;
  background-color: whitesmoke;
  color: gray;
  border-radius: 5px;
  justify-content: space-between;
  padding: 1px 15px;
  font-size: 1.2em;
  margin: 15px auto;
}

input[type=text] {
  width: 65%;
  border: none;
  background-color: transparent;
  text-align: center;
  padding: 10px 1px;
}

.rightSide {
  display: flex;
  align-items: center;
  color: gray;
}

.userInfo {
  width: 85%;
  display: flex;
  align-items: center;
  margin-bottom: 5%;
  gap: 20px;
  text-align: start;
}

.profile_img {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  border: 2px solid #eae9e9;
}

.absolute_img {
  position: absolute;
  bottom: -12%;
  right: 6%;
  color: white;
  font-size: 1.2em;
  background-color: #cb4747;
  border-radius: 50%;
  padding: 20px 15px;
}

.absolute_img:hover {
  background-color: #c96d6d;
}

@media screen and (max-width: 768px) {
  #profile_body {
    height: 320px;
  }

  .userInfo {
    margin-bottom: 12%;
    display: flex;
    flex-direction: column;
    text-align: center;
    gap: 15px;
  }

  .profile_img {
    margin-top: 20px;
    width: 100px;
    height: 100px;
  }

  .fas {
    font-size: .8em;
  }

  .absolute_img {
    font-size: 1.5em;
    bottom: -30px;
  }

  .searchbar {
    padding: 1px 10px;
  }

}
</style>
