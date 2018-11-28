@extends('layouts.main')

@section('content')
<div class="row">
          <div class="col-xl-6 col-12 hidden">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Revenue</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                  <ul class="list-inline mb-0">
                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                  </ul>
                </div>
              </div>
              <div class="card-content collapse show">
                <div class="card-body pt-0">
                  <div class="row mb-1">
                    <div class="col-6 col-md-4">
                      <h5>Current week</h5>
                      <h2 class="danger">$82,124</h2>
                    </div>
                    <div class="col-6 col-md-4">
                      <h5>Previous week</h5>
                      <h2 class="text-muted">$52,502</h2>
                    </div>
                  </div>
                  <div class="chartjs">
                    <canvas id="thisYearRevenue" width="400" style="position: absolute;"></canvas>
                    <canvas id="lastYearRevenue" width="400"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--Primer Periodo-->
          <div class="col-xl-6 col-12">
            <div class="row">
              <div class="col-lg-6 col-12">
                <div class="card pull-up">
                  <div class="card-header bg-hexagons">
                    <h4 class="card-title">Rendimiento Academico
                      <span class="danger">Primer Periodo</span>
                    </h4>                    
                    <div class="heading-elements">
                      <ul class="list-inline mb-0">
                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="card-content collapse show bg-hexagons">
                    <div class="card-body pt-0">
                      <div class="chartjs">
                        <canvas id="hit-rate-doughnut" height="275"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!--Segundo Periodo-->
              <div class="col-lg-6 col-12">
                <div class="card pull-up">
                  <div class="card-content collapse show bg-gradient-directional-danger ">
                    <div class="card-body bg-hexagons-danger">
                      <h4 class="card-title white">Rendimiento Academico 
                        <span class="white">Segundo Periodo</span>                        
                      </h4>
                      <div class="chartjs">
                        <canvas id="deals-doughnut" height="275"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!--Cantidad de alumnos-->
               <div class="row">
              <div class="col-lg-6 col-12">
                <div class="card pull-up">
                  <div class="card-content">
                    <div class="card-body">
                      <div class="media d-flex">
                        <div class="media-body text-left">
                          <h6 class="text-muted">Cantidad Alumos </h6>
                          <h3>700</h3>
                        </div>
                        <div class="align-self-center">
                          <i class="icon-graduation success font-large-2 float-right"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
             <!--Cantidad de maestros-->
              <div class="col-lg-6 col-12">
                <div class="card pull-up">
                  <div class="card-content">
                    <div class="card-body">
                      <div class="media d-flex">
                        <div class="media-body text-left">
                          <h6 class="text-muted">Cantidad Maestros</h6>
                          <h3>10</h3>
                        </div>
                        <div class="align-self-center">
                          <i class="icon-users danger font-large-2 float-right"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <!--Cantidad de grados-->            
                <div class="col-lg-6 col-12">
                  <div class="card pull-up">
                    <div class="card-content">
                      <div class="card-body">
                        <div class="media d-flex">
                          <div class="media-body text-left">
                            <h6 class="text-muted">Cantidad Grados </h6>
                            <h3>11</h3>
                          </div>
                          <div class="align-self-center">
                            <i class="icon-star success font-large-2 float-right"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>            
          </div>
        </div>
@endsection

{{-- 
@section('script')
    <script>
      var datos = {
        type: "pie",
        data: {
          datasets: [{
            data:[
              5,
              20
            ],
            backgroundColor:[
              "#F7464A",
              "#949FB1"
            ],
          }],
        },
      options:{
        responsive: true,
      }
      };
      var canvas = document.getElementById('promedio-Puno').getContext('2d');
      window.pie = new Chart(canvas, datos);
      
    </script>
@endsection --}}