/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 * criação e estilos básicos do controle (mapaDoBing) 
 */
var mapaBing = document.getElementById("mapaBing");
mapaBing.style.height = "400px";
mapaBing.style.position = "relative";
mapaBing.style.margin = "45px 10px 0 10px";
/*
 *  inicializando o mapa do Bing
 */
// credencial para a aplicação
var credencial = 'AuVAiekuWk2FynZoUXqAZYhO_yTkEruV8GrcvGzC6Phea4KmBXLgEAPL8JTYmW27';
var mapa = new Microsoft.Maps.Map(mapaBing, {credentials: credencial});
if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(exitoDeLocalizacao, erroDeLocalizacao);
} else {
  mapaBing.style.className = "erro";
  mapaBing.innerHTML = "O seu navegador não suporta Geo-localização.";
}

/*
 * Todas as rotinas
 */
// Local obtido com sucesso
function exitoDeLocalizacao(local) {
  var localUsuario = new Microsoft.Maps.Location(local.coords.latitude, local.coords.longitude);
  mapa.setView({center: localUsuario, zoom: 17});
  var destaqueDoLocal = new Microsoft.Maps.Pushpin(localUsuario, {draggable: false});
  mapa.entities.push(destaqueDoLocal);

  var caixaInfoLocal = new Microsoft.Maps.Infobox(new Microsoft.Maps.Location(0, 0), {title: 'Você está aqui!', visible: true});
  Microsoft.Maps.Events.addHandler(destaqueDoLocal, 'click', exibirCaixaInfo);
  Microsoft.Maps.Events.addHandler(mapa, 'viewchange', esconderCaixaInfo);
  mapa.entities.push(caixaInfoLocal);
}
// Houve erro...
function erroDeLocalizacao(erro) {
  mapaBing.style.className = "erro";
  switch (erro.code) {
    case erro.PERMISSION_DENIED:
      mapaBing.innerHTML = "Permissão negada para o uso do recurso de geo-localização.";
      break;
    case erro.POSITION_UNAVAILABLE:
      mapaBing.innerHTML = "O local não pode ser obtido.";
      break;
    case erro.TIMEOUT:
      mapaBing.innerHTML = "Houve demora em processar a sua solicitação.";
      break;
    case erro.UNKNOWN_ERROR:
      mapaBing.innerHTML = "Erro desconhecido";
      break;
  }

  function exibirCaixaInfo(evento) {

  }
  function esconderCaixaInfo(evento) {

  }
}

