<script setup>
// This starter template is using Vue 3 <script setup> SFCs
// Check out https://v3.vuejs.org/api/sfc-script-setup.html#sfc-script-setup
import Profile from "./components/profile.vue";
</script>

<template>
  <div id="appContainer" class="dark:dark">
    <div id="container" class="container m-auto py-8">
      <div id="profile" class="bg-red-500">
        <profile></profile>
      </div>
      <div id="about" class="bg-blue-400">swsw</div>
      <div id="skills" class="bg-green-500">df</div>
      <div id="rightSide" class="bg-yellow-500">fsd</div>
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
