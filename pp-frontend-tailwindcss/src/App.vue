<script setup>
// This starter template is using Vue 3 <script setup> SFCs
// Check out https://v3.vuejs.org/api/sfc-script-setup.html#sfc-script-setup
import Profile from "./components/profile.vue";
import About from "./components/about.vue";
import Skills from "./components/skills.vue";
import Experience from "./components/experience.vue";
import Pi_lang from "./components/pi_lang.vue";
import Academic from "./components/academic.vue";
</script>

<template>
  <div id="container" class="w-full h-full dark:dark container m-auto py-12">
    <div id="profile">
      <profile />
    </div>
    <div id="about">
      <about/>
    </div>
    <div id="skills">
      <skills/>
    </div>
    <div id="rightSide" class="space-y-4">
      <experience/>
      <Pi_lang/>
      <Academic/>
    </div>
  </div>
</template>

<style>
*{
  padding: 0;
  margin: 0;
}
#app {
  font-family: Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
}
body{
  height: 100%;
  width: 100%;
}

#container{
  display: grid;
  grid-column-gap: 1%;
  grid-auto-columns: 35% auto;
  grid-template:
    'profile rightSide'
    'about rightSide'
    'skills rightSide'
}

#profile {
  grid-area: profile;
}
#about {
  grid-area: about;
}
#skills {
  grid-area: skills;
}
#rightSide {
  grid-area: rightSide;
}

/* width */
::-webkit-scrollbar {
  width: 5px;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey;
  border-radius: 10px;
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: rgba(89, 110, 139, 0.78);
  border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #015F9F;
}

@-webkit-keyframes slideIn {
  from {
    bottom: -300px;
    opacity: 0
  }
  to {
    bottom: 0;
    opacity: 1
  }
}

@keyframes slideIn {
  from {
    bottom: -300px;
    opacity: 0
  }
  to {
    bottom: 0;
    opacity: 1
  }
}

@-webkit-keyframes fadeIn {
  from {
    opacity: 0
  }
  to {
    opacity: 1
  }
}

@keyframes fadeIn {
  from {
    opacity: 0
  }
  to {
    opacity: 1
  }
}

@media screen and (max-width: 768px) {
  #container {
    width: 100%;
    display: grid;
    grid-auto-columns: 100%;
    grid-template:
    'profile'
    'skills'
    'rightSide'
    'about';
    margin: auto;
    padding: 0;
    row-gap: 5px;
  }
}
</style>
