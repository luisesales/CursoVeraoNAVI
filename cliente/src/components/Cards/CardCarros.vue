<template>
 <!--<div class="container-fluid bg-night pt-3">
      <div class="row">
          <div class="col-sm-4 text-light">
              <h4>VEÍCULOS</h4>
          </div>
          <div class="border rounded-pill bg-white col-sm-auto ml-auto mr-3">
              <input type="text" class="by-none bl-none h-100 bg-white my-auto pl-3 pr-5" placeholder="Pesquisar" name="search">
              <button type="submit" class="bg-white b-none"><a class="search align-middle "></a></button>
          </div>
      </div>
      <div v-for="(i,key) in items" :key="index" class="row text-red mx-1 mt-4">
        <div class="col-sm-5 bg-white"> 
          <div class="col-auto my-1 mx-1"> 
            <div class="row justify-content-end mt-2" @click="confirmarExclusao(i.Id)"><a class="trash" ></a></div>
            <div class="row font-weight-bold f-150"><div class="mx-auto"><p>{{i.Modelo}}</p></div></div>
            <hr/>
            <div class="row pl-3 f-125"><p>{{i.Fabricante}}</p></div> 
            <div class="row f-125 mr-1">
              <div class="col-sm-6"><p>{{i.Placa}}</p></div>  
              <div class="col-sm-6 col-auto ml-auto">
                <div class="row justify-content-end"> 
                  <div class="mx-2"><p>{{i.Uf}} - {{i.Ano}}</p></div> 
                </div>
              </div> 
            </div> 
            <div class="f-125 row">
              <div class="col-sm-12 text-green"><p>R$ {{i.Preco}}</p></div>  
            </div>
            <div class="row f-125">
              <div class="col-sm-6 text-white col-auto"><div class="d-flex flex-column ml-auto"><button class="pr-auto btn btn-primary rounded-pill bg-primary ">Editar</button></div></div>
              <div class="col-sm-6 text-white col-auto"><div class="d-flex flex-column ml-auto"><button class="pr-auto btn btn-success rounded-pill bg-green ">Comprar</button></div></div>
            </div>
          </div>
        </div>

---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Modelo do obj Par na divisão

        <div class="ml-auto col-sm-5 bg-white"> 
          <div class="col-auto my-1 mx-1"> 
            <div class="row justify-content-end mt-2" @click="confirmarExclusao(i.Id)"><a class="trash" ></a></div>
            <div class="row font-weight-bold f-150"><div class="mx-auto"><p>{{i.Modelo}}</p></div></div>
            <hr/>
            <div class="row pl-3 f-125"><p>{{i.Fabricante}}</p></div> 
            <div class="row f-125 mr-1">
              <div class="col-sm-6"><p>{{i.Placa}}</p></div>  
              <div class="col-sm-6 col-auto ml-auto">
                <div class="row justify-content-end"> 
                  <div class="mx-2"><p>{{i.Uf}} - {{i.Ano}}</p></div> 
                </div>
              </div> 
            </div> 
            <div class="f-125 row">
              <div class="col-sm-12 text-green"><p>R$ {{i.Preco}}</p></div>  
            </div>
            <div class="row f-125">
              <div class="col-sm-6 text-white col-auto"><div class="d-flex flex-column ml-auto"><button class="pr-auto btn btn-primary rounded-pill bg-primary ">Editar</button></div></div>
              <div class="col-sm-6 text-white col-auto"><div class="d-flex flex-column ml-auto"><button class="pr-auto btn btn-success rounded-pill bg-green ">Comprar</button></div></div>
            </div>
          </div>
        </div>      
---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    </div>    
    <div class="row d-flex justify-content-center mt-4">
      <ul class="pagination">
          <li :key="i" v-for="i in items.last_page" class="page-item" :class="{ active: i === paginaAtual}">
              <a href="javascript:void(0);" class="page-link" @click="atribuirPaginaAtual(i)">
                  {{ i }}
              </a>
          </li>
      </ul>
  </div>
    </div>
</div> -->
</template>

<script>
import Swal from 'sweetalert2'

export default {
    name: 'CardCarros',
    props: {
            camposExcluidos: {
                type: Array,
                default() {
                    return []
                }
            },
            recurso: {
                type: String,
                required: true
            },
            traducaoCampos: {
                type: Object,
                default() {
                    return {}
                }
            }
        },
        data() {
            return {
                items: {
                    data: []
                },
                paginaAtual: 1
            }
        },
        mounted() {
            this.carregarDados()
        },
        computed: {
            chavesCabecalho() {
                if (this.items.data.length > 0) {
                    const vm = this
                    return Object.keys(this.items.data[0]).filter(function (chave) {
                        return vm.camposExcluidos.indexOf(chave) === -1
                    })
                }

                return []
            }
        },
        methods: {
            confirmarExclusao(id) {
                Swal.fire({
                    title: 'Você tem certeza que deseja deletar?',
                    text: 'Uma vez deletado jamais recuperado',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#71d644',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim',
                    cancelButtonText: 'Não'
                }).then((result) => {
                    if (result.value) {
                        this.deletarRegistro(id)
                        Swal.fire('Sucesso', 'Operação realizada com sucesso', 'success')
                    } else {
                        Swal.fire('Cancelado', 'Operação cancelada com sucesso', 'error')
                    }
                })
            },
            carregarDados() {
                    const vm = this
                    fetch(`${BASE_URL}/${this.recurso}?page=${this.paginaAtual}`)
                        .then(function(response) {
                            response.json()
                                .then(function (items) {
                                    vm.items = items
                                })
                        })
            },
            atribuirPaginaAtual(pagina) {
                this.paginaAtual = pagina

                this.carregarDados()
            },
            deletarRegistro(id) {
                const vm = this
                fetch(`${BASE_URL}/papeis/${id}`, {
                    method: "delete",
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                })
                    .then( (response) => {
                        window.console.log(response)
                        vm.carregarDados()
                    });
            },
            
        }
    }
}
</script>

<style>

</style>