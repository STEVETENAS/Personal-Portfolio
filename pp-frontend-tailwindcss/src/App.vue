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
  <div id="appContainer" class="dark:dark">
    <div id="container" class="container m-auto py-8">
      <div id="profile">
        <profile></profile>
      </div>
      <div id="about">
        <about></about>
      </div>
      <div id="skills">
        <skills></skills>
      </div>
      <div id="rightSide" class="space-y-4">
        <experience></experience>
        <Pi_lang></Pi_lang>
        <Academic></Academic>
      </div>
    </div>
  </div>
</template>

<style>
*{
  padding: 0;
  margin: 0;
}
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
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
    margin: 0;
    padding: 0;
  }
}
</style>
