<template>
  <link crossorigin="anonymous" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" rel="stylesheet"/>
  <div class="grid-container">
    <div id="profile">
      <profile></profile>
    </div>
    <div id="about">
      about
    </div>
    <div id="skills">
      skill
    </div>
    <div id="exp">
      exp
    </div>
    <div id="pi_lag">
      pi_lang
    </div>
    <div id="academic">
      academic
    </div>
  </div>
</template>

<script>
import profile from "@/components/leftSideComponents/Profile";

export default {
  name: 'App',
  components: {
    profile,
  }
}
</script>

<style>
* {
  margin: 0;
  padding: 0;
}

#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  display: flex;
  margin: auto;
}

.grid-container {
  width: 100%;
  height: 100%;
  display: grid;
  grid-template:
    'profile profile exp exp exp'
    'about about exp exp exp'
    'about about piLang piLang piLang'
    'skills skills academic academic academic'
    'skills skills academic academic academic';
}

#profile {
  grid-area: profile;
  background-color: #015F9F;
  margin-right: 1%;
  min-width: 200px;
}

#about {
  grid-area: about;
  background-color: #d7a02d;
  margin-right: 1%;
}

#skills {
  grid-area: skills;
  background-color: #cd2727;
  margin-right: 1%;
}

#exp {
  grid-area: exp;
  background-color: #5a6f92;
}

#pi_lag {
  grid-area: piLang;
  background-color: #e9f807;
}

#academic {
  grid-area: academic;
  background-color: #16d226;
}

@media screen and (max-width: 480px) {
  .grid-container {
    width: 100%;
    height: 100%;
    display: grid;
    grid-template:
    'profile'
    'skills'
    'exp'
    'piLang'
    'academic'
    'about'
  }

  #profile {
    width: 100%;
  }

  #skills {
    width: 100%;
  }

  #about {
    width: 100%;
  }
}
</style>
