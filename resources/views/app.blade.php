@extends('layouts.app')

@section('content')
<div class="container full-width">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2">

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

            <div class="weather row" style="opacity:0;">
                <div class="weather-title col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <span class="cidade"></span> <span class="temperatura"></span><br>
                    <span class="descricao"></span><br>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <a href="#" class="right obter-localizacao">Obter localização</a>
                    <img class="imagem-do-tempo"><br>
                </div>
                <div class="weather-details">
                    <div style="display:block">
                        <p>
                            <object class="weather-icon" data="/images/weather/sunrise.svg" type="image/svg+xml"></object>
                            Nascer do Sol: <span class="nascer_do_sol"></span>
                        </p>
                    </div>
                    <div style="display:block">
                        <p>
                            <object class="weather-icon" data="/images/weather/sunset.svg" type="image/svg+xml"></object>
                            Pôr do Sol: <span class="por_do_sol"></span><br>
                        </p>
                    </div>
                    <div style="display:block">
                        <p>
                            <object class="weather-icon" data="/images/weather/wind.svg" type="image/svg+xml"></object>
                            Velocidade do vento: <span class="vento"></span><br>
                        </p>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="">
            <div id="map"></div>
        </div>
    </div>
</div>

<script type="text/javascript">

    function initMap() {
        var brasil = {lat: -15, lng: -50};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            center: brasil
        });
    }

    $(document).ready(function(){

        if (typeof google === 'object' && typeof google.maps === 'object') {
            initMap();
        }

        // Inicia com a previsao por Geo IP, sem passar as coordenadas
        atualizarDados();
        // Quando o usuario clicar no botao, obtem os dados de geolocalizacao do navegador.
        $('.obter-localizacao').on('click', function(e){
            e.preventDefault();
            $('.weather').animate({'opacity': 0}, 500);
            $('.loader').animate({'opacity': 1}, 500);
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

        if (localizacao) {
            let location = {lat: localizacao.coords.latitude, lng: localizacao.coords.longitude};
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 14,
                center: location
            });
            var marker = new google.maps.Marker({
                position: location,
                map: map
            });
        }

        $.ajax({
            url: '/api/weather'+(!localizacao ? '' : '?lat='+localizacao.coords.latitude+'&lon='+localizacao.coords.longitude),
            dataType: 'json',
            success: function(dados) {
                $('.loader').animate({'opacity': 0}, 500);
                $('.weather').animate({'opacity': 1}, 500);
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
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAJ8z9NSDQulI4QPVDCnVQB4ui-RrcR8sQ&callback=initMap"></script>

@endsection
