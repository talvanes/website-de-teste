<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Página de Teste</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/classes.css" />
    <link rel="stylesheet" href="css/font.css" />
    <link rel="stylesheet" href="css/medias.css" />
    <script src="http://dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=7.0#sthash.8J0r5Ylh.dpuf"></script>
    <script src="js/tinycolor.js" type="text/javascript"></script>
    <script src="js/colors.js"></script>
    <script src="js/script.js"></script>
    <script src="js/validacao.js"></script>

    <!--[if lt IE 9]>
      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <body class="main-back-color main-fore-color" onload="acompanharDataDeHoje(); carregarDadosDeUsuario(); colorizeComments();">
    <section id="container">
      <header class="n1-back-color n1-fore-color">
        <h1 class="shadow-text">Website de Teste</h1>
      </header>
      <nav class="n2-back-color" id="menu">
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
          <p><button class="button button-border standard-color" type="button" onclick="criarCaixaUsuario();">Enviar</button></p>
        </form>
      </section>
      <section id="welcome-user" class="n2-back-color">
      	<p></p>
      </section>

      <section id="content">
        <h2>Participe. Sua opinião é muito importante.</h2>
        <p class="n2-back-color">O que você achou do site?</p>
        <form name="form1" action="process.php" method="post" autocomplete="off" onsubmit="return validarFormulario();">
            <p>
              <label for="nome" class="required">Nome Completo:</label>
              <input type="text" id="nome" class="input input-border" name="nome"  title="Nome e sobrenome" placeholder="Nome completo..." required />
            </p>
            <p>
              <label for="contato" class="required">E-Mail para Contato:</label>
              <input type="email" id="contato" class="input input-border" name="contato" placeholder="E-mail para contato..." required />
            </p>
            <p>
              <label for="nasc" class="required">Nascimento:</label>
              <input type="date" id="nasc" class="input input-border" name="nasc"  title="Formato exigido: DD-MM-AAAA" placeholder="DD/MM/AAAA" pattern="^\d{2}\/\d{2}\/\d{4}" required />
            </p>
            <p>
              <label for="tel">Telefone (<abbr title="Brasil">BR</abbr>):</label>
              <input type="tel" id="tel" class="input input-border" name="tel"
                     title="Insira um número de telefone com, no mínimo, 8 dígitos (ou 9 dígitos, dependendo da região), juntamente com o DDD, por exemplo em (11) 2134-6655 ou (11) 99878-3211"
                     placeholder="(XX) XXXX-XXXX | (XX) 9XXXX-XXXX" pattern="^\(\d{2}\) \d{4,5}-\d{4}$" />
            </p>
            <p>
              <label for="cor">Cor favorita:</label>
              <input type="color" id="cor" class="input input-no-border" name="cor" title="Código de cor Hexadecimal. Exemplos: #06AF3D ou #d4a" placeholder="#XXXXXX | #XXX" pattern="^([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" />
            </p>
            <p>
              <label for="comentario">Seu comentário aqui:</label>
              <textarea id="comentario" class="input input-border" name="comentario" rows="10" cols="60"></textarea>
            </p>
            <div style="clear: both"></div>
            <p>
              <button type="submit" class="button button-border standard-color">Enviar</button>
              <button type="reset" class="button button-border standard-color">Limpar</button>
            </p>
          </form>
      </section>

      <section id="comments">
          <!-- Área de comentários -->
          <?php
            try {
              # 1) Criar uma conexão para o banco de dados 'website-teste'
              // alguns parâmetros do PostgreSql
              $host = 'localhost';
              $user = 'postgres';
              $password = 'N4gy-N1yaz0v';
              $dbname = 'website-teste';
              // criando a conexão usando PDO
              $conexao = new PDO("pgsql:host=$host;port=5432;dbname=$dbname", $user, $password);
              $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

              # 2) Listar os comentários (será retornado como vetor associativo)
              $comando = $conexao->query("SELECT datahora, nome, email, cor, comentario FROM comentarios LEFT OUTER JOIN pessoas ON pessoas.id = comentarios.pessoaid ORDER BY datahora DESC;");
              $resultado = $comando->execute();
              // verificar o resultado da execução
              if($resultado){
                # 3) em caso afirmativo, retornar TODOS os resultados
                $comentarios = $comando->fetchAll(PDO::FETCH_ASSOC);
                // percorrer o 'vetor' obtido
                foreach ($comentarios as $i => $com) {
                  #cada comentário terá seu próprio id atribuído por meio do campo datahora
                  $Id = $com['datahora'];
                  echo "<article id='$Id' class='comment round-border' style='background-color: {$com['cor']}'>\n";

                  # cabeçalho com a datahora do comentário e o autor
                  echo "<p>Em <em>{$com['datahora']}</em>, <strong><a class='no-underline round-border' href='mailto:{$com['email']}'>{$com['nome']}</a></strong> escreveu:</p>\n";
                  # descrição do comentário
                  echo "<blockquote>{$com['comentario']}</blockquote>\n";

                  #fim de comentário
                  echo "</article>\n";
                }
              }
            } catch (PDOException $ex) {
              # conexão com base de dados não encontrada
              echo "Não deu para conectar ao banco de dados $dbname.";
            } catch (Exception $ex) {
              #erro desconhecido
              echo "Erro na aplicação, devido a: {$ex->getMessage()}.";
            }
            $conexao = null;
            ?>
      </section>

      <!-- Mapa do Bing -->
      <section id="mapaBing">
        <script src="js/mapaDoBing.js">
        </script>
      </section>

      <footer class="n2-back-color">
        <p class="n1-back-color n1-fore-color round-border">Copyright <sup>&copy;</sup> 2015. <strong style="font-style:italic">Fict&iacute;cia SA</strong>. Todos os direitos reservados.</p>
      </footer>
      </section>
  </body>
</html>
