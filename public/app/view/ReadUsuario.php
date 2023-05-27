<?php
include_once './../model/Usuario.class.php';
include_once './../model/Papel.class.php';
include_once './../model/PapelUsuario.class.php';
$usuario = new Usuario();
$usuario->setId($_GET['usuarioId']);
$usuario->load();

$papeis = PapelUsuario::getPapeisUsuario($usuario->getId());
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Usuario - Read Usuário</title>
    <link rel="stylesheet" href="./../../styles/index.css">
    <link rel="stylesheet" href="./../../styles/usuario.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;400;500;600;700&display=swap"
        rel="stylesheet" />
</head>


<body>
    <main>

        <section class="main-section gap-5 min-width-400 justify-content-center">
            <h1 class="usuario-title">Usuário
                <?= $usuario->getId() ?>
            </h1>

            <ul class="w-100 list-group list-group-flush">
                <li class="list-group-item">Nome:
                    <?= $usuario->getNome() ?>
                </li>
                <li class="list-group-item">Email:
                <?= $usuario->getEmail() ?>
                </li>
                <li class="list-group-item">Senha:
                <?= $usuario->getSenha() ?>
                </li>
            </ul>


            <ul class="w-100 list-group list-group-flush">
                <li class="list-group-item">
                    <strong>Papéis:</strong>
                </li>

                <?php foreach ($papeis as $papel) { ?>
                    <li class="list-group-item">
                        <?= $papel->getPapel() ?>
                    </li>
                <?php } ?> <!-- fechar foreach -->

            </ul>


            <a class="btn btn-danger w-50" href="../view/TabelaUsuario.php">Voltar</a>
        </section>

    </main>

</body>

</html>