<template>
  <div class="text-red mx-1 mt-4 col-md-5 bg-white">
    <div class="col-auto my-1 mx-1 py-3">
      <div class="row justify-content-end" @click="confirmarExclusao(item.id)">
        <button class="trash b-none bg-white"></button>
      </div>
      <div class="row font-weight-bold f-150">
        <div class="mx-auto">
          <p>{{item.modelo}}</p>
        </div>
      </div>
      <hr />
      <div class="row pl-3 f-125">
        <p>{{item.fabricante}}</p>
      </div>
      <div class="row f-125 mr-1">
        <!-- <div class="col-sm-6"><p>{{item.placa}}</p></div>   -->
        <div class="col-sm-6 col-auto ml-auto">
          <div class="row justify-content-end">
            <!-- <div class="mx-2"><p>{{item.uf}} - {{i.ano}}</p></div>  -->
          </div>
        </div>
      </div>
      <div class="f-125 row">
        <div class="col-sm-12 text-green">
          <p>R$ {{item.valor}}</p>
        </div>
      </div>
      <div class="row f-125">
        <div class="col-md-6 col-12 text-white col-auto">
          <div class="d-flex flex-column ml-auto">
            <button
              @click="showVeiculoModal()"
              class="pr-auto btn btn-primary rounded-pill bg-primary"
            >Editar</button>
          </div>
        </div>
        <div class="col-md-6 col-12 mt-md-0 mt-2 text-white col-auto">
          <div class="d-flex flex-column ml-auto">
            <button @click="show()" class="pr-auto btn btn-success rounded-pill bg-green">Vender</button>
          </div>
        </div>
      </div>
    </div>
    <modal id="modalCliente" name="client-modal" class="h-auto">
      <form action="" method="POST">
        <div id="modalClienteContainer">
          <div class="container mx-3 my-2 h-auto">
            <div class="row"><h4>Preencha o Formulário</h4>
             <button type="button" class="close ml-auto" @click="hide()" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="row mt-4">
              <input
                type="text"
                name="name"
                placeholder="Nome"
                v-model="cliente.nome" 
                class="bx-none bt-none w-100 col-md-7 p-0 col-auto"
              />
              <input
                type="text"
                name="cpf"
                placeholder="CPF"
                v-model="cliente.cpf"
                class="bx-none bt-none w-100 col-md-4 col-sm-8 col-auto ml-md-auto mt-md-0 mt-2 p-0"
              />
            </div>
            <div class="row mt-2">
              <input type="text" name="email" placeholder="Email" v-model="cliente.email" class="bx-none bt-none w-100" />
            </div>
            <div class="row mt-2">
              <input
                type="text"
                name="endereco"
                placeholder="Endereço"
                v-model="cliente.endereco"
                class="bx-none bt-none w-100"
              />
            </div>
            <div class="row mt-5 align-baseline">
              <button type="submit" class="col-auto btn btn-primary bg-primary ml-auto">Confirmar</button>
            </div>
          </div>
        </div>
      </form>
    </modal>
    <modal id="modalVeiculo" name="veiculo-modal">
      <form method="POST">
        <div class="form-group">
          <div class="container-fluid mx-3 my-2 h-auto w-auto">
            <div class="row"><h4>Editar Veículo</h4>
             <button type="button" class="close ml-auto" @click="hideVeiculoModal()" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="row mt-4">
              <input
                type="text"
                name="modelo"
                placeholder="Modelo"
                v-model="veiculo.modelo" id="modelo"
                class="bx-none bt-none w-100"
              />
            </div>
            <div class="row mt-2">
              <input type="text" name="fabricante" placeholder="Fabricante" v-model="veiculo.fabricante" id="fabricante"  class="bx-none bt-none w-100" />
            </div>
            <div class="row mt-2">
              <input
                type="text"
                name="ano"
                placeholder="Ano de Fabricação"
                v-model="veiculo.ano_fabricacao" id="ano_fabricacao" 
                class="bx-none bt-none w-100 col-md-3 p-0"
              />
              <input
                type="text"
                name="placa"
                placeholder="Placa"
                v-model="veiculo.placa" id="placa"
                class="bx-none bt-none w-100 col-md-4 offset-md-1 mt-md-0 mt-2 p-0"
              />
              <input
                type="text"
                name="uf"
                placeholder="UF"
                v-model="veiculo.uf" id="uf"
                class="bx-none bt-none w-100 col-md-3  offset-md-1 p-0 mt-md-0 mt-2" 
              />
              </div>
            <div class="row mt-2">
              <input type="price" name="valor" placeholder="Preço" class="bx-none bt-none w-50"  v-model="veiculo.valor" id="valor"/> <span class="align-bottom">Reais</span>
            </div>
            <div class="row mt-3 align-baseline">
              <button @click.prevent="editarVeiculo" class="col-auto btn btn-primary bg-primary ml-auto">Atualizar</button>
            </div>
          </div>
           </div>
      </form>
    </modal>
  </div>
