<template>
  <div>
     
  </div>
</template>
<script>
const BASE_URL = "http://localhost:8000/api";
export default {
  name: "CardVendas",
  props : {
      item : Object,
  },
  data() {
    return {
      cliente : null,
      veiculo : null,
      vendedor : null,
      paginaAtual: 1
    };
  },
  mounted() {
    this.carregarDados();
  },
  methods: {
    carregarDados() {
      const vm = this;
      fetch(`${BASE_URL}/veiculos/${this.item.veiculo_id}`).then(function(
        response
      ) {
        response.json().then(function(item) {
          vm.veiculo = item;
        });
      });
      fetch(`${BASE_URL}/clientes/${this.item.cliente_id}`).then(function(
        response
      ) {
        response.json().then(function(item) {
          vm.cliente = item;
        });
      });
      fetch(`${BASE_URL}/vendedores/${this.item.vendedor_id}`).then(function(
        response
      ) {
        response.json().then(function(item) {
          vm.vendedor = item;
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