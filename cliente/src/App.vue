<template>
  <div class="page" id="app">
    <Navbar />
<<<<<<< HEAD
    <router-view to="/"/>
=======
    <router-view />
>>>>>>> Homolog
  </div>
</template>

<script>
//import Vue from "vue";
import Navbar from "./components/Layout/Navbar";
<<<<<<< HEAD
//import Home from "./components/Pages/Home";
//import Router from "vue-router";

//Vue.use(Router);
=======
import Router from "vue-router";

Vue.use(Router);
Vue.filter('toUpperCase',function(value){
  return value.toUpperCase();
})
>>>>>>> Homolog

export default {
  name: "App",
  components: {
<<<<<<< HEAD
    Navbar,
    //Home
  }
=======
    Navbar  
    }
>>>>>>> Homolog
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