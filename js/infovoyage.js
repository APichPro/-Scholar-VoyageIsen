'use strict';

const urlParams = new URLSearchParams(window.location.search);
const myParam = urlParams.get('id');
ajaxRequest ('GET', 'php/request.php/voyage/'+myParam, displayVoyage);


function displayVoyage(ajaxResponse){
    var data = JSON.parse(ajaxResponse);
    var content = '';

        var voyage = data[0];

        content += '<div class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image: url(img/bg-img/16.jpg);">';
        content += '<div class="container h-100">';
        content += '<div class="row h-100 align-items-end">';
        content += '<div class="col-12">';
        content += '<div class="breadcrumb-content d-flex align-items-center justify-content-between pb-5">';
        content += '<h2 class="room-title">'+voyage.Libelle+'</h2>';
        content += '<h2 class="room-price">'+voyage.cout+'€</h2>';
        content += '</div>';
        content += '</div>';
        content += '</div>';
        content += '</div>';
        content += '</div>';
        content += ' <div class="roberto-rooms-area section-padding-100-0">';
        content += '<div class="container">';
        content += '<div class="row">';
        content += '<div class="col-12 col-lg-8">';
        content += '<div class="single-room-details-area mb-50">';
        content += ' </div>';
        content += '<div class="room-thumbnail-slides mb-50">';
        content += '<div id="room-thumbnail--slide" class="carousel slide" data-ride="carousel">';
        content += '<div class="carousel-inner">';
        content += '<div class="carousel-item active">';
        content += ' <img src="img/bg-img/'+voyage.id_voyage+'.jpg" class="d-block w-100" alt="">';
        content += ' </div>';
        content += '</div>';
        content += ' </div>';
        content += ' </div>';
        content += '<div class="room-features-area d-flex flex-wrap mb-50">';
        content += '<h6>Durée: <span>'+voyage.duree+'</span></h6>';
        content += '<h6>Pays: <span>'+voyage.code_mc_pays+'</span></h6>';
        content +=  '</div>';
        content += '<p>'+voyage.description+'</p>';

    document.getElementById('voyage').innerHTML = content; 
}