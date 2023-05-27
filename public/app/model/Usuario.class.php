<?php
include_once 'conexao.php';
class Usuario
{
    private $id;
    private $nome;
    private $email;
    private $senha;

    //* Getters e Setters

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param mixed $id
	 * @return self
	 */
	public function setId($id): self {
		$this->id = $id;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getNome() {
		return $this->nome;
	}

	/**
	 * @param mixed $nome
	 * @return self
	 */
	public function setNome($nome): self {
		$this->nome = $nome;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @param mixed $email
	 * @return self
	 */
	public function setEmail($email): self {
		$this->email = $email;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getSenha() {
		return $this->senha;
	}

	/**
	 * @param mixed $senha
	 * @return self
	 */
	public function setSenha($senha): self {
		$this->senha = $senha;
		return $this;
	}

	public function save()
    {
        $pdo = conexao();
        $stmt = $pdo->prepare('INSERT INTO usuario (nome, email, senha) VALUES(:nome, :email, :senha)');
        $stmt->execute(
            [
                ':nome' => $this->nome,
                ':email' => $this->email,
                ':senha' => $this->senha
            ]
        );


        return $pdo->lastInsertId();
    }

    public static function delete($id)
    {
        $pdo = conexao();
        $stmt = $pdo->prepare('DELETE FROM usuario WHERE id = :id');
        $stmt->execute(
            [
                ':id' => $id
            ]
        );
        $alteredRows = $stmt->rowCount();
        return $alteredRows > 0;
    }

    public static function getAll()
    {
        $pdo = conexao();
        $lista = [];
        foreach ($pdo->query('SELECT * FROM usuario') as $linha) {
            $usuario = new Usuario();
            $usuario->setId($linha['id']);
            $usuario->setNome($linha['nome']);
            $usuario->setEmail($linha['email']);
            $usuario->setSenha($linha['senha']);
            $lista[] = $usuario;
        }

        return $lista;
    }

    public static function getAllByPapel($papelId)
    {
        $pdo = conexao();
        $lista = [];
        foreach ($pdo->query('SELECT * FROM usuario u INNER JOIN papel_usuario pu ON u.id = pu.usuario_id WHERE pu.papel_id = ' . $papelId) as $linha) {
            $usuario = new Usuario();
            $usuario->setId($linha['id']);
            $usuario->setNome($linha['nome']);
            $usuario->setEmail($linha['email']);
            $usuario->setSenha($linha['senha']);
            $lista[] = $usuario;
        }

        return $lista;
    }

    public function update()
    {
        $pdo = conexao();
        try{
            $stmt = $pdo->prepare('UPDATE usuario SET nome = :nome, email = :email WHERE id = :id');
            $stmt->execute([
                ':id' => $this->id,
                ':nome' => $this->nome,
                ':email' => $this->email
            ]);
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    public  function load(){
        $pdo = conexao();
        foreach($pdo->query('SELECT * FROM usuario WHERE id = ' . $this->id) as $linha){
            $this->setNome($linha['nome']);
            $this->setEmail($linha['email']);
            $this->setSenha($linha['senha']);
        }

        return $this;
    }


}

?>