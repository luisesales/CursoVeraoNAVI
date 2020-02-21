<template>
    <div class="container-fluid bg-night pt-3 h-100">
    <div class="row">
      <div class="text-light font-weight-bold col-md-6 row mx-sm-0 px-0">
          <h4 class="col-sm-auto mx-sm-0 mx-auto my-auto">VENDAS</h4>          
      </div>
      <div class="border rounded-pill bg-white col-auto ml-sm-auto mr-sm-3 mx-auto mt-md-0 mt-4">
          <input
            type="text"
            class="by-none bl-none h-100 bg-white my-auto pl-3 pr-5"
            placeholder="Pesquisar"
            name="search"
          />
          <button type="submit" class="bg-white b-none">
            <a class="search align-middle"></a>
          </button>
      </div>
    </div>
    <div id="containerVendas">
          <CardVendas/>
    </div>  
    <div class="row d-flex justify-content-center mt-5 text-light">
      <ul class="pagination">
        <li
          :key="i"
          v-for="i in items.last_page"
          class="page-item"
          :class="{ active: i === paginaAtual}"
        >
          <a href="javascript:void(0);" class="page-link" @click="atribuirPaginaAtual(i)">{{ i }}</a>
        </li>
      </ul>
    </div>
    </div>
</template>

<script>
import CardVendas from "../Cards/CardVendas";

export default {
    name: "Vendas",
    components : {CardVendas}
}
</script>