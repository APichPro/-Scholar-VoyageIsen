'use strict';

ajaxRequest ('GET', 'php/request.php/voyage/', displayVoyages);

function displayVoyages(ajaxResponse){
    var data = JSON.parse(ajaxResponse);
    var content = '';

    for(var i = 0; i < data.length; ++i) {
        var voyage = data[i];

        content += '<div class="single-room-area d-flex align-items-center mb-100">';
        content += '<div class="room-thumbnail">';
        content += '<img src="img/bg-img/'+voyage.id_voyage+'.jpg" alt="">';
        content += ' </div>';
        content += '<div class="room-content">';
        content += '<h2>'+voyage.Libelle+'</h2>';
        content += '<h4>'+voyage.cout+'€</h4>';
        content += '<div class="room-feature">';
        content += '<h6>Pays: <span>'+voyage.code_mc_pays+'</span></h6>';
        content += '<h6></h6>';
        content += '<h6>Durée: <span>'+voyage.duree+'</span></h6>';
        content += '</div>';
        content += '<a href="infovoyage.html?id='+voyage.id_voyage+' " class="btn view-detail-btn">Voir plus <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>';
        content += '</div>';
        content += '</div>';
    }

    document.getElementById('voyages').innerHTML = content; 
}

function ajaxRequest(type, request, callback, data = null)
{
  var xhr;

  // Create XML HTTP request.
  xhr = new XMLHttpRequest();
  if (type == 'GET' && data != null)
    request += '?' + data;
  xhr.open(type, request, true);

  // Add the onload function.
  xhr.onload = function ()
  {
    switch (xhr.status)
    {
      case 200:
      case 201:
        console.log(xhr.responseText);
        callback(xhr.responseText);
        break;
      default:
        httpErrors(xhr.status);
    }
  };

  // Send XML HTTP request.
  xhr.send(data);
}