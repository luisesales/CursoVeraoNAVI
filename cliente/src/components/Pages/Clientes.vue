<template>
  <div>
    <div>
      <h4 class="col-sm-auto mx-sm-0 mx-auto my-auto">Clientes</h4>
      <button
        @click="showCriarModal()"
        class="col-auto offset-auto pb-1 text-light b-none btn btn-primary font-weight-bold mx-sm-0 mx-auto mt-sm-0 mt-3"
      >
        <div class="col-auto">NOVO CLIENTE</div>
      </button>
      <div class="table-responsive push mt-4">
        <table class="table table-striped">
          <thead class="text-light">
            <tr>
              <th>Nome</th>
              <th>Email</th>
              <th>Endereço</th>
              <th>Telefone</th>
              <th>Cpf</th>
            </tr>
          </thead>
          <tbody class="bg-white">
            <template v-for="item in items.data">
              <tr :key="item.id" class="mt-2" :item="item">
                <th>{{item.name}}</th>
                <th>{{item.email}}</th>
                <th>{{item.address}}</th>
                <th>{{item.phone}}</th>
                <th>{{item.cpf}}</th>
              </tr>
            </template>
          </tbody>
        </table>
        <div class="d-flex justify-content-center">
          <ul class="pagination">
            <li
              :key="i"
              v-for="i in items.last_page"
              class="page-item"
              :class="{ active: i === paginaAtual}"
            >
              <a
                href="javascript:void(0);"
                class="page-link"
                @click="atribuirPaginaAtual(i)"
              >{{ i }}</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <modal id="modalCliente" name="criar-modal">
      <form method="POST">
        <div class="form-group">
          <div class="container-fluid mx-3 my-2 h-auto w-auto">
            <div class="row">
              <h4 style="color: black;">Cadastrar Cliente</h4>
              <button
                type="button"
                class="close ml-auto mb-auto"
                @click="hideCriarModal()"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="row mt-4">
              <input
                type="text"
                name="nome"
                placeholder="nome"
                v-model="cliente.name"
                id="nome"
                class="bx-none bt-none w-100"
              />
            </div>
            <div class="row mt-2">
              <input
                type="text"
                name="email"
                placeholder="email"
                v-model="cliente.email"
                id="email"
                class="bx-none bt-none w-100"
              />
            </div>
            <div class="row mt-2">
              <input
                type="text"
                name="address"
                placeholder="endereço"
                v-model="cliente.address"
                id="address"
                class="bx-none bt-none w-100 col-md-3 p-0"
              />
              <input
                type="text"
                name="phone"
                placeholder="telefone"
                v-model="cliente.phone"
                id="phone"
                class="bx-none bt-none w-100 col-md-4 offset-md-1 mt-md-0 mt-2 p-0"
              />
              <input
                type="text"
                name="cpf"
                placeholder="CPF"
                v-model="cliente.cpf"
                id="cpf"
                class="bx-none bt-none w-100 col-md-3 offset-md-1 p-0 mt-md-0 mt-2"
              />
              <div class="row mt-3 align-baseline">
                <button
                  @click.prevent="criarCliente()"
                  class="col-auto btn btn-primary bg-primary ml-auto"
                >Criar</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </modal>
  </div>
</template>

<script>
import Vue from "vue";
import VModal from "vue-js-modal";
import Swal from "sweetalert2";
Vue.use(VModal);

const BASE_URL = "http://localhost:8000/api";
export default {
  name: "clientes",
  data() {
    return {
      cliente: {
        id: null,
        cpf: null,
        email: null,
        phone: null,
        address: null
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
  methods: {
    criarCliente() {
      const vm = this;
      console.log(JSON.stringify(this.cliente));
      fetch(`${BASE_URL}/clientes`, {
        method: "post",
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json"
        },
        //make sure to serialize your JSON body
        body: JSON.stringify(this.cliente)
      }).then(response => {
        window.console.log(response);
        Swal.fire("cliente criado com sucesso!", "", "success").then(
          vm.carregarDados(),
          this.hideCriarModal(),
          (this.cliente = {
            id: null,
            cpf: null,
            address: null,
            phone: null,
            email : null
          })
        );
      });
    },
    showCriarModal() {
        this.$modal.show("criar-modal");
    },
    hideCriarModal() {
        this.$modal.hide("criar-modal");
    },
    carregarDados() {
      const vm = this;
      fetch(`${BASE_URL}/clientes/?page=${this.paginaAtual}`).then(function(
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