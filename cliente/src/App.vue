<template>
  <div class="page" id="app">
    <Navbar />
    <router-view />
  </div>
</template>

<script>
import Vue from "vue";
import Navbar from "./components/Layout/Navbar";
import Router from "vue-router";

Vue.use(Router);
Vue.filter('toUpperCase',function(value){
  return value.toUpperCase();
})

export default {
  name: "App",
  components: {
    Navbar  
    }
};
</script>

<style scoped>
@import "./CSS/index.css";
@import "./CSS/fonts.css";
@import "./CSS/colors.css";
@import "./CSS/module.css";
#app {
  
  background-color: rgb(32, 32, 32);
  color: white;
  min-height: 100vh;
}
</style>