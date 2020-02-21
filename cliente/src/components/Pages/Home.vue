<template class="bg-night">
  <div class="container-fluid bg-night pt-3 h-100">
    <div class="row">
      <div class="col-sm-4 text-light font-weight-bold">
        <div class="row ml-1">
          <h4>VEÍCULOS</h4>
          <button class="ml-4 col-auto text-light b-none btn btn-primary font-weight-bold">
            <div @click="showCriarVeiculoModal()" class="col-auto">NOVO VEÍCULO</div>
          </button>
        </div>
      </div>
      <!-- <div class="border rounded-pill bg-white col-sm-auto ml-auto mr-3">
          <input
            type="text"
            class="by-none bl-none h-100 bg-white my-auto pl-3 pr-5"
            placeholder="Pesquisar"
            name="search"
          />
          <button type="submit" class="bg-white b-none">
            <a class="search align-middle"></a>
          </button>
      </div>-->
    </div>
     <h1 v-if="items.data.length == 0">Nenhum Veículo Disponível</h1>
    <div id="containerCards">
      <template v-for="item in items.data">
        <CardVeiculos
          v-on:deletarRegistro="deletarRegistro($event)"
          v-on:editarVeiculo="(showEditarVeiculoModal($event))"
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
    <modal id="modalVeiculo" name="criar-veiculo-modal">
      <form method="POST">
        <div class="form-group">
          <div class="container-fluid mx-3 my-2 h-auto w-auto">
            <div class="row">
              <h4 style="color: black;">Criar Veículo</h4>
              <button
                type="button"
                class="close ml-auto"
                @click="hideCriarVeiculoModal()"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="row mt-4">
              <input
                type="text"
                name="modelo"
                placeholder="Modelo"
                v-model="veiculo.modelo"
                id="modelo"
                class="bx-none bt-none w-100"
              />
            </div>
            <div class="row mt-2">
              <input
                type="text"
                name="fabricante"
                placeholder="Fabricante"
                v-model="veiculo.fabricante"
                id="fabricante"
                class="bx-none bt-none w-100"
              />
            </div>
            <div class="row mt-2">
              <input
                type="text"
                name="ano"
                placeholder="Ano de Fabricação"
                v-model="veiculo.ano_fabricacao"
                id="ano_fabricacao"
                class="bx-none bt-none w-100 col-md-3 p-0"
              />
              <input
                type="text"
                name="placa"
                placeholder="Placa"
                v-model="veiculo.placa"
                id="placa"
                class="bx-none bt-none w-100 col-md-4 offset-md-1 mt-md-0 mt-2 p-0"
              />
              <input
                type="text"
                name="uf"
                placeholder="UF"
                v-model="veiculo.uf"
                id="uf"
                class="bx-none bt-none w-100 col-md-3 offset-md-1 p-0 mt-md-0 mt-2"
              />
            </div>
            <div class="row mt-2">
              <input
                type="price"
                name="valor"
                placeholder="Preço"
                class="bx-none bt-none w-50"
                v-model="veiculo.valor"
                id="valor"
              />
              <span class="align-bottom">Reais</span>
            </div>
            <div class="row mt-3 align-baseline">
              <button
                @click.prevent="criarVeiculo"
                class="col-auto btn btn-primary bg-primary ml-auto"
              >Criar</button>
            </div>
          </div>
        </div>
      </form>
    </modal>
    <modal id="modalVeiculoEdit" name="editar-veiculo-modal">
      <form method="POST">
        <div class="form-group">
          <div class="container-fluid mx-3 my-2 h-auto w-auto">
            <div class="row">
              <h4 style="color: black;">Editar Veículo</h4>
              <button
                type="button"
                class="close ml-auto"
                @click="hideEditarVeiculoModal()"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="row mt-4">
              <input
                type="text"
                name="modelo"
                placeholder="Modelo"
                v-model="veiculo.modelo"
                id="modelo"
                class="bx-none bt-none w-100"
              />
            </div>
            <div class="row mt-2">
              <input
                type="text"
                name="fabricante"
                placeholder="Fabricante"
                v-model="veiculo.fabricante"
                id="fabricante"
                class="bx-none bt-none w-100"
              />
            </div>
            <div class="row mt-2">
              <input
                type="text"
                name="ano"
                placeholder="Ano de Fabricação"
                v-model="veiculo.ano_fabricacao"
                id="ano_fabricacao"
                class="bx-none bt-none w-100 col-md-3 p-0"
              />
              <input
                type="text"
                name="placa"
                placeholder="Placa"
                v-model="veiculo.placa"
                id="placa"
                class="bx-none bt-none w-100 col-md-4 offset-md-1 mt-md-0 mt-2 p-0"
              />
              <input
                type="text"
                name="uf"
                placeholder="UF"
                v-model="veiculo.uf"
                id="uf"
                class="bx-none bt-none w-100 col-md-3 offset-md-1 p-0 mt-md-0 mt-2"
              />
            </div>
            <div class="row mt-2">
              <input
                type="price"
                name="valor"
                placeholder="Preço"
                class="bx-none bt-none w-50"
                v-model="veiculo.valor"
                id="valor"
              />
              <span class="align-bottom">Reais</span>
            </div>
            <div class="row mt-3 align-baseline">
              <button
                @click.prevent="editarVeiculo"
                class="col-auto btn btn-primary bg-primary ml-auto"
              >Atualizar</button>
            </div>
          </div>
        </div>
      </form>
    </modal>
  </div>
