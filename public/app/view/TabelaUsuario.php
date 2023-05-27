<?php
include_once './../model/Usuario.class.php';
include_once './../model/Papel.class.php';

$papeis = Papel::getAll();

$usuarios = null;
if(!isset($_GET['papelId'])) {
    $usuarios = Usuario::getAll();
} else {
    $usuarios = Usuario::getAllByPapel($_GET['papelId']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Usuario - Tabela de Usuários</title>
    <link rel="stylesheet" href="./../../styles/index.css">
    <link rel="stylesheet" href="./../../styles/usuario.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>


<body>
    <main>

        <section class="main-section gap-3 min-width-700">
            <h1 class="usuario-title">Usuários</h1>


            <?php if (empty($usuarios)) { ?>
                <h3 class="msg-empty">Nenhum usuário cadastrado...</h3>
            <?php } else { ?>
                <div class="tags">
                    <?php foreach ($papeis as $papel) { ?>
                        <a href="./TabelaUsuario.php?papelId=<?=$papel->getId()?>" class="link-usuario"><?=$papel->getPapel()?></a>
                    <?php } ?> <!-- fechar foreach -->
                </div>
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Nome</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Senha</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($usuarios as $usuario) { ?>
                            <tr>
                                <td class="text-center">
                                    <!-- <\?= é uma junção de php echo -->
                                    <?= $usuario->getId() ?>
                                </td>
                                <td class="text-center">
                                    <?= $usuario->getNome() ?>
                                </td>
                                <td class="text-center">
                                    <?= $usuario->getEmail() ?>
                                </td>
                                <td class="text-center">
                                    <?= $usuario->getSenha() ?>
                                </td>
                                <td class="text-center">
                                    <a href="./../controller/UsuarioController.php?action=getOne&usuarioId=<?= $usuario->getId() ?>" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                    <a href="./EditUsuario.php?usuarioId=<?= $usuario->getId()?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                    <a href="./../controller/UsuarioController.php?action=delete&usuarioId=<?= $usuario->getId() ?>"
                                        class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php } ?> <!-- fechar foreach -->

                    </tbody>

                </table>
            <?php } ?>

            <a href="./../../index.php" class="link-usuario">+ Criar usuário</a>

        </section>
    </main>

</body>

</html>