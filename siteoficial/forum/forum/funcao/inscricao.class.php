<?php 
#session_start();
include_once 'funcao.php'; 

class inscricao{

	private $pseudo; 
	private $email;
	private $mdp;
	private $mdp2;
	private $bd;

	public function __construct($pseudo, $email, $mdp, $mdp2){

		$pseudo = htmlspecialchars($pseudo);
		$email = htmlspecialchars($email);

		$this->pseudo = $pseudo;
		$this->email = $email;
		$this->mdp = $mdp;
		$this->mdp2 = $mdp2;
		$this->bd = bd();

	}

	public function verif(){

		if(strlen($this->pseudo) > 5 AND strlen($this->pseudo) < 20){

			$syntaxe = '#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#'; 

				if(preg_match($syntaxe,$this->email)){

					if(strlen($this->mdp) > 5 AND strlen($this->mdp) < 20){

						if($this->mdp == $this->mdp2){

							return 'ok';

						} else {
							$erro = 'As senhas devem corresponder';
							return $erro; 
						}
					} else {
						$erro = 'A senha deve conter entre 5 e 20 caracteres';
						return $erro; 
					}
				} else {
					$erro = 'Email incorreto';
					return $erro;
				}
			} else {
				$erro = 'O pseudo deve conter entre 5 e 20 caracteres';
				return $erro; 
			}
		}

		public function enregistrement(){

			$consulta = $this->bd->prepare('INSERT INTO membros(pseudo, email, mdp) VALUES(:pseudo, :email,:mdp)');

			$consulta->execute(array( 
				'pseudo'=> $this->pseudo,
				'email'=> $this->email,
				'mdp'=> $this->mdp
			));

			return 1;
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