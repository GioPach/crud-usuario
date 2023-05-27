<?php
function conexao()
{
  $pdo = null;
  try {
    $pdo = new PDO('mysql:host=localhost;dbname=crud_usuario;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;

  } catch (PDOException $e) {
    echo 'Erro de conexão: ' . $e->getMessage();
  }
}

?>