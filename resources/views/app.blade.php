@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Previsão do tempo</div>
                <div class="panel-body">

                    <div class="loader text-center">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             width="24px" height="30px" viewBox="0 0 24 30" style="enable-background:new 0 0 50 50;" xml:space="preserve">
                                                                <rect x="0" y="10" width="4" height="10" fill="#333" opacity="0.2">
                                                                    <animate attributeName="opacity" calcMode="spline" keySplines="0.8 0 0.2 1; 0.8 0 0.2 1" attributeType="XML" values="0.2; 1; .2" begin="0s" dur="0.8s" repeatCount="indefinite" ></animate>
                                                                    <animate attributeName="height" calcMode="spline" keySplines="0.8 0 0.2 1; 0.8 0 0.2 1" attributeType="XML" values="10; 20; 10" begin="0s" dur="0.8s" repeatCount="indefinite" ></animate>
                                                                    <animate attributeName="y" calcMode="spline" keySplines="0.8 0 0.2 1; 0.8 0 0.2 1" attributeType="XML" values="10; 5; 10" begin="0s" dur="0.8s" repeatCount="indefinite" ></animate>
                                                                </rect>
                            <rect x="8" y="10" width="4" height="10" fill="#333" opacity="0.2">
                                <animate attributeName="opacity" calcMode="spline" keySplines="0.8 0 0.2 1; 0.8 0 0.2 1" attributeType="XML" values="0.2; 1; .2" begin="0.15s" dur="0.8s" repeatCount="indefinite" ></animate>
                                <animate attributeName="height" calcMode="spline" keySplines="0.8 0 0.2 1; 0.8 0 0.2 1" attributeType="XML" values="10; 20; 10" begin="0.15s" dur="0.8s" repeatCount="indefinite" ></animate>
                                <animate attributeName="y" calcMode="spline" keySplines="0.8 0 0.2 1; 0.8 0 0.2 1" attributeType="XML" values="10; 5; 10" begin="0.15s" dur="0.8s" repeatCount="indefinite" ></animate>
                            </rect>
                            <rect x="16" y="10" width="4" height="10" fill="#333" opacity="0.2">
                                <animate attributeName="opacity" calcMode="spline" keySplines="0.8 0 0.2 1; 0.8 0 0.2 1" attributeType="XML" values="0.2; 1; .2" begin="0.3s" dur="0.8s" repeatCount="indefinite" ></animate>
                                <animate attributeName="height" calcMode="spline" keySplines="0.8 0 0.2 1; 0.8 0 0.2 1" attributeType="XML" values="10; 20; 10" begin="0.3s" dur="0.8s" repeatCount="indefinite" ></animate>
                                <animate attributeName="y" calcMode="spline" keySplines="0.8 0 0.2 1; 0.8 0 0.2 1" attributeType="XML" values="10; 5; 10" begin="0.3s" dur="0.8s" repeatCount="indefinite" ></animate>
                            </rect>
                                                              </svg>
                    </div>

                    <div class="weather" style="display:none;">
                        <div class="weather-title">
                            <span class="cidade"></span><span class="temperatura"></span><br>
                            <span class="descricao"></span><br>
                        </div>
                        <div class="weather-details">
                            Nascer do Sol: <span class="nascer_do_sol"></span> - Pôr do Sol: <span class="por_do_sol"></span><br>
                            Velocidade do vento: <span class="vento"></span><br>
                        </div>
                        <img class="imagem-do-tempo"><br>
                        <a href="#" class="obter-localizacao">Obter localização</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function(){
        // Inicia com a previsao por Geo IP, sem passar as coordenadas
        atualizarDados();
        // Quando o usuario clicar no botao, obtem os dados de geolocalizacao do navegador.
        $('.obter-localizacao').on('click', function(e){
            e.preventDefault();
            $('.weather').hide();
            $('.loader').show();
            // Verifica se o navegador do usuario tem suporte a geolocalizacao
            if(navigator.geolocation){
                // Se tiver, solicita os dados e atualiza a previsao do tempo pela API
                navigator.geolocation.getCurrentPosition(atualizarDados);
            }
            else {
                alert('Seu navegador não suporta geolocalização.');
            }
        });
    });

    function atualizarDados(localizacao) {
        localizacao = typeof localizacao !== 'undefined' ? localizacao : false;
        $.ajax({
            url: '/api/weather'+(!localizacao ? '' : '?lat='+localizacao.coords.latitude+'&lon='+localizacao.coords.longitude),
            dataType: 'json',
            success: function(dados) {
                $('.loader').hide();
                $('.weather').show();
                // Insere os dados no HTML
                $.each(dados, function(dado, valor){
                    $('.'+dado).text(valor);
                });
                // Insere a imagem
                $('.imagem-do-tempo').attr('src', dados.imagem);
            }
        });
    }

</script>

@endsection
