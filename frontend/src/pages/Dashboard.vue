<template>
  <div>
    <div v-if="loading_fullscreen" class="loader-fullscreen"></div>
    <div v-else class="row">
      <div class="col-12">
        <div class="card" v-if="campeonato && temPropriedade(campeonato, 'rodada_atual')">
          <div class="card-header">
            <div class="row">
              <div class="col-md-12 text-center text-success ml-auto mr-auto">
                <!-- <h2 class="text-success">{{campeonato.rodada_atual.descricao}}</h2> -->
                <h2 class="text-success">Ranking Geral</h2>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col col-md-12 mb-3">
        <img src="../assets/img/hyperx-propaganda.jpg" height="250px;" width="100%;">
      </div>

      <!-- <div class="col-lg-3 col-md-3">
        <div class="card card-stats">
          <div class="card-body">
            <div class="row d-flex align-items-center">
              <div class="col-5">
                <div class="info-icon text-center icon-primary">
                  <i class="tim-icons icon-shape-star"></i>
                </div>
              </div>
              <div class="col-7">
                <div class="numbers">
                  <p class="card-category">Sua Pontuação no Campeonato</p>
                  <h3 class="card-title">+{{pontuacaoCampeonato}} pts</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> -->

      <div class="col-lg-3 col-md-3">
        <div class="card card-stats">
          <div class="card-body">
            <div class="row d-flex align-items-center">
              <div class="col-5">
                <div class="info-icon text-center icon-primary">
                  <i class="tim-icons icon-shape-star"></i>
                </div>
              </div>
              <div class="col-7">
                <div class="numbers">
                  <p class="card-category">Sua Pontuação</p>
                  <h3 class="card-title">+{{parseFloat(meusPontos / 5).toFixed(2)}} pts</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="col-lg-3 col-md-3">
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
      </div> -->
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
      <div class="col-lg-6 col-md-3" v-if="atletaDestaque">
        <div class="card card-stats" style="width: 50%;">
          <div class="card-body">
            <div class="row">
              <div class="col-3">
                <div class="text-center">
                  <img class="foto-player-card" 
                  :src="'http://www.zleague.com.br:8000/storage/'+atletaDestaque.foto" 
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
                  {{atletaDestaque.pontos > 0 ? '+' : ''}}{{parseFloat(atletaDestaque.pontos).toFixed(2)}}
                </h4>
              </div>
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
                    <tr v-for="(escalacao, key) in top10" 
                    :key="escalacao.id"
                    :class="{'table-success': escalacao.invocador.id == user.id}"
                    >
                      <td class="text-center">
                        <div>
                          <img class="foto-player" 
                          :src="'http://www.zleague.com.br:8000/storage/'+escalacao.invocador.foto" 
                          alt="photo" v-if="escalacao.invocador.foto">
                          <img class="foto-player" v-if="!escalacao.invocador.foto" src="../assets/img/default-avatar.png">
                        </div>
                      </td>
                      <td class="text-center">
                        {{key+1}}º
                      </td>
                      <td class="text-center">
                        {{escalacao.invocador.apelido}}
                      </td>
                      <td class="text-center">
                        {{parseFloat(escalacao.pontos / 5).toFixed(2)}}
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
                          :src="'http://www.zleague.com.br:8000/storage/'+jogador.foto" 
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
                        {{parseFloat(jogador.pontos).toFixed(2)}}
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
        </div>
      </div>
      <div 
      v-if="atletasEscalacao.length >= 5" 
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
                    <tr v-for="atleta in atletasEscalacao" 
                    :key="atleta.id">
                      <td class="text-center">
                        <div>
                          <img class="foto-player" 
                          :src="'http://www.zleague.com.br:8000/storage/'+atleta.foto" 
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
                        {{parseFloat(atleta.pontos).toFixed(2)}}
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
              :src="'http://www.zleague.com.br:8000/storage/'+liga.brasao" 
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
                        :src="'http://www.zleague.com.br:8000/storage/'+invocador.foto" 
                        alt="photo" v-if="invocador.foto">
                        <img class="foto-player" v-if="!invocador.foto" src="../assets/img/default-avatar.png">
                      </div>
                    </td>
                    <td class="text-center">
                      {{key+1}}º
                    </td>
                    <td class="text-center">
                      {{invocador.apelido}}
                    </td>
                    <td class="text-center">
                      <div v-if="invocador.calculando" 
                      class="loader-calculando"></div>
                      <span v-else>{{parseFloat(invocador.escalacao.pontos / 5).toFixed(2)}}</span>
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
      this.getPontuacoes();
      this.getRegrasPontuacao();
      this.getUser();
      this.getCampeonato();
      this.getEscalacoes();
      this.minhasEscalacoes();
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
        user: null,
        escalacao: {
            topo: null,
            meio: null,
            cacador: null,
            atirador: null,
            suporte: null
        },
        escalacoes: [],
        atletasAcoes: [],
        acoes: [],
        token: null,
        loading_fullscreen: false,
        atletasEscalacao: [],
        escalacoes: [],
        top10: [],
        colocacaoGeral: null,
        atletasDaRodada: [],
        atletaDestaque: null,
        campeonato: null,
        pontuacaoCampeonato: 0,
        pontuacaoRodada: 0,
        pontuacoes: [],
        meusPontos: 0
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
                  if(atletasAcoes[0]){
                    atletasAcoes.map(a => a.pontos = 0);
                    _.forEach(pontuacoes, p => {
                    let atleta_id = p.atleta.id;
                        _.forEach(atletasAcoes, a => {
                            if(atleta_id == a.id){
                            // Dá os pontos aqui!
                            let acao = _.find(this.acoes, ac => {
                                return (ac.acao_id == p.acao_id) && (a.funcao_id == ac.funcao_id);
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
                      if(escalacao.topo){
                        let topo = _.find(atletasAcoes, a => escalacao.topo.id == a.id);
                        if(topo){
                          escalacao.pontos += topo.pontos;
                          escalacao.topo.pontos = topo.pontos;
                        }
                      }
                      if(escalacao.meio){
                        let meio = _.find(atletasAcoes, a => escalacao.meio.id == a.id);
                        if(meio){
                          escalacao.pontos += meio.pontos;
                          escalacao.meio.pontos = meio.pontos;
                        }
                      }
                      if(escalacao.cacador){
                        let cacador = _.find(atletasAcoes, a => escalacao.cacador.id == a.id);
                        if(cacador){
                          escalacao.pontos += cacador.pontos;
                          escalacao.cacador.pontos = cacador.pontos;
                        }
                      }
                      if(escalacao.cacador){
                        let suporte = _.find(atletasAcoes, a => escalacao.suporte.id == a.id);
                        if(suporte){
                            escalacao.pontos += suporte.pontos;
                            escalacao.suporte.pontos = suporte.pontos;
                        }
                      }
                      if(escalacao.atirador){
                        let atirador = _.find(atletasAcoes, a => escalacao.atirador.id == a.id);
                        if(atirador){
                          escalacao.pontos += atirador.pontos;
                          escalacao.atirador.pontos = atirador.pontos;
                        }
                      }
                      if(escalacao.invocador.id == this.user.id){
                        this.atletasEscalacao.push(escalacao.cacador);
                        this.atletasEscalacao.push(escalacao.topo);
                        this.atletasEscalacao.push(escalacao.meio);
                        this.atletasEscalacao.push(escalacao.suporte);
                        this.atletasEscalacao.push(escalacao.atirador);
                        this.atletasEscalacao = _.orderBy(this.atletasEscalacao, ['pontos'],['desc']);
                        this.atletasEscalacao.map(atleta => {
                          this.meusPontos += atleta.pontos;
                        });
                        console.log("atletasEscalacao", this.atletasEscalacao);
                      }
                      delete escalacao.calculando;
                      this.$forceUpdate();
                    });
                    this.escalacoes = _.orderBy(todasEscalacoes, ['pontos'], ['desc']);
                    this.escalacoes.map((e, index) => {
                      if(e.invocador_id == this.user.id)
                        this.colocacaoGeral = index+1;  
                    });
                    const top10 = this.escalacoes.slice(0,10);
                    this.top10 = _.uniqBy(top10, 'invocador_id');
                  }else{
                    todasEscalacoes = todasEscalacoes.map(e => {
                      e.calculando = false;
                      return e;
                    });
                  }
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
      getCampeonato(){
        axios.get("campeonatos/1")
        .then(
          response => {
            this.campeonato = response.data.campeonato;
          },
          error => console.error(error)
        );
      },
      minhasEscalacoes(){
        this.loading_fullscreen = true;
        axios.get("minhas-escalacoes/"+this.$auth.getUser().id)
          .then(
              (response) => {

                  if(!response.data){
                      this.loading_fullscreen = false;
                      return null;
                  }

                  this.escalacoes = response.data[0];

                  this.loading_fullscreen = false;
                  

              }),
              (error) => {
                  console.error(error);
              }
      },
      getPontuacaoEscalacao(escalacao){
        const atletas = [];
        let atletasAcoes = [];
        let escalacaoPontos = 0;
        _.forEach(this.pontuacoes, p => {
          let atleta = p.atleta;
          atletasAcoes.push(atleta);
        });
        atletasAcoes = _.uniqBy(atletasAcoes, 'id');
        if(atletasAcoes[0]){
          atletasAcoes.map(a => a.pontos = 0);
          _.forEach(this.pontuacoes, p => {
            let atleta_id = p.atleta.id;
            if(escalacao.rodada_id == p.rodada_id){
              _.forEach(atletasAcoes, a => {
                if(atleta_id == a.id){
                  // Dá os pontos aqui!
                  let acao = _.find(this.acoes, ac => {
                    return (ac.acao_id == p.acao_id) && (a.funcao_id == ac.funcao_id);
                  });
                  console.log(this.acoes);
                  if(acao)
                    a.pontos += (acao.pontuacao * p.quantidade);               
                }
              });
            }
          });
          if(escalacao.topo){
            let topo = _.find(atletasAcoes, a => escalacao.topo.id == a.id);
            if(topo){
              escalacaoPontos += topo.pontos;
              escalacao.topo.pontos = topo.pontos;
            }else{
              escalacao.topo.pontos = 0;
            }
          }
          this.atletasEscalacao.push(this.escalacao.topo);
          if(escalacao.meio){
            let meio = _.find(atletasAcoes, a => escalacao.meio.id == a.id);
            if(meio){
              escalacaoPontos += meio.pontos;
              escalacao.meio.pontos = meio.pontos;
            }else{
              escalacao.meio.pontos = 0;
            }
          }
          this.atletasEscalacao.push(this.escalacao.meio);
          if(escalacao.cacador){
            let cacador = _.find(atletasAcoes, a => escalacao.cacador.id == a.id);
            if(cacador){
              escalacaoPontos += cacador.pontos;
              escalacao.cacador.pontos = cacador.pontos;
            }else{
              escalacao.cacador.pontos = 0;
            }
          }
          this.atletasEscalacao.push(this.escalacao.cacador);
          if(escalacao.suporte){
            let suporte = _.find(atletasAcoes, a =>escalacao.suporte.id == a.id);
            if(suporte){
              escalacaoPontos += suporte.pontos;
              escalacao.suporte.pontos = suporte.pontos;
            }else{
              escalacao.suporte.pontos = 0;
            }
          }
          this.atletasEscalacao.push(this.escalacao.suporte);
          if(escalacao.atirador){
            let atirador = _.find(atletasAcoes, a => escalacao.atirador.id == a.id);
            if(atirador){
              escalacaoPontos += atirador.pontos;
              escalacao.atirador.pontos = atirador.pontos;
            }else{
              escalacao.atirador.pontos = 0;
            }
          }
          this.atletasEscalacao.push(this.escalacao.atirador);
          this.atletasEscalacao = _.orderBy(this.atletasEscalacao, ['pontos'],['desc']);
          console.log("Escalacao da rodada: ",escalacao.rodada_id+" - ", escalacaoPontos);
        }

        return escalacaoPontos;
      },
      getPontuacoes(){
        axios.get('pontuacoes')
          .then(response => {
            this.pontuacoes = response.data;
          });
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
          },
          error => console.error(error)
          )
      },
      temPropriedade(obj, prop){
        if(obj.hasOwnProperty(prop)){
          return true;
        }else{
          return false;
        }
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
    @media screen and (max-width: 768px){
        width: 250px;
        height: 250px;
        left: 15%;
    }
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
