<template>
  <div id="skills">
    <div v-for="skill in skills" :key="skill.id" class="skill_item">
      <i class="fas fa-check-square " style="color: dodgerblue; font-size: 2.0em;"></i>
      <div class="item_content">
        <div class="item_top">
          <h2> {{ skill.skill_title }} </h2>
          <i class="fas fa-star " style="color: #a88715; font-size: .7em"></i>
        </div>
        <p>{{ skill.skill_description }}</p>
        <div class="skill-bar">
          <div id="backend" :style="{width: skill.skill_level +'%' }" class="skill-fill">
          </div>
          <div class="endball"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import profilerService from "@/services/ProfilerService";

export default {
  name: "Skill",
  data() {
    return {
      skills: [],
    }
  },
  created() {
    profilerService.getItem('skill', 'profiler_infos_id', 1)
        .then(
            response => {
              this.skills = response.data.data;
            })
        .catch(
            error => {
              console.log(error.response);
            })
  }
}
</script>

<style scoped>
#skills {
  padding: 8% 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  background-color: white;
  font-size: 1.2em;
  height: 650px;
  overflow-x: hidden;
  scroll-behavior: smooth;
  gap: 30px;
  border-radius: 0 0 10px 10px;
}

.skill_item {
  width: 85%;
  display: flex;
  gap: 32px;
  color: black;
  padding: 10px 0;
  margin: auto;
}

.item_content {
  width: 100%;
  display: flex;
  flex-direction: column;
  gap: 10px;
  text-align: start;
}

.item_top {
  width: 100%;
  display: inline-flex;
  flex-direction: row;
  align-items: center;
  justify-content: space-between;
}

.skill-bar {
  width: 100%;
  height: 10px;
  border-radius: 10px;
  background-color: gray;
  display: flex;
}

.skill-fill {
  width: 90%;
  height: inherit;
  background-color: #015F9F;
  border-radius: 10px;
}

.endball {
  width: 20px;
  height: 20px;
  border-radius: 100%;
  background-color: #015F9F;
  align-self: center;
  margin-left: -10px;
}
</style>
