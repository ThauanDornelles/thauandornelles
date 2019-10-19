<?php include_once 'funcao.php';

class addTopico{

	private $nome;
	private $topico;
	private $categoria;
	private $bd;

	public function __construct($nome,$topico,$categoria){

		$this->nome = htmlspecialchars($nome);
		$this->topico = htmlspecialchars($topico);
		$this->categoria = htmlspecialchars($categoria);
		$this->bd = bd();

	}

	public function verif(){


	if(strlen($this->nome) > 5 and strlen($this->nome) < 60){

		if(strlen($this->topico) > 0){
			return 'ok'; 
		} else {
			$erro = 'Por favor insira o conteudo do topico';
			return $erro;
		}
	} else{
		$erro = 'O nome do assunto deve ter entre 5 e 20 caracteres';
		return $erro; 
	}
}

public function insert(){
	$consulta = $this->bd->prepare('INSERT INTO topico(nome,categoria) VALUES (:nome,:categoria)');
	$consulta->execute(array('nome'=> $this->nome, 'categoria'=> $this->categoria));

	$consulta2 = $this->bd->prepare('INSERT INTO postTopico(propriedades, conteudo, date, topico) VALUES (:propriedades, :conteudo, NOW(), :topico)');
	$consulta2->execute(array('propriedades'=>$_SESSION['id'], 'conteudo'=> $this->topico,'topico'=> $this->nome));

	return 1;
}
}
