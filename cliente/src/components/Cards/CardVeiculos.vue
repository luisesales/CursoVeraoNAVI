<template>
  <div class="text-red mx-1 mt-4 col-md-5 bg-white border  rounded">
    <div class="col-auto my-1 mx-1 py-3">
      <div class="row justify-content-end" @click="confirmarExclusao(item.id)">
        <button class="trash b-none bg-white"></button>
      </div>
      <div class="row font-weight-bold f-150">
        <div class="mx-auto">
          <p>{{item.modelo | toUpperCase}}</p>
        </div>
      </div>
      <hr />
      <div class="row pl-3 f-125">
        <p>{{item.fabricante}}</p>
      </div>
      <div class="row f-125 mr-1">      
        <div class="col-sm-6"><p>{{item.placa}}</p></div>  
        <div class="col-sm-6 col-auto ml-auto">
          <div class="row justify-content-end">
            <div class="mx-2"><p> {{item.uf}} - <!--{{i.ano_fabricacao}}--></p></div> 
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
        <div class="col-md-6 col-12 mt-md-0 mt-4 text-white col-auto">
          <div class="d-flex flex-column ml-auto">
            <button @click="show()" class="pr-auto btn btn-success rounded-pill bg-green">Vender</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Swal from "sweetalert2";
export default {
  name: "CardVeiculos",
  props: {
    item: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      cliente: {
        nome: null,
        endereco: null,
        email: null,
        cpf: null
      },
      veiculo: {
        id: null,
        modelo: null,
        fabricante: null,
        ano_fabricacao: null,
        valor: null
      },
      paginaAtual: 1
    };
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
  mounted() {
    this.veiculo = this.item;
  },
  methods: {
    showVeiculoModal() {
      this.$emit('editarVeiculo',this.item);
    },
    show() {
      let vm = this;
      this.$emit("criar-cliente",vm.cliente);
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
          this.$emit('deletarRegistro',id);
          Swal.fire("Sucesso", "Operação realizada com sucesso", "success");
        } else {
          Swal.fire("Cancelado", "Operação cancelada com sucesso", "error");
        }
      });
    },
    atribuirPaginaAtual(pagina) {
      this.paginaAtual = pagina;
    },
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