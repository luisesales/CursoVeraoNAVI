<template>  
    <div class="container-fluid bg-night pt-3 h-100">
    <div class="row">
      <div class="text-light font-weight-bold col-md-6 row mx-0 px-0">
          <h4 class="col-sm-auto mx-sm-0 mx-auto my-auto">VENDAS</h4>          
      </div>
      <div class="border rounded-pill bg-white col-auto ml-sm-auto mr-sm-3 mx-auto mt-sm-0 mt-4">
          <input
            type="text"
            class="b-none h-100 bg-white my-auto pl-3 pr-5"
            placeholder="Pesquisar"
            v-model="search"
            name="search"
          />         
      </div>
    </div>
    <div id="containerVendas">
           <template v-for="item in items.data">
        <CardVendas
          :key="item.id"
          :item="item"
        />
      </template>
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
const BASE_URL = "http://localhost:8000/api";
export default {
    name: "Vendas",
    components : {CardVendas},
    data() {
    return {
      venda: {
        id: null,
        vendedor: null,
        comprador: null,
        veiculo: null,
        
      },
      items: {
        data: [],
        
      },
      search : '',
      paginaAtual: 1
    };
  },
    methods: {
      carregarDados() {
      const vm = this;
      fetch(`${BASE_URL}/vendas/?page=${this.paginaAtual}`).then(function(
        response
      ) {
        response.json().then(function(items) {
          vm.items = items;
        });
      });
    },
    atribuirPaginaAtual(pagina) {
      this.paginaAtual = pagina;

      this.carregarDados();
    }
  },
  mounted() {
    this.carregarDados()
  },
  computed: {
    chavesCabecalho() {
      if (this.items.data.length > 0) {
        const vm = this;
        return Object.keys(this.items.data[0]).filter(function(chave) {
          return vm.camposExcluidos.indexOf(chave) === -1;
        });
      }

      return [];
    },
    itensFiltrados: function(){      
      return this.items.data.filter((item) =>{ 
         return item.modelo.match(this.search)})
     }
  },
  
}

</script>