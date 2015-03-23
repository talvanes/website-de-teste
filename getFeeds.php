<?php
/* 
 * Função para importar feeds de um site.
 * Baseado no algoritmo de Rafael Wender Pinheiro,
 * disponível em http://www.rafaelwendel.com/2011/11/funcao-php-para-importar-feeds-de-qualquer-site/
 * @author Rafael Wender Pinheiro
 * @param String $url A URL completa da página de feeds
 * @return Array $itens Um array com informações do site de onde os feeds foram extraídos
 */
function get_feeds($url){
  $content = simplexml_load_file($url);
  if(!isset($content->channel)){
    die('Conteúdo rss não válido');
  }
  $itens = $content->channel;
  return $itens;
}
