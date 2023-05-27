<?php
  include './app/model/Papel.class.php';
  $papeis = Papel::getAll();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Cache-control" content="no-cache" />
    <link rel="stylesheet" href="./styles/index.css" />
    <link rel="stylesheet" href="./styles/usuario.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <script
      defer
      src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
      integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc"
      crossorigin="anonymous"
    ></script>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
      crossorigin="anonymous"
    ></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <title>CRUD Usuário</title>
  <body>
    <main>
      <section class="main-section justify-content-center min-width-400">
        <h1 class="usuario-title">Usuário</h1>
        <form
          method="post"
          action="./app/controller/UsuarioController.php?action=save"
        >
          <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" required />
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required />
          </div>

          <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" required />
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
      </section>
    </main>
  </body>
</html>
