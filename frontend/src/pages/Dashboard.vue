<template>
  <div>

    <div class="row">
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

      <!-- <div class="col-lg-3 col-md-6">
        <div class="card card-stats">
          <div class="card-body">
            <div class="row">
              <div class="col-5">
                <div class="info-icon text-center icon-warning">
                  <i class="tim-icons icon-chart-bar-32"></i>
                </div>
              </div>
              <div class="col-7">
                <div class="numbers">
                  <p class="card-category">Ranking da Rodada</p>
                  <h3 class="card-title">56º</h3>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <hr>
            <div class="stats">
              <i class="tim-icons icon-refresh-01"></i> Atualizar
            </div>
          </div>
        </div>
      </div> -->

      <div class="col-lg-3 col-md-6">
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
                  <p class="card-category">Última Pontuação</p>
                  <h3 class="card-title">{{pontosTotal > 0 ? '+' : ''}} {{pontosTotal}} pts</h3>
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

      <div class="col-lg-3 col-md-6">
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

      <!-- <div class="col-lg-3 col-md-6">
        <div class="card card-stats">
          <div class="card-body">
            <div class="row">
              <div class="col-5">
                <div class="info-icon text-center icon-danger">
                  <i class="tim-icons icon-trophy"></i>
                </div>
              </div>
              <div class="col-7">
                <div class="numbers">
                  <p class="card-category">Pontuação Geral</p>
                  <h3 class="card-title">+63 pts</h3>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <hr>
            <div class="stats">
              <i class="tim-icons icon-spaceship"></i> Mantenha-se no Topo
            </div>
          </div>
        </div>
      </div> -->

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
      }
      this.$bus.$on('att:user', this.getUser());
    },
    beforeDestroy() {
        this.$bus.$off('att:user');
    },
    mounted(){
      this.getRegrasPontuacao();
      this.getInfoRodada();
      this.minhaEscalacao();
      this.getPontuacoes();
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
        acoes: []
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
      pontosTotal (){
        let pontos_rodada = 0;
        this.atletasAcoes.map(a => {
          pontos_rodada += a.pontos;
        });
        return pontos_rodada;
      },
    },
    methods: {
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
          let primeiro_response;
          axios.get("escalacoes/"+this.$auth.getUser().id)
              .then(
                  (response) => {

                      if(!response.data){
                          this.loading_fullscreen = false;
                          return null;
                      }
                          
                      let primeiro_response = response;
                      axios.get("atletas/"+primeiro_response.data.topo_id)
                          .then(response => {
                              this.escalacao.topo = response.data;
                              axios.get("atletas/"+primeiro_response.data.meio_id)
                                  .then(response => {
                                      this.escalacao.meio = response.data;
                                      axios.get("atletas/"+primeiro_response.data.cacador_id)
                                          .then(response => {
                                              this.escalacao.cacador = response.data;
                                              axios.get("atletas/"+primeiro_response.data.atirador_id)
                                                  .then(response => {
                                                      this.escalacao.atirador = response.data;
                                                      axios.get("atletas/"+primeiro_response.data.suporte_id)
                                                          .then(response => {
                                                              this.escalacao.suporte = response.data;
                                                              this.loading_fullscreen = false;
                                                          });
                                                  });
                                          });
                                  });
                          });
                  },
                  (error) => {
                      console.error(error);
                  }
              )
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
        axios.post("auth/me")
          .then(
            response => {
              this.user = response.data;
              console.log(this.user);
            },
            error => console.error(error)
          );
      }
    },
  };
</script>
<style>
</style>
