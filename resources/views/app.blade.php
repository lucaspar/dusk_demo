@extends('layouts.app')

@section('content')
<div class="container full-width">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2">

            <div class="loader text-center">
                <svg class="sunshine" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512">
                    <path class="sun-full" d="M256,144c-61.8,0-112,50.2-112,112s50.2,112,112,112s112-50.2,112-112S317.8,144,256,144z M256,336
                       c-44.2,0-80-35.8-80-80s35.8-80,80-80s80,35.8,80,80S300.2,336,256,336z" />
                    <path class="sun-ray-eight" d="M131.6,357.8l-22.6,22.6c-6.2,6.2-6.2,16.4,0,22.6s16.4,6.2,22.6,0l22.6-22.6c6.2-6.3,6.2-16.4,0-22.6
                       C147.9,351.6,137.8,351.6,131.6,357.8z" />
                    <path class="sun-ray-seven" d="M256,400c-8.8,0-16,7.2-16,16v32c0,8.8,7.2,16,16,16s16-7.2,16-16v-32C272,407.2,264.8,400,256,400z" />
                    <path class="sun-ray-six" d="M380.5,357.8c-6.3-6.2-16.4-6.2-22.6,0c-6.3,6.2-6.3,16.4,0,22.6l22.6,22.6c6.2,6.2,16.4,6.2,22.6,0
                       s6.2-16.4,0-22.6L380.5,357.8z" />
                    <path class="sun-ray-five" d="M448,240h-32c-8.8,0-16,7.2-16,16s7.2,16,16,16h32c8.8,0,16-7.2,16-16S456.8,240,448,240z" />
                    <path class="sun-ray-four" d="M380.4,154.2l22.6-22.6c6.2-6.2,6.2-16.4,0-22.6s-16.4-6.2-22.6,0l-22.6,22.6c-6.2,6.2-6.2,16.4,0,22.6
                       C364.1,160.4,374.2,160.4,380.4,154.2z" />
                    <path class="sun-ray-three" d="M256,112c8.8,0,16-7.2,16-16V64c0-8.8-7.2-16-16-16s-16,7.2-16,16v32C240,104.8,247.2,112,256,112z" />
                    <path class="sun-ray-two" d="M131.5,154.2c6.3,6.2,16.4,6.2,22.6,0c6.3-6.2,6.3-16.4,0-22.6l-22.6-22.6c-6.2-6.2-16.4-6.2-22.6,0
                       c-6.2,6.2-6.2,16.4,0,22.6L131.5,154.2z" />
                    <path class="sun-ray-one" d="M112,256c0-8.8-7.2-16-16-16H64c-8.8,0-16,7.2-16,16s7.2,16,16,16h32C104.8,272,112,264.8,112,256z" />
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
            center: brasil,
            styles: [{"elementType":"geometry","stylers":[{"color":"#1d2c4d"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#8ec3b9"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#1a3646"}]},{"featureType":"administrative.country","elementType":"geometry.stroke","stylers":[{"color":"#4b6878"}]},{"featureType":"administrative.land_parcel","stylers":[{"visibility":"off"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text.fill","stylers":[{"color":"#64779e"}]},{"featureType":"administrative.locality","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative.locality","elementType":"labels.text","stylers":[{"saturation":-60},{"lightness":-35}]},{"featureType":"administrative.neighborhood","stylers":[{"visibility":"off"}]},{"featureType":"administrative.province","elementType":"geometry.stroke","stylers":[{"color":"#4b6878"}]},{"featureType":"landscape.man_made","stylers":[{"lightness":-30}]},{"featureType":"landscape.man_made","elementType":"geometry.stroke","stylers":[{"color":"#334e87"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"color":"#023e58"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#283d6a"}]},{"featureType":"poi","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#6f9ba5"}]},{"featureType":"poi","elementType":"labels.text.stroke","stylers":[{"color":"#1d2c4d"}]},{"featureType":"poi.business","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#023e58"}]},{"featureType":"poi.park","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"labels.text.fill","stylers":[{"color":"#3C7680"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#304a7d"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#98a5be"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#1d2c4d"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#2c6675"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#255763"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"color":"#b0d5ce"}]},{"featureType":"road.highway","elementType":"labels.text.stroke","stylers":[{"color":"#023e58"}]},{"featureType":"transit","elementType":"labels.text.fill","stylers":[{"color":"#98a5be"}]},{"featureType":"transit","elementType":"labels.text.stroke","stylers":[{"color":"#1d2c4d"}]},{"featureType":"transit.line","elementType":"geometry.fill","stylers":[{"color":"#283d6a"}]},{"featureType":"transit.station","elementType":"geometry","stylers":[{"color":"#3a4762"}]},{"featureType":"water","stylers":[{"saturation":-5},{"lightness":-45},{"weight":2}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#111b31"},{"saturation":-45},{"weight":2}]},{"featureType":"water","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#4e6d70"}]}],
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
                center: location,
                styles: [{"elementType":"geometry","stylers":[{"color":"#1d2c4d"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#8ec3b9"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#1a3646"}]},{"featureType":"administrative.country","elementType":"geometry.stroke","stylers":[{"color":"#4b6878"}]},{"featureType":"administrative.land_parcel","stylers":[{"visibility":"off"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text.fill","stylers":[{"color":"#64779e"}]},{"featureType":"administrative.locality","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative.locality","elementType":"labels.text","stylers":[{"saturation":-60},{"lightness":-35}]},{"featureType":"administrative.neighborhood","stylers":[{"visibility":"off"}]},{"featureType":"administrative.province","elementType":"geometry.stroke","stylers":[{"color":"#4b6878"}]},{"featureType":"landscape.man_made","stylers":[{"lightness":-30}]},{"featureType":"landscape.man_made","elementType":"geometry.stroke","stylers":[{"color":"#334e87"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"color":"#023e58"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#283d6a"}]},{"featureType":"poi","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#6f9ba5"}]},{"featureType":"poi","elementType":"labels.text.stroke","stylers":[{"color":"#1d2c4d"}]},{"featureType":"poi.business","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#023e58"}]},{"featureType":"poi.park","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"labels.text.fill","stylers":[{"color":"#3C7680"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#304a7d"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#98a5be"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#1d2c4d"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#2c6675"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#255763"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"color":"#b0d5ce"}]},{"featureType":"road.highway","elementType":"labels.text.stroke","stylers":[{"color":"#023e58"}]},{"featureType":"transit","elementType":"labels.text.fill","stylers":[{"color":"#98a5be"}]},{"featureType":"transit","elementType":"labels.text.stroke","stylers":[{"color":"#1d2c4d"}]},{"featureType":"transit.line","elementType":"geometry.fill","stylers":[{"color":"#283d6a"}]},{"featureType":"transit.station","elementType":"geometry","stylers":[{"color":"#3a4762"}]},{"featureType":"water","stylers":[{"saturation":-5},{"lightness":-45},{"weight":2}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#111b31"},{"saturation":-45},{"weight":2}]},{"featureType":"water","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#4e6d70"}]}],
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
