<template>
    <div class="container-fluid">
      <div class="row">
          <h4>{{ textosCard.titulo }}</h3>
      </div>
      <div class="col-12 mt-4">
          <input class="col-sm-12 bx-none bt-none f-125" placeholder="Modelo" v-model="veiculo.Modelo" type="text"/>
      </div>
      <div class="col-12 mt-4">
          <input class="col-sm-12 bx-none bt-none f-125" placeholder="Fabricante" v-model="veiculo.Fabricante" type="text"/>
      </div>
      <div class="col-12 mt-4">
              <input class="col-sm-4 bx-none bt-none f-125" placeholder="Ano de Fabricação" v-model="veiculo.Fabricante" type="text"/>           
              <input class="ml-sm-4 col-sm-4 bx-none bt-none f-125" placeholder="UF" v-model="veiculo.Uf" type="text"/>
      </div>
      <div class="col-12 mt-4">
          <input class="col-sm-6 bx-none bt-none f-125" placeholder="Placa" v-model="veiculo.Placa" type="text"/>
      </div>
      <div class="col-12 mt-4">
          <input class="col-sm-6 bx-none bt-none f-125" placeholder="Preço" v-model="veiculo.Preco" type="text"/>
      </div>
      <div class="row mt-4">
        <button @click.prevent="tratarSubmissao" class="btn btn-primary bg-primary">{{ textosCard.botao }}</button>
      </div>
  </div>  
</template>

<script>
import Swal from 'sweetalert2'
    const BASE_URL = "http://localhost:8000/api"
    const MODO_CRIACAO = "criacao"
    const MODO_EDICAO = "edicao"
    export default {
        name: "VeiculoForm",
        props: {
            papelId: {
                type: Number,
                default: null
            },
            modo: {
                type: String,
                default: MODO_CRIACAO
            }
        },
        data() {
            return {
                veiculo: {
                    nome: null
                }
            }
        },
        mounted() {
            if (this.modo === MODO_EDICAO) {
                this.resgatarPapel()
            }
        },
        computed: {
            textosCard() {
                return this.modo === MODO_CRIACAO ?
                    {
                        titulo: "Criação de Veículos",
                        botao: "Criar"
                    } :
                    {
                        titulo: "Edição de Veículos",
                        botao: "Atualizar"
                    }
            },
            tituloCard() {
                return this.modo === MODO_CRIACAO ? "Criação de Veículos" : "Edição de Veículos"
            },
        },
        methods: {
            tratarSubmissao() {
                if (this.modo === MODO_CRIACAO) {
                    this.criarVeiculo()
                } else if (this.modo === MODO_EDICAO) {
                    this.editarVeiculo()
                }
            },
            criarVeiculo() {
                fetch(`${BASE_URL}/veiculos`, {
                    method: "post",
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    //make sure to serialize your JSON body
                    body: JSON.stringify(this.veiculo)
                })
                    .then( (response) => {
                        window.console.log(response)
                        Swal.fire('Veículo criado com sucesso!', '', 'success')
                        return this.$router.push({ name: 'veiculos' })
                    });
            },
            editarVeiculo() {
                fetch(`${BASE_URL}/veiculos/${this.Id}`, {
                    method: "put",
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    //make sure to serialize your JSON body
                    body: JSON.stringify(this.Id)
                })
                    .then( (response) => {
                        window.console.log(response)
                        Swal.fire('Veículo editado com sucesso!', '', 'success')
                        return this.$router.push({ name: 'veiculos' })
                    });
            },
            resgatarPapel() {
                const vm = this
                fetch(`${BASE_URL}/veiculos/${this.Id}`)
                    .then(function(response) {
                        response.json()
                            .then(function (veiculo) {
                                vm.veiculo = veiculo
                            })
                    })
            }
        }
    }
</script>