<template>
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
    <div id="rightSide">
      <experience></experience>
      <pi_Lang></pi_Lang>
      <academic></academic>
    </div>
  </div>
</template>

<script>
import profile from "@/components/leftSideComponents/Profile";
import about from "@/components/leftSideComponents/About";
import skill from "@/components/leftSideComponents/Skill";
import experience from "@/components/rightSideComponents/Experience";
import pi_Lang from "@/components/rightSideComponents/Pi_Lang";
import academic from "@/components/rightSideComponents/Academic";


export default {
  name: 'App',
  components: {
    profile,
    about,
    skill,
    experience,
    pi_Lang,
    academic,
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
  background-color: #dbdbd2;
  position: relative;
}
.grid-container {
  width: 90%;
  margin: 1% auto;
  display: grid;
  grid-auto-columns: 35% auto;
  grid-template:
    'profile rightSide'
    'about rightSide'
    'skills  rightSide';
}

#profile {
  width: 100%;
  grid-area: profile;
  min-width: 270px;
}

#about {
  width: 100%;
  grid-area: about;
  min-width: 270px;
}

#skills {
  grid-area: skills;
  min-width: 270px;
  width: 100%;
  border-radius: 0 0 10px 10px;
}

#rightSide {
  width: 100%;
  height: 100%;
  grid-area: rightSide;
  margin-left: 1%;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 22px;
  background-color: #d9d9d0;
}

@media screen and (max-width: 768px) {
  * {
    margin: 0;
    padding: 0;
  }

  .grid-container {
    width: 100%;
    margin: auto;
    padding: 0;
    display: grid;
    grid-auto-columns: 100%;
    grid-template:
    'profile'
    'skills'
    'rightSide'
    'about';
  }

  #profile {
    width: 100%;
    height: 320px;
  }

  #skills {
    width: 100%;
  }

  #about {
    width: 100%;
  }

  #rightSide {
    width: 100%;
    margin-left: 0;
  }

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

</style>
