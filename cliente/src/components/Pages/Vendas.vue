<template>
  <div class="container-fluid pt-3">    
    <div class="row">
        <h4 class="col-sm-auto mx-sm-0 mx-auto ">VENDAS</h4>        
    </div>
     <div class="table-responsive push mt-3">
        <table class="table table-striped ">
            <thead class=" text-light ">
                <tr>
                  <th>Veiculo</th>
                  <th>Placa</th>
                  <th>Preço em R$</th>
                  <th>Data</th>
                  <th>Comprador</th>
                  <th>Vendedor</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <template v-for="item in items.data">
                  <tr :key="item.id" class="mt-2" :item="item">
                    <th>{{item.veiculo.modelo}}</th>
                    <th>{{item.veiculo.placa}}</th>
                    <th>{{item.veiculo.valor}}</th>
                    <th>{{item.created_at}}</th>
                    <th>{{item.cliente.name}}</th>
                    <th>{{item.vendedor.name}}</th>
                  </tr>
                </template>
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            <ul class="pagination">
                <li :key="i" v-for="i in items.last_page" class="page-item" :class="{ active: i === paginaAtual}">
                    <a href="javascript:void(0);" class="page-link" @click="atribuirPaginaAtual(i)">
                        {{ i }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
  </div>
  
</template>

<script>
//import CardVendas from "../Cards/CardVendas";
const BASE_URL = "http://localhost:8000/api";
export default {
  name: "Vendas",
  components: {
    //CardVendas
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
  methods: {
    carregarDados() {
      const vm = this;
      fetch(`${BASE_URL}/vendasDados/?page=${this.paginaAtual}`).then(function(
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