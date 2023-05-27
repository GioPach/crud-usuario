<?php
include_once 'Papel.class.php';
include_once 'conexao.php';

class PapelUsuario
{
    private $usuarioId;
    private $papelId;

    //* Getters e Setters


	/**
	 * @return mixed
	 */
	public function getUsuarioId() {
		return $this->usuarioId;
	}

	/**
	 * @param mixed $usuarioId
	 * @return self
	 */
	public function setUsuarioId($usuarioId): self {
		$this->usuarioId = $usuarioId;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getPapelId() {
		return $this->papelId;
	}

	/**
	 * @param mixed $papelId
	 * @return self
	 */
	public function setPapelId($papelId): self {
		$this->papelId = $papelId;
		return $this;
	}

    //* Active Record

    public function save()
    {
        $pdo = conexao();
        $stmt = $pdo->prepare('INSERT INTO papel_usuario (usuario_id, papel_id) VALUES(:usuarioId, :papelId)');
        $stmt->execute(
            [
                ':usuarioId' => $this->usuarioId,
                ':papelId' => $this->papelId
            ]
        );

        $alteredRows = $stmt->rowCount();
        return $alteredRows > 0;
    }

    public static function getPapeisUsuario($usuarioId)  {
        $pdo = conexao();
        $lista = [];
        foreach ($pdo->query('SELECT * FROM papel_usuario WHERE usuario_id = ' . $usuarioId) as $linha) {
            $papelUsuario = new Papel();
            $papelUsuario->setId($linha['papel_id']);
            $papelUsuario->load();
            $lista[] = $papelUsuario;
        }

        return $lista;

    }

    public static function delete($usuarioId, $papelId)
    {
        $pdo = conexao();
        $stmt = $pdo->prepare('DELETE FROM papel_usuario WHERE usuario_id = :usuarioId AND papel_id = :papelId');
        $stmt->execute(
            [
                ':usuarioId' => $usuarioId,
                ':papelId' => $papelId
            ]
        );
        $alteredRows = $stmt->rowCount();
        return $alteredRows > 0;
    }


}

?>