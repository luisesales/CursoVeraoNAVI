

<template>
  <div id="nav">
    <nav class="navbar navbar-dark navbar-expand-sm bg-black text-light">
      <router-link to="/" class="mr-4 logo"></router-link>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Alterna navegação"
      >
        <span class="navbar-toggler-icon text-light"></span>
      </button>
      <div class="collapse navbar-collapse pb-1" id="navbarNav">
        <ul class="navbar-nav text-light">
          <li class="nav-item">
            <router-link to="/" class="nav-link">Veiculos</router-link>
          </li>
          <li class="nav-item">
            <router-link to="/vendas" class="nav-link">Vendas</router-link>
          </li>
          <li class="nav-item">
            <router-link to="/clientes" class="nav-link">Clientes</router-link>
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
  name: "Navbar"
};
</script>