<template>
  <div class="page" id="app">
    <Navbar />
    <Home />
  </div>
</template>

<script>
import Vue from "vue";
import Navbar from "./components/Layout/Navbar";
import Home from "./components/Pages/Home";
import Router from "vue-router";

Vue.use(Router);

export default {
  name: "App",
  components: {
    Navbar,
    Home
  }
};
</script>

<style scoped>
@import "./CSS/index.css";
@import "./CSS/fonts.css";
@import "./CSS/colors.css";
@import "./CSS/module.css";
#app {
  background-color: rgb(167, 167, 167);
  color: white;
  height: 100%;
}
</style>