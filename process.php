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
          <p><button class="button button-border standard-color" type="button" onclick="criarCaixaUsuario();">Enviar</button></p>
        </form>
      </section>
      <section id="welcome-user" class="n2-back-color">
      	<p></p>
      </section>
      
      <section id="content">
        <!-- Exibir os dados já enviados na página process.php -->
        <h2>Esses foram os seus dados:</h2>
        <table class="round-border">
          <tr class="n3-back-color n3-fore-color">
            <th>Campo:</th>
            <th>Valor:</th>
          </tr>
          <!-- Mostrar os valores submetidos por formulário (contact.php) -->
          <?php foreach ($_POST as $campo => $valor): ?>
          <tr class="n2-back-color n2-fore-color">
            <td style="font-weight: 600; font-style: italic;"><?php echo $campo; ?></td>
            <td><?php echo $valor; ?></td>
          </tr>
          <?php endforeach; ?>
        </table>
        <p style="margin-bottom: 10px;">Muito obrigado pela participação.</p>
        <section style="padding: 12px;" class="n2-back-color n2-fore-color">
        <?php
          /*
           * Código para armazenamento dos dados no banco de dados "website-teste"
           */
           
          # 1º Passo: capturar os valores enviados
          $datahora = date(DATE_W3C);
          $nome = filter_input(INPUT_POST, 'nome');
          $email = filter_input(INPUT_POST, 'contato');
          $datanasc = filter_input(INPUT_POST, 'nasc');
          $telefone = filter_input(INPUT_POST, 'tel');
          $cor = filter_input(INPUT_POST, 'cor');
          $comentario = filter_input(INPUT_POST, 'comentario');
          
          # 2º Passo: armazenar os valores no banco de dados
          // alguns parâmetros do PostgreSql
          $host = 'localhost';
          $user = 'postgres';
          $password = 'N4gy-N1yaz0v';
          $dbname = 'website-teste';
          
          // criando a conexão usando PDO
          $conexao = new PDO("pgsql:host=$host;port=5432;dbname=$dbname", $user, $password);
          $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          if (!$conexao){
            echo "<p>";
            print_r($conexao->errorInfo());
            echo "</p>";
          }
          try {
            # 3º Passo: verificar se um ID pode ser localizado 
            #     segundo a pesquisa ("query") abaixo
            // -- pessoaid (fazer subquery) PDO::PARAM_INT
            $pessoaid = $conexao->prepare("SELECT id FROM pessoas WHERE nome = :nome AND email = :email");
            $pessoaid->bindParam(':nome', $nome, PDO::PARAM_STR);
            $pessoaid->bindParam(':email', $email, PDO::PARAM_STR);
            if($pessoaid->execute()){
              # a execução do comando acima poderá retornar um ID
              $pessoa = $pessoaid->fetch(PDO::FETCH_ASSOC); # transformado em vetor associativo
              if(empty($pessoa)){
                # se a pessoa não for localizada, crie um novo ID
                // Comando para criar uma Pessoa(ID) na tabela Pessoas
                $comando_pessoas = $conexao->prepare("INSERT INTO pessoas(nome, datanasc, email, telefone) VALUES (:nome, :datanasc, :email, :telefone)");
                $comando_pessoas->bindParam(":nome", $nome, PDO::PARAM_STR);
                $comando_pessoas->bindParam(":datanasc", $datanasc, PDO::PARAM_STR);
                $comando_pessoas->bindParam(":email", $email, PDO::PARAM_STR);
                $comando_pessoas->bindParam(":telefone", $telefone, PDO::PARAM_STR);
                $resultado_pessoas = $comando_pessoas->execute();
                if($resultado_pessoas){
                  # Depois que uma nova Pessoa foi criada,
                  #   obter o novo ID executando novamente o primeiro comando, 
                  #   que é o mesmo acima
                  if($pessoaid->execute()){
                    $pessoa = $pessoaid->fetch(PDO::FETCH_ASSOC);
                    echo "<p>Pessoa <strong>$nome</strong>, email <strong>$email</strong>, criada com sucesso!</p>\n";
                  }
                } else {
                  # erro ao inserir o ID
                  echo "<p>Pessoa <strong>$nome</strong>, email <strong>$email</strong>, já existe!</p>\n";
                }
                # Pronto. A pessoa foi criada!
              }
              $id = $pessoa['id'];  # um valor obtido a partir do vetor
            }
            
            // Comando para "criar" um comentário na tabela Comentários
            $comando_comentarios = $conexao->prepare("INSERT INTO comentarios(datahora, pessoaid, cor, comentario) VALUES (:datahora, :pessoaid, :cor, :comentario)");
            $comando_comentarios->bindParam(":datahora", $datahora, PDO::PARAM_INT);
            # o id foi obtido anteriormente
            $comando_comentarios->bindParam(":pessoaid", $id, PDO::PARAM_INT);
            $comando_comentarios->bindParam(":cor", $cor, PDO::PARAM_STR);
            $comando_comentarios->bindParam(":comentario", $comentario, PDO::PARAM_STR);
            $resultado_comentarios = $comando_comentarios->execute();
            if($resultado_comentarios){
              echo "<p>Comentário inserido com sucesso.</p>";
            } else {
              echo "<p>Erro ao inserir comentário.</p>";
            }
          } catch (PDOException $ex) {
            echo "<p>Erro ao criar a conexão: ".$ex->getMessage()."</p>\n";
          }
          // fechando a programação
          $conexao = null;
        ?>
      </section>
        <p style="margin-top: 20px;"><a href="javascript:history.go(-1);">Voltar...</a></p>
      </section>
      <footer class="n2-back-color">
        <p class="n1-back-color n1-fore-color round-border">Copyright <sup>&copy;</sup> 2015. <strong style="font-style:italic">Fict&iacute;cia SA</strong>. Todos os direitos reservados.</p>
      </footer>
      </section>
  </body>
</html>
