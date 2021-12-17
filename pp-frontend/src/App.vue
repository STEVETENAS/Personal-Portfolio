<template>
  <link crossorigin="anonymous" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" rel="stylesheet"/>
  <div class="grid-container">
    <div id="profile">
      <profile></profile>
    </div>
    <div id="about">
      <about></about>
    </div>
    <div id="skills">
      <skill></skill>
    </div>
    <div id="exp">
      <experience></experience>
    </div>
    <div id="pi_lang">
      <pi_Lang></pi_Lang>
    </div>
    <div id="academic">
      <academic></academic>
    </div>
  </div>
</template>

<script>
import profile from "@/components/leftSideComponents/Profile";
import about from "@/components/leftSideComponents/About";
import skill from "@/components/leftSideComponents/Skill";
import experience from "@/components/rightSideComponents/Experience";
import academic from "@/components/rightSideComponents/Academic";
import pi_Lang from "@/components/rightSideComponents/Pi_Lang";


export default {
  name: 'App',
  components: {
    profile,
    about,
    skill,
    experience,
    academic,
    pi_Lang
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
  display: grid;
  grid-template:
    'profile profile exp exp exp'
    'about about exp exp exp'
    'about about piLang piLang piLang'
    'skills skills academic academic academic'
    'skills skills academic academic academic';
  background-color: #dbdbd2;
}

#profile {
  grid-area: profile;
  margin-right: 1%;
  min-width: 200px;
  background-color: #dbdbd2;
}

#about {
  grid-area: about;
  margin-right: 1%;
  background-color: #dbdbd2;
}

#skills {
  grid-area: skills;
  margin-right: 1%;
  background-color: #dbdbd2;
}

#exp {
  grid-area: exp;
  background-color: #dbdbd2;
}

#pi_lang {
  grid-area: piLang;
  background-color: #dbdbd2;
}

#academic {
  grid-area: academic;
  background-color: #dbdbd2;
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

  #academic {
    width: 100%;
  }

  #pi_lang {
    width: 100%;
  }

  #exp {
    width: 100%;
  }
}
</style>
