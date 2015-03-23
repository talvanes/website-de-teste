<!DOCTYPE html>
<html lang="pt-br" manifest="teste.manifest">
  <head>
    <title>Página de Teste</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/classes.css" />
    <link rel="stylesheet" href="css/font.css" />
    <link rel="stylesheet" href="css/medias.css" />
    <script src="js/script.js"></script>
    <!--[if lt IE 9]>
      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <body class="main-back-color main-fore-color" onload="acompanharDataDeHoje(); carregarDadosDeUsuario();">
    <section id="container">
      <header class="n1-back-color n1-fore-color">
        <h1 class="shadow-text">Website de Teste</h1>
      </header>
      <nav class="n2-back-color" id="menu">
        <ul class="link-class-style">
            <li><a href="index.php">Início</a></li>
            <li><a href="about.html">Sobre</a></li>
            <li><a href="contact.html">Contato</a></li>
        </ul>
        <div class="menu-button">
          <a class="menu-button-style" href="#">&#9776; Menu</a>
          <ul class="link-class-style">
              <li><a class="n2-back-color" href="index.php">Início</a></li>
              <li><a class="n2-back-color" href="about.html">Sobre</a></li>
              <li><a class="n2-back-color" href="contact.html">Contato</a></li>
          </ul>
        </div>
      </nav>
      
      <section id="user-form" class="n2-back-color">
        <form method="post">
          <p>
            <label for="username">Qual é o seu nome?</label>
            <input class="input input-border" id="username" name="username" type="text" required/>
          </p>
          <p><button class="button button-border standard-color" type="submit" onclick="criarCaixaUsuario();">Enviar</button></p>
        </form>
      </section>
      <section id="welcome-user" class="n2-back-color">
        <p></p>
      </section>
      
      <section id="content">
        <?php include('getFeeds.php'); ?>
        <?php
          # sortear entre algumas fontes de notícias
          $fontes = array(
              'http://rss.home.uol.com.br/index.xml',
              'http://rss.uol.com.br/feed/noticias.xml',
              'http://rss.esporte.uol.com.br/ultimas/index.xml',
              'http://rss.noticias.uol.com.br/economia/ultnot/index.xml',
              'http://rss.tecnologia.uol.com.br/ultnot/index.xml',
              'http://www.vivaolinux.com.br/index.rdf',
              'http://g1.globo.com/dynamo/rss2.xml',
              'http://g1.globo.com/dynamo/vc-no-g1/rss2.xml',
              'http://g1.globo.com/dynamo/brasil/rss2.xml',
              'http://g1.globo.com/dynamo/mundo/rss2.xml',
              'http://br-linux.org/feed/atom',
              'http://www.dicas-l.com.br/index.rdf',
              'http://feeds.feedburner.com/ubuntued',
              'http://www.infowester.com/newsiw.xml',
              'https://br.noticias.yahoo.com/brasil/?format=rss',
              'https://br.noticias.yahoo.com/mundo/?format=rss',
              'https://br.noticias.yahoo.com/tecnologia/?format=rss',
              'https://br.noticias.yahoo.com/entretenimento/?format=rss',
              'http://feeds.feedburner.com/Plantao-INFO',
              'http://jovempanfm.uol.com.br/panico/rss',
              'http://jovempanfm.uol.com.br/musica/rss',
              'http://olhardigital.uol.com.br/rss/ultimas_noticias.php',
              'http://olhardigital.uol.com.br/rss/pro_ultimas_noticias.php',
              'http://www.vagalume.com.br/news/index.xml',
              'http://feeds.folha.uol.com.br/tec/rss091.xml'
          );
          $indice = mt_rand(0, count($fontes)-1);
          $itens = get_feeds($fontes[$indice]);
        ?>
        <h2>
          Últimas notícias a partir do site <strong class="n3-back-color round-border">
            <a class="n3-fore-color no-underline" href="<?php echo $itens->link; ?>" target="_blank"><?php echo $itens->title ?></a></strong>
        </h2>
        <!-- article class="entry entry-border" -->
        <?php foreach ($itens->item as $item):; ?>
          <article class="entry entry-border">
            <h3><?php echo $item->title ?></h3>
            <p>
              <?php echo $item->description; ?>
              <a href="<?php echo $item->link; ?>" target="_blank">Leia mais...</a>
            </p>
            <br />
            <h5 class="n1-back-color n1-fore-color">Publicado em: <?php echo $item->pubDate; ?></h5>
          </article>
        <?php endforeach; ?>
        
      </section>
      <footer class="n2-back-color">
        <p class="n1-back-color n1-fore-color round-border">Copyright <sup>&copy;</sup> 2015. <strong style="font-style:italic">Fict&iacute;cia SA</strong>. Todos os direitos reservados.</p>
      </footer>
      </section>
  </body>
</html>
