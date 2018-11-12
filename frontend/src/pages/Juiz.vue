<template>
    <div>
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link" :class="{active: showLista}" href="Javascript:void(0);" @click="showLista = true">Lista Regras de Pontuação</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" :class="{active: !showLista}" href="Javascript:void(0);" @click="showLista = false">Cadastrar Regras de Pontuação</a>
            </li>
        </ul>

        <div class="mt-5 content" v-if="showLista">
            <div class="row">
                <div class="col-md-4 mb-5" v-if="pontos_topo.length > 0">
                    <div class="card">
                        <div class="card-header">
                            <img src="../assets/img/card-success.png" style="margin-top: -15px; margin-left: -15px">
                            <h4 class=" text-on-front card-title " style="position: relative; font-size: 5em; font-weight: 900; color: #FFF; text-transform: lowcase; margin-left: -5px; z-index: 1; margin-top: -200px; margin-left: -15px">Topo</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table tablesorter " id="simple-table">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>
                                            Ações
                                        </th>
                                        <th class="text-center">
                                            Pontuação
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="pontos in pontos_topo" :key="pontos.id">
                                        <td>{{getAcaoName(pontos.funcao_id)}}</td>
                                        <td class="text-success text-center">{{pontos.pontuacao > 0 ? '+':'-'}}{{pontos.pontuacao}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- <div class="card-footer text-center mb-2 mt-2">
                                <button class="btn btn-round btn-icon btn-just-icon btn-success" title="Editar Regra de Pontuação">
                                    <a href="editaRegraDePontuacao.html">
                                        <i class="tim-icons icon-pencil" style="color: #fff"></i>
                                    </a>
                                </button>
                                <button class="btn btn-round btn-icon btn-just-icon btn-success" onclick="demo.showSwal('warning-message-and-confirmation')"
                                    title="Excluir Regra de Pontuação">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-5" v-if="pontos_cacador.length > 0">
                    <div class="card">
                        <div class="card-header">
                            <img src="../assets/img/card-danger.png" style="margin-top: -15px; margin-left: -15px">
                            <h4 class=" text-on-front card-title " style="position: relative; font-size: 4.9em; font-weight: 900; color: #FFF; text-transform: lowcase; margin-left: -5px; z-index: 1; margin-top: -200px; margin-left: -15px">Caçador</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table tablesorter " id="simple-table">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>
                                            Ações
                                        </th>
                                        <th class="text-center">
                                            Pontuação
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="pontos in pontos_cacador" :key="pontos.id">
                                        <td>{{getAcaoName(pontos.id)}}</td>
                                        <td class="text-success text-center">{{pontos.pontuacao > 0 ? '+':'-'}}{{pontos.pontuacao}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- <div class="card-footer text-center mb-2 mt-2">
                                    <button class="btn btn-round btn-icon btn-just-icon btn-danger" title="Editar Regra de Pontuação">
                                        <a href="editaRegraDePontuacao.html">
                                            <i class="tim-icons icon-pencil" style="color: #fff"></i>
                                        </a>
                                    </button>
                                    <button class="btn btn-round btn-icon btn-just-icon btn-danger" onclick="demo.showSwal('warning-message-and-confirmation')"
                                        title="Excluir Regra de Pontuação">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-5" v-if="pontos_meio.length > 0">
                    <div class="card">
                        <div class="card-header">
                            <img src="../assets/img/card-primary.png" style="margin-top: -15px; margin-left: -15px">
                            <h4 class=" text-on-front card-title " style="position: relative; font-size: 5em; font-weight: 900; color: #FFF; text-transform: lowcase; margin-left: -5px; z-index: 1; margin-top: -200px; margin-left: -15px">Meio</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table tablesorter " id="simple-table">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>
                                            Ações
                                        </th>
                                        <th class="text-center">
                                            Pontuação
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="pontos in pontos_meio" :key="pontos.id">
                                        <td>{{getAcaoName(pontos.id)}}</td>
                                        <td class="text-success text-center">{{pontos.pontuacao > 0 ? '+':'-'}}{{pontos.pontuacao}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- <div class="card-footer text-center mb-2 mt-2">
                                    <button class="btn btn-round btn-icon btn-just-icon btn-primary" title="Editar Regra de Pontuação">
                                        <a href="editaRegraDePontuacao.html">
                                            <i class="tim-icons icon-pencil" style="color: #fff"></i>
                                        </a>
                                    </button>
                                    <button class="btn btn-round btn-icon btn-just-icon btn-primary" onclick="demo.showSwal('warning-message-and-confirmation')"
                                        title="Excluir Regra de Pontuação">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-5" v-if="pontos_atirador.length > 0">
                    <div class="card">
                        <div class="card-header">
                            <img src="../assets/img/card-warning.png" style="margin-top: -15px; margin-left: -15px">
                            <h4 class=" text-on-front card-title " style="position: relative; font-size: 5em; font-weight: 900; color: #FFF; text-transform: lowcase; margin-left: -5px; z-index: 1; margin-top: -200px; margin-left: -15px">Atirador</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table tablesorter " id="simple-table">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>
                                            Ações
                                        </th>
                                        <th class="text-center">
                                            Pontuação
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="pontos in pontos_atirador" :key="pontos.id">
                                        <td>{{getAcaoName(pontos.id)}}</td>
                                        <td class="text-success text-center">{{pontos.pontuacao > 0 ? '+':'-'}}{{pontos.pontuacao}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- <div class="card-footer text-center mb-2 mt-2">
                                    <button class="btn btn-round btn-icon btn-just-icon btn-warning" title="Editar Regra de Pontuação">
                                        <a href="editaRegraDePontuacao.html">
                                            <i class="tim-icons icon-pencil" style="color: #fff"></i>
                                        </a>
                                    </button>
                                    <button class="btn btn-round btn-icon btn-just-icon btn-warning" onclick="demo.showSwal('warning-message-and-confirmation')"
                                        title="Excluir Regra de Pontuação">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-5" v-if="pontos_suporte.length > 0">
                    <div class="card">
                        <div class="card-header">
                            <img src="../assets/img/card-success.png" style="margin-top: -15px; margin-left: -15px">
                            <h4 class=" text-on-front card-title " style="position: relative; font-size: 5em; font-weight: 900; color: #FFF; text-transform: lowcase; margin-left: -5px; z-index: 1; margin-top: -200px; margin-left: -15px">Suporte</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table tablesorter " id="simple-table">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>
                                            Ações
                                        </th>
                                        <th class="text-center">
                                            Pontuação
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="pontos in pontos_suporte" :key="pontos.id">
                                        <td>{{getAcaoName(pontos.id)}}</td>
                                        <td class="text-success text-center">{{pontos.pontuacao > 0 ? '+':'-'}}{{pontos.pontuacao}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- <div class="card-footer text-center mb-2 mt-2">
                                    <button class="btn btn-round btn-icon btn-just-icon btn-success" title="Editar Regra de Pontuação">
                                        <a href="editaRegraDePontuacao.html">
                                            <i class="tim-icons icon-pencil" style="color: #fff"></i>
                                        </a>
                                    </button>
                                    <button class="btn btn-round btn-icon btn-just-icon btn-success" onclick="demo.showSwal('warning-message-and-confirmation')"
                                        title="Excluir Regra de Pontuação">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div> -->
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-4 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <img src="../assets/img/card-danger.png" style="margin-top: -15px; margin-left: -15px">
                            <h4 class=" text-on-front card-title " style="position: relative; font-size: 5em; font-weight: 900; color: #FFF; text-transform: lowcase; margin-left: -5px; z-index: 1; margin-top: -200px; margin-left: -15px">Técnico</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table tablesorter " id="simple-table">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>
                                            Ações
                                        </th>
                                        <th class="text-center">
                                            Pontuação
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Abate</td>
                                        <td class="text-success text-center">+2</td>
                                    </tr>
                                    <tr>
                                        <td>Assistência</td>
                                        <td class="text-success text-center">+3</td>
                                    </tr>
                                    <tr>
                                        <td>Derrota</td>
                                        <td class="text-danger text-center">-10</td>
                                    </tr>
                                    <tr>
                                        <td>First Blood</td>
                                        <td class="text-success text-center">+5</td>
                                    </tr>
                                    <tr>
                                        <td>First Tower</td>
                                        <td class="text-success text-center">+5</td>
                                    </tr>
                                    <tr>
                                        <td>Morte</td>
                                        <td class="text-danger text-center">-3</td>
                                    </tr>
                                    <tr>
                                        <td>Vitória</td>
                                        <td class="text-success text-center">+5</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="card-footer text-center mb-2 mt-2">
                                <button class="btn btn-round btn-icon btn-just-icon btn-danger" title="Editar Regra de Pontuação">
                                    <a href="editaRegraDePontuacao.html">
                                        <i class="tim-icons icon-pencil" style="color: #fff"></i>
                                    </a>
                                </button>
                                <button class="btn btn-round btn-icon btn-just-icon btn-danger" onclick="demo.showSwal('warning-message-and-confirmation')"
                                    title="Excluir Regra de Pontuação">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
        <!-- Cadastrar regra de pontuação -->
        <div class="mt-5 content" v-if="!showLista">
            <div class="row">
                <div class="col-md-10 mr-auto ml-auto">
                    <div class="wizard-container">
                        <div class="card card-header" data-color="primary">
                            <form id="RegisterValidation" @submit.prevent="salvarRegraPontuacao()">
                                <div class="card-header text-center">
                                    <h3 class="card-title">Cadastrar Regras de Pontuação</h3>
                                    <h5 class="description">Preencha os campos obrigatórios do formulário.</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group has-label">
                                        <label>Rota *</label>
                                        <select class="form-control" required :disabled="salvando" v-model="form.funcao_id">
                                            <option disabled selected value="0">Selecione a Rota</option>
                                            <option v-for="opt in funcoes" :key="opt.id" :value="opt.id">{{opt.descricao}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group has-label col-md-6" style="margin-left: -15px; display: inline-block; vertical-align: top">
                                        <label>Ação: *</label>
                                        <select class="form-control" required :disabled="salvando" v-model="form.acao_id">
                                            <option disabled selected value="0">Selecione a Ação</option>
                                            <option v-for="opt in acoes" :key="opt.id" :value="opt.id">{{opt.descricao}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group has-label col-md-6" style="display: inline-block; vertical-align: top">
                                        <label for="pontuacao">Pontuação: *</label>
                                        <input class="form-control" v-model="form.pontuacao" name="pontuacao" id="pontuacao" type="number"
                                            required :disabled="salvando"/>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button v-if="!salvando" type="submit" class="btn btn-primary" style="float: right;">Salvar</button>
                                    <div v-if="salvando" class="loader" style="float: right"></div>
                                    <h4 class="category form-category" style="bottom: 100px">* Campos Obrigatórios</h4>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'Juiz',
    data() {
        return {
            showLista: true,
            acoes: [],
            funcoes: [],
            salvando: false,
            form: {
                acao_id: 0,
                funcao_id: 0,
                pontuacao: null,
                campeonato_id: null
            },
            regras: [],
            pontos_topo: [],
            pontos_meio: [],
            pontos_cacador: [],
            pontos_atirador: [],
            pontos_suporte: []
        }
    },
    mounted(){
        this.getAcoes();
        this.getFuncoes();
        this.getRegrasPontuacao();
    },
    methods: {
        getAcoes(){
            axios.get("acoes")
                .then(response => this.acoes = response.data);
        },
        getFuncoes(){
            axios.get("funcoes")
            .then(response => this.funcoes = response.data);
        },
        salvarRegraPontuacao(){
            this.salvando = true;
            const params = this.form
            params.campeonato_id = 1;
            axios.post("regras-pontuacao", params)
                .then(response => {
                    this.salvando = false;
                    this.showLista = true;
                    this.$notify({type: 'success', message: 'Regra de pontuação cadastrada com sucesso!'});
                    this.getRegrasPontuacao();
                })
        },
        getRegrasPontuacao(){
            axios.get("regras-pontuacao?campeonato_id="+1)
                .then(response => {
                    this.regras = response.data
                    this.pontos_meio = this.regras.filter(r => r.funcao_id == 1);
                    this.pontos_topo = this.regras.filter(r => r.funcao_id == 2);
                    this.pontos_cacador = this.regras.filter(r => r.funcao_id == 3);
                    this.pontos_atirador = this.regras.filter(r => r.funcao_id == 4);
                    this.pontos_suporte = this.regras.filter(r => r.funcao_id == 5);
                });
        },
        getAcaoName(id){
            if(id == 1)
                return 'Abate';
            else if(id == 2)
                return 'Assistência';
            else if(id == 3)
                return 'Ward';
            else if(id == 4)
                return 'Torre';
            else if(id == 5)
                return 'Inibidor';
            else if(id == 6)
                return 'Primeiro Abate';
            else if(id == 7)
                return 'Primeira Torre';
            else if(id == 8)
                return 'Morte';
            else if(id == 9)
                return 'Vitória';
        }
    }
}
</script>
<style scoped>
select.form-control {
    color: #8965e0;
}
.loader {
    border: 16px solid #f3f3f3; /* Light grey */
    border-top: 16px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 120px;
    height: 120px;
    animation: spin 2s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>


