<?php
include "./../model/Usuario.class.php";
include './../model/Papel.class.php';

$papeis = Papel::getAll();
$usuario = new Usuario();
$usuario->setId($_GET['usuarioId']);
$usuario->load();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Cache-control" content="no-cache" />
    <link rel="stylesheet" href="./../../styles/index.css" />
    <link rel="stylesheet" href="./../../styles/usuario.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <script
      defer
      src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
      integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc"
      crossorigin="anonymous"
    ></script>

    <link
      href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <title>CRUD Usuário - Atualizar Usuário</title>
  </head>
  <body>
    <main>
      <section class="main-section min-width-400 justify-content-center">
        <h1 class="usuario-title">Usuário</h1>
        <form class="bg-dark"
          method="post"
          action="./../controller/UsuarioController.php?action=update"
        >

        <input type="hidden" name="usuarioId" value="<?= $usuario->getId() ?>" />

          <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" required placeholder="<?= $usuario->getNome()?>"/>
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required placeholder="<?= $usuario->getEmail()?>" />
          </div>

          <div class="form-group">
            <label for="papeis">Papéis</label>
            <select id="papeis" name="papeis[]" multiple required>
              <?php foreach ($papeis as $papel) { ?>
                <option value="<?=$papel->getId()?>">
                  <?=$papel->getPapel()?>
                </option>
              <?php } ?> <!-- fechar foreach -->

            </select>
          </div>


          <button type="submit">
            <span>Enviar</span>
            <i class="fa fa-paper-plane" aria-hidden="true"></i>
          </button>
        </form>

        <a style="margin-top: 75px;" class="link-usuario" href="../view/TabelaUsuario.php">Voltar</a>

      </section>
    </main>
  </body>
</html>
