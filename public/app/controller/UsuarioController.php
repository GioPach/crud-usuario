<?php

include "./../model/Usuario.class.php";
include "./../model/PapelUsuario.class.php";

function setUsuario()
{
    $usuario = new Usuario();
    $usuario->setNome($_POST['nome']);
    $usuario->setEmail($_POST['email']);
    $usuario->setSenha($_POST['senha']);
    return $usuario;
}

function savePapeis($usuarioId)
{
    $papeis = $_POST['papeis'];
    foreach($papeis as $papel) {
        $papelUsuario = new PapelUsuario();
        $papelUsuario->setUsuarioId($usuarioId);
        $papelUsuario->setPapelId($papel);
        $papelUsuario->save();
    }

}

function updatePapeis($usuarioId)
{
    $papeisAtualizados = $_POST['papeis'];
    $papeisUsuario =
        array_map(fn($papel) => $papel->getId(),
        PapelUsuario::getPapeisUsuario($usuarioId));

    //o que tem nos atualizados q n tem nos já cadastrados ?
    $addPapeis = array_diff($papeisAtualizados, $papeisUsuario);
    foreach($addPapeis as $papelId) {
        $papelUsuario = new PapelUsuario();
        $papelUsuario->setUsuarioId($usuarioId);
        $papelUsuario->setPapelId($papelId);
        $papelUsuario->save();
    }

    //o que tem nos já cadastrados que não tem nos atualizados?
    $deletePapeis = array_diff($papeisUsuario, $papeisAtualizados);
    foreach($deletePapeis as $papelId) {
        PapelUsuario::delete($usuarioId, $papelId);
    }

}

$action = $_GET['action'];

if ($action == 'save') {
    // echo var_dump($_POST);
    $usuario = setUsuario();
    $usuarioId = $usuario->save();
    savePapeis($usuarioId);

    header("Location: ../view/TabelaUsuario.php");
}

else if ($action == 'delete') {
    Usuario::delete($_REQUEST['usuarioId']);
    header("Location: ../view/TabelaUsuario.php");
}

else if($action == 'getOne') {
    $usuarioId = $_GET['usuarioId'];
    header("Location: ../view/ReadUsuario.php?usuarioId=" . $usuarioId);
}

else if ($action == 'update') {
    $usuario = setUsuario();
    $usuario->setId(intval($_POST['usuarioId']));
    $usuario->update();
    updatePapeis($usuario->getId());
    header("Location: ../view/TabelaUsuario.php");
}