<?php include_once 'funcao.php';

class conexao{
	private $pseudo;
	private $mdp;
	private $bd;

	public function __construct($pseudo, $mdp){
		$this->pseudo = $pseudo;
		$this->mdp = $mdp;
		$this->bd = bd();
	}

	public function verif(){

		$consulta = $this->bd->prepare('SELECT * FROM membros WHERE pseudo = :pseudo');
		$consulta->execute(array('pseudo'=> $this->pseudo));
		$resposta = $consulta->fetch();
		if($resposta){
			if($this->mdp == $resposta['mdp']){
				return 'ok';
			} else {
				$erro = 'Senha incorreta';
				return $erro;
			}
		} else {
			$erro = 'Usuario não existe';
			return $erro;
		}
	}

	public function session(){
		$consulta = $this->bd->prepare('SELECT id FROM membros WHERE pseudo = :pseudo '); 
		$consulta->execute(array('pseudo'=> $this->pseudo)); 
		$consulta = $consulta->fetch();
		$_SESSION['id'] = $consulta['id']; 
		$_SESSION['pseudo'] = $this->pseudo;

		return 1;
	}
}

?>