</template>

<script>
import Vue from "vue";
import Swal from "sweetalert2";
import VModal from "vue-js-modal";

Vue.use(VModal);
const BASE_URL = "http://localhost:8000/api";
export default {
  name: "CardVeiculos",
  props: {
    camposExcluidos: {
      type: Array,
      default() {
        return [];
      }
    },
    id: {
      type: Number,
      required: true
    },
    traducaoCampos: {
      type: Object,
      default() {
        return {};
      }
    }
  },
  data() {
    return {
      cliente : {
        nome : null,
        endereco : null,
        email: null,
        cpf: null
      },
      veiculo: {
        modelo: null,
        fabricante: null,
        ano_fabricacao: null,
        valor: null
      },
      item: {
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
      if (this.item.data.length > 0) {
        const vm = this;
        return Object.keys(this.item.data[0]).filter(function(chave) {
          return vm.camposExcluidos.indexOf(chave) === -1;
        });
      }

      return [];
    }
  },
  methods: {
    tratarSubmissao() {
      this.veiculo.ano_fabricacao = parseInt(this.veiculo.ano_fabricacao);
      this.veiculo.valor = parseInt(this.veiculo.valor);
      this.editarVeiculo();
    },
    criarVeiculo() {
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

        Swal.fire("Veiculo criado com sucesso!", "", "success");

        return this.$router.push({ name: "veiculos" });
      });
    },
    editarVeiculo() {
      console.log(JSON.stringify(this.veiculo));
      console.log(this.id);
      fetch(
        `${BASE_URL}/veiculos/${this.item.id}`,
        {
          method: "PUT",
          headers: {
            Accept: "application/json",
            "Content-Type": "application/json"
          },
          
          //make sure to serialize your JSON body
          body: JSON.stringify(this.veiculo)
        }
      ).then(response => {
        window.console.log(response);

        Swal.fire("Veiculo editado com sucesso!", "", "success");

        return this.$router.push({ name: "veiculos" });
      });
    },
    showVeiculoModal() {
      this.$modal.show("veiculo-modal");
    },
    hideVeiculoModal() {
      this.$modal.hide("veiculo-modal");
    },
    show() {
      this.$modal.show("client-modal");
    },
    hide() {
      this.$modal.hide("client-modal");
    },
    confirmarExclusao(id) {
      Swal.fire({
        title: "Você tem certeza que deseja deletar?",
        text: "Uma vez deletado jamais recuperado",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#71d644",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sim",
        cancelButtonText: "Não"
      }).then(result => {
        if (result.value) {
          this.deletarRegistro(id);
          Swal.fire("Sucesso", "Operação realizada com sucesso", "success");
        } else {
          Swal.fire("Cancelado", "Operação cancelada com sucesso", "error");
        }
      });
    },
    carregarDados() {
      const vm = this;
      fetch(`${BASE_URL}/veiculos/${vm.id}`).then(function(response) {
        response.json().then(function(item) {
          vm.item = item;
          console.log(item);
        });
      });
    },
    atribuirPaginaAtual(pagina) {
      this.paginaAtual = pagina;

      this.carregarDados();
    },
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
    }
  }
};
</script>
  
<style scoped>
#modalClienteContainer {
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: flex-start;
  flex-wrap: wrap;
}
</style>