</template>

<script>
import Vue from "vue";
import CardVeiculos from "../Cards/CardVeiculos";
import VModal from "vue-js-modal";
import Swal from "sweetalert2";
Vue.use(VModal);
const BASE_URL = "http://localhost:8000/api";
export default {
  name: "Home",
  components: {
    CardVeiculos
  },
  data() {
    return {
      veiculo: {
        id: null,
        modelo: null,
        fabricante: null,
        ano_fabricacao: null,
        valor: null
      },
      items: {
        data: []
      },
      paginaAtual: 1
    };
  },
  mounted() {
    this.carregarDados();
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
    }
  },
  methods: {
    deletarRegistro(id) {
      const vm = this;
      fetch(`${BASE_URL}/veiculos/${id}`, {
        method: "delete",
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json"
        }
      }).then(response => {
        window.console.log(response);
        vm.carregarDados();
      });
    },
    editarVeiculo() {
      console.log(JSON.stringify(this.veiculo));
      console.log(this.veiculo.id);
      fetch(`${BASE_URL}/veiculos/${this.veiculo.id}`, {
        method: "PUT",
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json"
        },

        //make sure to serialize your JSON body
        body: JSON.stringify(this.veiculo)
      }).then(response => {
        window.console.log(response);
        Swal.fire("Veiculo editado com sucesso!", "", "success").then(
          this.hideEditarVeiculoModal(),
          (this.veiculo = {
            modelo: null,
            fabricante: null,
            ano_fabricacao: null,
            valor: null
          }),
          
        );
        //return this.$router.push({ name: "home" });
      });
    },
    criarVeiculo() {
      let vm = this;
      console.log(JSON.stringify(this.veiculo));
      fetch(`${BASE_URL}/veiculos`, {
        method: "post",
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json"
        },
        //make sure to serialize your JSON body
        body: JSON.stringify(this.veiculo)
      }).then(response => {
        window.console.log(response);
        Swal.fire("Veiculo criado com sucesso!", "", "success").then(
          this.hideCriarVeiculoModal(),
          (this.veiculo = {
            modelo: null,
            fabricante: null,
            ano_fabricacao: null,
            valor: null
          }),
          vm.carregarDados()
        );
      });
    },
    showCriarVeiculoModal() {
      this.$modal.show("criar-veiculo-modal");
    },
    hideCriarVeiculoModal() {
      this.$modal.hide("criar-veiculo-modal");
    },
    showEditarVeiculoModal(veiculo) {
      this.veiculo = veiculo;
      console.log(this.veiculo);
      this.$modal.show("editar-veiculo-modal");
    },
    hideEditarVeiculoModal() {
      this.$modal.hide("editar-veiculo-modal");
    },
    carregarDados() {
      const vm = this;
      fetch(`${BASE_URL}/veiculos/?page=${this.paginaAtual}`).then(function(
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

<style scoped>
#containerCards {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
}
 h1{
  background-color: rgba(255, 255, 255, 0.062);
  text-align: center;
}
</style>
