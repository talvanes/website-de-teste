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
      <nav  class="n2-back-color" id="menu">
        <ul class="link-class-style">
            <li><a href="index.php">Início</a></li>
            <li><a href="about.html">Sobre</a></li>
            <li><a href="contact.php">Contato</a></li>
        </ul>
        <div class="menu-button">
          <a class="menu-button-style" href="#">&#9776; Menu</a>
          <ul class="link-class-style">
              <li><a class="n2-back-color" href="index.php">Início</a></li>
              <li><a class="n2-back-color" href="about.html">Sobre</a></li>
              <li><a class="n2-back-color" href="contact.php">Contato</a></li>
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
        <!-- Exibir os dados já enviados na página process.php -->
        <h2>Esses são os seus dados:</h2>
        <table class="round-border">
          <tr class="n3-back-color n3-fore-color">
            <th>Campo:</th>
            <th>Valor:</th>
          </tr>
          <!--  -->
          <?php foreach ($_POST as $campo => $valor): ?>
          <tr class="n2-back-color n2-fore-color">
            <td><?php echo $campo; ?></td>
            <td><?php echo $valor; ?></td>
          </tr>
          <!--  -->
          <?php endforeach; ?>
        </table>
        <p><a href="javascript:history.go(-1);">Voltar...</a></p>
        <?php
          /*
           * Código para armazenamento dos dados no banco de dados "website-teste"
           */
        ?>
      </section>
      <footer class="n1-back-color">
        <p class="n1-back-color n1-fore-color round-border">Copyright <sup>&copy;</sup> 2015. <strong style="font-style:italic">Fict&iacute;cia SA</strong>. Todos os direitos reservados.</p>
      </footer>
      </section>
  </body>
</html>
