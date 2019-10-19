<?php include_once 'funcao.php';

class addPost {

	private $topico;
	private $nome;
	private $bd;

	public function __construct($nome,$topico){

		$this->topico = htmlspecialchars($topico);
		$this->nome = htmlspecialchars($nome);
		$this->bd = bd();

	}

	public function verif(){

		if(strlen($this->topico) > 0){

			return 'ok'; 

			} else {

				$erro = 'Por favor insira o conteudo';

			return $erro;
		}

	} 

	public function insert(){


		$consulta2 = $this->bd->prepare('INSERT INTO postTopico(propriedades,conteudo,date,topico) VALUES(:propriedades, :conteudo,NOW(),:topico)');

		$consulta2 -> execute(array('propriedades'=>$_SESSION['id'], 'conteudo'=> $this->topico,'topico'=> $this->nome));

		return 1;

	}

}
