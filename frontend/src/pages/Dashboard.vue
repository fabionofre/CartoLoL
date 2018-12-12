<template>
  <div>
    <div v-if="loading_fullscreen" class="loader-fullscreen"></div>
    <div v-else class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-md-12 text-center text-success ml-auto mr-auto">
                <h2 class="text-success" v-if="mercado_fecha_em != 'Mercado fechado!'">Mercado Aberto</h2>
                <h3 class="text-danger">{{mercado_fecha_em}}</h3>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col col-md-12 mb-3">
        <img src="../assets/img/hyperx-propaganda.jpg" height="250px;" width="100%;">
      </div>

      <div class="col-lg-3 col-md-3">
        <div class="card card-stats">
          <div class="card-body">
            <div class="row">
              <div class="col-5">
                <div class="info-icon text-center icon-primary">
                  <i class="tim-icons icon-shape-star"></i>
                </div>
              </div>
              <div class="col-7">
                <div class="numbers">
                  <p class="card-category">Sua Pontuação</p>
                  <h3 class="card-title">{{meusPontos > 0 ? '+' : ''}} {{meusPontos}} pts</h3>
                </div>
              </div>
            </div>
          </div>
          <!-- <div class="card-footer">
            <hr>
            <div class="stats">
              <i class="tim-icons icon-sound-wave"></i> Última Pesquisa
            </div>
          </div> -->
        </div>
      </div>
      <div class="col-lg-3 col-md-3">
        <div class="card card-stats">
          <div class="card-body">
            <div class="row">
              <div class="col-5">
                <div class="info-icon text-center icon-success">
                  <i class="tim-icons icon-coins"></i>
                </div>
              </div>
              <div class="col-7">
                <div class="numbers">
                  <p class="card-category">Patrimônio</p>
                  <h3 class="card-title">Z$ {{user.patrimonio}}</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-3">
        <div class="card card-stats">
          <div class="card-body">
            <div class="row">
              <div class="col-5">
                <div class="info-icon text-center">
                  <i class="tim-icons icon-planet"></i>
                </div>
              </div>
              <div class="col-7">
                <div class="numbers">
                  <p class="card-category">Colocação Geral</p>
                  <h3 class="card-title" v-if="colocacaoGeral">{{colocacaoGeral}}º</h3>
                  <h4 class="card-title" v-else>Nenhuma</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-3" v-if="atletaDestaque">
        <div class="card card-stats">
          <div class="card-body">
            <div class="row">
              <div class="col-3">
                <div class="text-center">
                  <img class="foto-player-card" 
                  :src="'http://localhost:8000/storage/'+atletaDestaque.foto" 
                  alt="photo">
                </div>
              </div>
              <div class="col-5">
                <div class="numbers">
                  <p class="card-category">Destaque</p>
                  <h4 class="card-title">{{atletaDestaque.apelido}}</h4>
                </div>
              </div>
              <div class="col-4">
                <h4 class="card-title">
                  {{atletaDestaque.pontos > 0 ? '+' : ''}}{{atletaDestaque.pontos}}
                </h4>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div 
      v-if="(escalacao.topo || escalacao.meio || escalacao.cacador || escalacao.atirador ||
      escalacao.suporte)" 
      class="col-lg-6 col-md-6">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Sua escalação</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead class="text-primary">
                    <tr>
                      <th class="text-center">
                        #
                      </th>
                      <th>
                        Nome
                      </th>
                      <th>
                        Apelido
                      </th>
                      <th>
                        Pontos
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="atleta in atletasEscalacao" :key="atleta.id">
                      <td class="text-center">
                        <div>
                          <img class="foto-player" 
                          :src="'http://localhost:8000/storage/'+atleta.foto" 
                          alt="photo">
                        </div>
                      </td>
                      <td>
                        {{atleta.nome}}
                      </td>
                      <td>
                        {{atleta.apelido}}
                      </td>
                      <td>
                        {{atleta.pontos}}
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
        </div>
      </div>
      <div 
      class="col-lg-6 col-md-6">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Top 10 ZLeague</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead class="text-primary">
                    <tr>
                      <th class="text-center">
                        Foto
                      </th>
                      <th class="text-center">
                        Colocação
                      </th>
                      <th class="text-center">
                        Apelido
                      </th>
                      <th class="text-center">
                        Pontos
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(escalacao, key) in escalacoes" 
                    :key="escalacao.id"
                    :class="{'table-success': escalacao.invocador.id == user.id}"
                    >
                      <td class="text-center">
                        <div>
                          <img class="foto-player" 
                          :src="'http://localhost:8000/storage/'+escalacao.invocador.foto" 
                          alt="photo">
                        </div>
                      </td>
                      <td class="text-center">
                        {{key+1}}º
                      </td>
                      <td class="text-center">
                        {{escalacao.invocador.apelido}}
                      </td>
                      <td class="text-center">
                        {{escalacao.pontos}}
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
        </div>
      </div>
      <div 
      class="col-lg-6 col-md-6">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Jogadores Destaque</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead class="text-primary">
                    <tr>
                      <th class="text-center">
                        Foto
                      </th>
                      <th class="text-center">
                        Colocação
                      </th>
                      <th class="text-center">
                        Apelido
                      </th>
                      <th class="text-center">
                        Pontos
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(jogador, key) in atletasDaRodada" 
                    :key="jogador.id"
                    >
                      <td class="text-center">
                        <div>
                          <img class="foto-player" 
                          :src="'http://localhost:8000/storage/'+jogador.foto" 
                          alt="photo">
                        </div>
                      </td>
                      <td class="text-center">
                        {{key+1}}º
                      </td>
                      <td class="text-center">
                        {{jogador.apelido}}
                      </td>
                      <td class="text-center">
                        {{jogador.pontos}}
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6" v-for="liga in user.ligas_participo" :key="liga.id">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title text-center">
              <img class="brasao-liga" 
              :src="'http://localhost:8000/storage/'+liga.brasao" 
              alt="photo">
              <h2 class="mt-3">{{liga.desc}}</h2>
            </h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class="text-primary">
                  <tr>
                    <th class="text-center">
                      Foto
                    </th>
                    <th class="text-center">
                      Colocação
                    </th>
                    <th class="text-center">
                      Apelido
                    </th>
                    <th class="text-center">
                      Pontos
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(invocador, key) in ordenarParticipantes(liga.participantes)" 
                  :key="invocador.id"
                  :class="{'table-success': invocador.id == user.id}"
                  >
                    <td class="text-center">
                      <div>
                        <img class="foto-player" 
                        :src="'http://localhost:8000/storage/'+invocador.foto" 
                        alt="photo">
                      </div>
                    </td>
                    <td class="text-center">
                      {{key+1}}º
                    </td>
                    <td class="text-center">
                      {{invocador.email}}
                    </td>
                    <td class="text-center">
                      <div v-if="invocador.calculando" 
                      class="loader-calculando"></div>
                      <span v-else>{{invocador.escalacao.pontos}}</span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import axios from 'axios';
  import LineChart from '@/components/Charts/LineChart';
  import BarChart from '@/components/Charts/BarChart';
  import * as chartConfigs from '@/components/Charts/config';
  import TaskList from './Dashboard/TaskList';
  import UserTable from './Dashboard/UserTable';
  import config from '@/config';

  export default {
    components: {
      LineChart,
      BarChart,
      TaskList,
      UserTable
    },
    created(){
      if(!(this.user) && this.$auth.isAuthenticated()){
        this.user = this.$auth.getUser();
        this.token = this.$auth.getToken();
      }
      this.$bus.$on('att:user', this.getUser());
    },
    beforeDestroy() {
        this.$bus.$off('att:user');
    },
    mounted(){
      this.getUser();
      this.getRegrasPontuacao();
      this.getInfoRodada();
      this.minhaEscalacao();
      this.getEscalacoes();
    },
    data() {
      return {
        bigLineChart: {
          allData: [
            [100, 70, 90, 70, 85, 60, 75, 60, 90, 80, 110, 100],
            [80, 120, 105, 110, 95, 105, 90, 100, 80, 95, 70, 120],
            [60, 80, 65, 130, 80, 105, 90, 130, 70, 115, 60, 130]
          ],
          activeIndex: 0,
          chartData: null,
          extraOptions: chartConfigs.purpleChartOptions,
          gradientColors: config.colors.primaryGradient,
          gradientStops: [1, 0.4, 0],
          categories: []
        },
        purpleLineChart: {
          extraOptions: chartConfigs.purpleChartOptions,
          chartData: {
            labels: ['JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
            datasets: [{
              label: "Data",
              fill: true,
              borderColor: config.colors.primary,
              borderWidth: 2,
              borderDash: [],
              borderDashOffset: 0.0,
              pointBackgroundColor: config.colors.primary,
              pointBorderColor: 'rgba(255,255,255,0)',
              pointHoverBackgroundColor: config.colors.primary,
              pointBorderWidth: 20,
              pointHoverRadius: 4,
              pointHoverBorderWidth: 15,
              pointRadius: 4,
              data: [80, 100, 70, 80, 120, 80],
            }]
          },
          gradientColors: config.colors.primaryGradient,
          gradientStops: [1, 0.2, 0],
        },
        greenLineChart: {
          extraOptions: chartConfigs.greenChartOptions,
          chartData: {
            labels: ['JUL', 'AUG', 'SEP', 'OCT', 'NOV'],
            datasets: [{
              label: "My First dataset",
              fill: true,
              borderColor: config.colors.danger,
              borderWidth: 2,
              borderDash: [],
              borderDashOffset: 0.0,
              pointBackgroundColor: config.colors.danger,
              pointBorderColor: 'rgba(255,255,255,0)',
              pointHoverBackgroundColor: config.colors.danger,
              pointBorderWidth: 20,
              pointHoverRadius: 4,
              pointHoverBorderWidth: 15,
              pointRadius: 4,
              data: [90, 27, 60, 12, 80],
            }]
          },
          gradientColors: ['rgba(66,134,121,0.15)', 'rgba(66,134,121,0.0)', 'rgba(66,134,121,0)'],
          gradientStops: [1, 0.4, 0],
        },
        blueBarChart: {
          extraOptions: chartConfigs.barChartOptions,
          chartData: {
            labels: ['USA', 'GER', 'AUS', 'UK', 'RO', 'BR'],
            datasets: [{
              label: "Countries",
              fill: true,
              borderColor: config.colors.info,
              borderWidth: 2,
              borderDash: [],
              borderDashOffset: 0.0,
              data: [53, 20, 10, 80, 100, 45],
            }]
          },
          gradientColors: config.colors.primaryGradient,
          gradientStops: [1, 0.4, 0],
        },
        rodada_atual: null,
        mercado_fecha_em: '',
        user: null,
        escalacao: {
            topo: null,
            meio: null,
            cacador: null,
            atirador: null,
            suporte: null
        },
        atletasAcoes: [],
        acoes: [],
        token: null,
        meusPontos: 0,
        loading_fullscreen: false,
        atletasEscalacao: [],
        escalacoes: [],
        top10: [],
        colocacaoGeral: null,
        atletasDaRodada: [],
        atletaDestaque: null
      }
    },
    computed: {
      enableRTL() {
        return this.$route.query.enableRTL;
      },
      isRTL() {
        return this.$rtl.isRTL;
      },
      bigLineChartCategories() {
        return ['Abates', 'Assistências', 'Wards  '];
      },
    },
    methods: {
      getEscalacoes(){
        axios.get("escalacoes")
          .then(response => {
            let todasEscalacoes = response.data;
            todasEscalacoes = todasEscalacoes.map(e => {
              e.calculando = true;
              return e;
            });
            axios.get('pontuacoes')
              .then(
              response => {
                  const pontuacoes = response.data;
                  let atletasAcoes = [];
                  _.forEach(pontuacoes, p => {
                      let atleta = p.atleta;
                      atletasAcoes.push(atleta);
                  });
                  atletasAcoes = _.uniqBy(atletasAcoes, 'id');
                  atletasAcoes.map(a => a.pontos = 0);
                  _.forEach(pontuacoes, p => {
                  let atleta_id = p.atleta.id;
                      _.forEach(atletasAcoes, a => {
                          if(atleta_id == a.id){
                          // Dá os pontos aqui!
                          let acao = _.find(this.acoes, acao => {
                              return acao.acao_id == p.acao_id
                          });
                          if(acao)
                              a.pontos += (acao.pontuacao * p.quantidade);       
                          }
                      });
                  });
                  const atletasDaRodada = _.orderBy(atletasAcoes, ['pontos'], ['desc']);
                  this.atletasDaRodada = atletasDaRodada.slice(0, 10);
                  this.atletaDestaque = this.atletasDaRodada[0];
                  todasEscalacoes.map(escalacao => {
                    escalacao.pontos = 0;
                    let topo = _.find(atletasAcoes, a => escalacao.topo.id == a.id);
                    if(topo){
                      escalacao.pontos += topo.pontos;
                    }
                    let meio = _.find(atletasAcoes, a => escalacao.meio.id == a.id);
                    if(meio){
                      escalacao.pontos += meio.pontos;
                    }
                    let cacador = _.find(atletasAcoes, a => escalacao.cacador.id == a.id);
                    if(cacador){
                      escalacao.pontos += cacador.pontos;
                    }
                    let suporte = _.find(atletasAcoes, a => escalacao.suporte.id == a.id);
                    if(suporte){
                        escalacao.pontos += suporte.pontos;
                    }
                    let atirador = _.find(atletasAcoes, a => escalacao.atirador.id == a.id);
                    if(atirador){
                      escalacao.pontos += atirador.pontos;
                    }
                    delete escalacao.calculando;
                    this.$forceUpdate();
                  });
                  this.escalacoes = _.orderBy(todasEscalacoes, ['pontos'], ['desc']);
                  this.escalacoes.map((e, index) => {
                    if(e.invocador_id == this.user.id)
                      this.colocacaoGeral = index+1;  
                  });
                  this.top10 = this.escalacoes.slice(0,10);
              });
          });
      },
      ordenarParticipantes(participantes){
          if(!participantes) return []
          return _.orderBy(participantes, p => {
            return p.escalacao.pontos;
          }, ['desc']);
      },
      initBigChart(index) {
        let chartData = {
          datasets: [{
            fill: true,
            borderColor: config.colors.primary,
            borderWidth: 2,
            borderDash: [],
            borderDashOffset: 0.0,
            pointBackgroundColor: config.colors.primary,
            pointBorderColor: 'rgba(255,255,255,0)',
            pointHoverBackgroundColor: config.colors.primary,
            pointBorderWidth: 20,
            pointHoverRadius: 4,
            pointHoverBorderWidth: 15,
            pointRadius: 4,
            data: this.bigLineChart.allData[index]
          }],
          labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
        }
        this.$refs.bigChart.updateGradients(chartData);
        this.bigLineChart.chartData = chartData;
        this.bigLineChart.activeIndex = index;
      },
      getInfoRodada(){
        axios.get("campeonatos/1")
        .then(
          response => {
            this.rodada_atual = response.data.rodada_atual;
            const diferenca_horas = this.rodada_atual.diferenca_horas_hoje;
            if(diferenca_horas > 24){
              const diferenca_dias = diferenca_horas / 24;
              this.mercado_fecha_em = 'Fecha em ' + Math.round(diferenca_dias) + (diferenca_dias > 1 ? ' dias' : ' dias');
            }else{
              this.mercado_fecha_em = 'Fecha em ' + diferenca_horas + (diferenca_horas > 1 ? ' horas' : ' hora');
              if(diferenca_horas == 0)
                this.mercado_fecha_em = 'Mercado fechado!';
            }
          },
          error => console.error(error)
        );
      },
      minhaEscalacao(){
        this.loading_fullscreen = true;
        axios.get("escalacoes/"+this.$auth.getUser().id)
            .then(
                (response) => {

                    if(!response.data){
                        this.loading_fullscreen = false;
                        return null;
                    }
                        
                    this.escalacao.topo = response.data.topo;
                    this.escalacao.meio = response.data.meio;
                    this.escalacao.cacador = response.data.cacador;
                    this.escalacao.atirador = response.data.atirador;
                    this.escalacao.suporte = response.data.suporte;
                    this.getPontuacoes();
                }),
                (error) => {
                    console.error(error);
                }
      },
      getPontuacoes(){
        axios.get('pontuacoes')
          .then(
            response => {
              const pontuacoes = response.data;
              _.forEach(pontuacoes, p => {
                let atleta = p.atleta;
                this.atletasAcoes.push(atleta);
              });
              this.atletasAcoes = _.uniqBy(this.atletasAcoes, 'id');
              this.atletasAcoes.map(a => a.pontos = 0);
              _.forEach(pontuacoes, p => {
                let atleta_id = p.atleta.id;
                _.forEach(this.atletasAcoes, a => {
                  if(atleta_id == a.id){
                    // Dá os pontos aqui!
                    let acao = _.find(this.acoes, acao => {
                      return acao.acao_id == p.acao_id
                    });
                    if(acao)
                      a.pontos += (acao.pontuacao * p.quantidade);               }
                });
              });
              let topo = _.find(this.atletasAcoes, a => this.escalacao.topo.id == a.id);
              if(topo){
                this.meusPontos += topo.pontos;
                this.escalacao.topo.pontos = topo.pontos;
              }else{
                this.escalacao.topo.pontos = 0;
              }
              this.atletasEscalacao.push(this.escalacao.topo);
              let meio = _.find(this.atletasAcoes, a => this.escalacao.meio.id == a.id);
              if(meio){
                this.meusPontos += meio.pontos;
                this.escalacao.meio.pontos = meio.pontos;
              }else{
                this.escalacao.meio.pontos = 0;
              }

              this.atletasEscalacao.push(this.escalacao.meio);
              let cacador = _.find(this.atletasAcoes, a => this.escalacao.cacador.id == a.id);
              if(cacador){
                this.meusPontos += cacador.pontos;
                this.escalacao.cacador.pontos = cacador.pontos;
              }else{
                this.escalacao.cacador.pontos = 0;
              }
              this.atletasEscalacao.push(this.escalacao.cacador);
              let suporte = _.find(this.atletasAcoes, a => this.escalacao.suporte.id == a.id);
              if(suporte){
                this.meusPontos += suporte.pontos;
                this.escalacao.suporte.pontos = suporte.pontos;
              }else{
                this.escalacao.suporte.pontos = 0;
              }
              this.atletasEscalacao.push(this.escalacao.suporte);
              let atirador = _.find(this.atletasAcoes, a => this.escalacao.atirador.id == a.id);
              if(atirador){
                this.meusPontos += atirador.pontos;
                this.escalacao.atirador.pontos = atirador.pontos;
              }else{
                this.escalacao.atirador.pontos = 0;
              }
              this.atletasEscalacao.push(this.escalacao.atirador);
              this.loading_fullscreen = false;
              this.atletasEscalacao = _.orderBy(this.atletasEscalacao, ['pontos'],['desc']);
            },
            error => console.error(error)
          )
      },
      getRegrasPontuacao(){
        axios.get("regras-pontuacao?campeonato_id=1")
          .then(
            response => {
              this.acoes = response.data;
            },
            error => console.error(error)
          );
      },
      getUser(){
        axios.get("usuarios/"+this.user.id)
          .then((response) => {
            this.user = response.data;
            this.user.ligas_participo.map(liga => {
              liga.participantes.map(invocador => {
                this.calcularPontos(invocador);
              });
            });
          },
          error => console.error(error)
          )
      },
      calcularPontos(invocador){
        invocador.calculando = true;
        invocador.escalacao = {
          topo: null, meio: null, cacador: null,
          atirador: null, suporte: null
        };
        axios.get("escalacoes/"+invocador.id)
            .then(
                (response) => {

                    if(!response.data){
                        this.loading_fullscreen = false;
                        return null;
                    };
                        
                    invocador.escalacao.topo = response.data.topo;
                    invocador.escalacao.meio = response.data.meio;
                    invocador.escalacao.cacador = response.data.cacador;
                    invocador.escalacao.atirador = response.data.atirador;
                    invocador.escalacao.suporte = response.data.suporte;
                    axios.get('pontuacoes')
                        .then(
                        response => {
                            const pontuacoes = response.data;
                            let atletasAcoes = [];
                            _.forEach(pontuacoes, p => {
                                let atleta = p.atleta;
                                atletasAcoes.push(atleta);
                            });
                            atletasAcoes = _.uniqBy(atletasAcoes, 'id');
                            atletasAcoes.map(a => a.pontos = 0);
                            _.forEach(pontuacoes, p => {
                            let atleta_id = p.atleta.id;
                                _.forEach(atletasAcoes, a => {
                                    if(atleta_id == a.id){
                                    // Dá os pontos aqui!
                                    let acao = _.find(this.acoes, acao => {
                                        return acao.acao_id == p.acao_id
                                    });
                                    if(acao)
                                        a.pontos += (acao.pontuacao * p.quantidade);               
                                    }
                                });
                            });
                            invocador.escalacao.pontos = 0;
                            let topo = _.find(atletasAcoes, a => invocador.escalacao.topo.id == a.id);
                            if(topo){
                                invocador.escalacao.pontos += topo.pontos;
                            }
                            let meio = _.find(atletasAcoes, a => invocador.escalacao.meio.id == a.id);
                            if(meio){
                                invocador.escalacao.pontos += meio.pontos;
                            }
                            let cacador = _.find(atletasAcoes, a => invocador.escalacao.cacador.id == a.id);
                            if(cacador){
                                invocador.escalacao.pontos += cacador.pontos;
                            }
                            let suporte = _.find(atletasAcoes, a => invocador.escalacao.suporte.id == a.id);
                            if(suporte){
                                invocador.escalacao.pontos += suporte.pontos;
                            }
                            let atirador = _.find(atletasAcoes, a => invocador.escalacao.atirador.id == a.id);
                            if(atirador){
                                invocador.escalacao.pontos += atirador.pontos;
                            }
                            delete invocador.calculando;
                            this.$forceUpdate();
                        }),
                        (error) => {
                            console.error(error);
                        }
                })
        },
    },
  };
</script>
<style lang="scss" scoped>
.table-responsive {
    overflow: hidden;
}

.foto-player {
    max-width: 30px;
    margin-right: 10px;
    border-radius: 50px;
    height: 30px;
}

.foto-player-card {
    max-width: 60px;
    margin-right: 10px;
    border-radius: 50px;
    height: 60px;
}

.loader-fullscreen {
    border: 20px solid #f3f3f3;
    border-top: 20px solid #e14eca; /* Roxo */
    border-radius: 50%;
    width: 350px;
    height: 350px;
    left: 30%;
    animation: spin 2s linear infinite;
    position: relative;  
}

.brasao-liga {
  max-width: 200px;
}

.loader-calculando {
    border: 5px solid #f3f3f3;
    border-top: 5px solid #e14eca; /* Roxo */
    border-radius: 50%;
    width: 20px;
    height: 20px;
    animation: spin 2s linear infinite;
    position: relative; 
    margin: 0 10px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
