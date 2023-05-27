<?php
include_once 'conexao.php';
class Papel
{
    private $id;
    private $papel;

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
	public function getPapel() {
		return $this->papel;
	}

	/**
	 * @param mixed $papel
	 * @return self
	 */
	public function setPapel($papel): self {
		$this->papel = $papel;
		return $this;
	}

    //* Active Record

    public static function getAll()
    {
        $pdo = conexao();
        $lista = [];
        foreach ($pdo->query('SELECT * FROM papel') as $linha) {
            $papel = new Papel();
            $papel->setId($linha['id']);
            $papel->setPapel($linha['papel']);
            $lista[] = $papel;
        }
        return $lista;
    }
    public function load(){
        $pdo = conexao();
        foreach($pdo->query('SELECT * FROM papel WHERE id = ' . $this->id) as $linha){
            $this->setPapel($linha['papel']);
        }

        return $this;
    }


}

?>