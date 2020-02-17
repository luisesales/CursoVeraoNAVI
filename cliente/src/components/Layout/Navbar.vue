

<template>
  <div id="navBar">
      <nav class="navbar navbar-dark navbar-expand-sm bg-night text-light">
  <router-link class="mr-4 logo"></router-link>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
    <span class="navbar-toggler-icon text-light"></span>
  </button>
  <div class="collapse navbar-collapse pb-1" id="navbarNav">
    <ul class="navbar-nav text-light">
      <li class="nav-item">
        <router-link class="nav-link " >Inicio</router-link> 
      </li>
      <li class="nav-item">
        <router-link class="nav-link " >Veiculos</router-link> 
      </li>
      <li class="nav-item">
        <router-link class="nav-link " >Promoçoes</router-link> 
      </li>
    </ul>   
     <div class="col-auto text-light ml-auto py-auto">
       <div class="row">
        <div class="col-auto"> 
          <span class="row">João Paulo</span>
          <span class="row fs-07">Vendedor</span>
        </div>
        <div class="col-auto user my-auto ml-5"></div>
       </div>
  </div>
  </div>
 
</nav>
    </div>
</template>

<script>

export default {
  name : 'Navbar'
}
</script>

<style scoped>
 .logo{
   background-image: url("./../../assets/logo-navi-sem-texto.svg");
   background-size: contain !important;
   background-repeat:no-repeat !important;
   height: 2.75rem !important;
   width: 2.75rem !important;
 }
 .user{
   background-image: url("./../../assets/user-solid-white.svg");
   background-size: contain;
   background-repeat: no-repeat;
   height: 2rem !important;
   width: 1rem !important;
 }
</style>
      
<!--Trocar todos os <a> por <router-link> e os adptar -->