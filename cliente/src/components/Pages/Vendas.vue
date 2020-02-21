<template>
  <div>
    <template v-for="item in items.data">
      <CardVendas :key="item.id" :item="item" />
    </template>
  </div>
</template>

<script>

import CardVendas from "../Cards/CardVendas";
const BASE_URL = 'http://localhost:8000/api'
export default {
  name: "Vendas",
  components: {
    CardVendas
  },
  data() {
    return {    
      items: {
        data: []
      },
      paginaAtual: 1
    };
  },
  mounted() {
    this.carregarDados();
  },
  methods : {
      carregarDados() {
      const vm = this;
      fetch(`${BASE_URL}/vendas/?page=${this.paginaAtual}`).then(function(
        response
      ) {
        response.json().then(function(items) {
          vm.items = items;
          console.log(items);
        });
      });
    },
    atribuirPaginaAtual(pagina) {
      this.paginaAtual = pagina;

      this.carregarDados();
    }
  }
};
</script>

<style>
</style>