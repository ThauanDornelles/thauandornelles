<?php session_start();
include_once 'funcao/funcao.php';
include_once 'funcao/conexao.class.php';
$bd = bd();

if(isset($_POST['pseudo']) and isset($_POST['mdp'])){

	$conexao = new conexao($_POST['pseudo'], $_POST['mdp']); 
   	$verif = $conexao -> verif();

   	if($verif == "ok"){

   		if($conexao->session()){
   			header('Location: forum.php');
   		}

   	} else {
   		$erro = $verif;
   	}
   }
?>

<!DOCTYPE html>
<head>
		<!--Bootstrap-->
	<style type="text/css">
      i {padding: 5px;}
   	</style>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
   		 		crossorigin="anonymous">
<!--Bootstrap-->

	<meta charset="utf-8"/>
	<title></title>

	<meta name="author" content="Pajé">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Karla' rel='stylesheet' type='text/css'>
	    <script src="https://kit.fontawesome.com/4bed44fa76.js"></script>
</head>
<body>

	<!--Aqui começa NAVBAR-->


	    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
	    	integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
	    		crossorigin="anonymous"></script>

	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" 
	    	integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" 
	    		crossorigin="anonymous"></script>

	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
	    	integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" 
	    		crossorigin="anonymous"></script>

	  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	    <a class="navbar-brand" href="#">Economia de Santa Catarina</a>
	    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" 
	    	aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">

	      <span class="navbar-toggler-icon"></span>

	    </button>

	  <div class="collapse navbar-collapse" id="navbarNavDropdown">
	    <ul class="navbar-nav ml-auto">
	      <li class="nav-item active">
	        <a class="nav-link" href="#"><i class="fas fa-home"></i>Início <span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#"><i class="fas fa-stream"></i>Linhas do Tempo</a>
	      </li>
	      <li class="nav-item dropdown">
	        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	          <i class="fas fa-user"></i>Perfil
	        </a>
	  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
	          <a class="dropdown-item" href="inscricao.php"><i class="fas fa-user-plus"></i>Cadastro</a>
	          <a class="dropdown-item" href="conexao.php"><i class="fas fa-sign-in-alt"></i>Login</a>
	          <a class="dropdown-item" href="desconexao.php"><i class="fas fa-user-times"></i>Sair</a>
	        </div>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#"><i class="fas fa-envelope"></i>Fórum</a>
	      </li>
	    </ul>
	  </div>
	</nav>

<!--Aqui termina NAVBAR-->

<div class="container-fluid">
 	<div class="row">
 		<div class="box col-md-4 col-xs-12" id="different_one">
			<h1>Login</h1>
				<form method="post" action="conexao.php">
						<div class="form-group">
							<input type="text" name="pseudo" placeholder="User" required class="form-control">
						</div>
						<div class="form-group">
							<input type="password" name="mdp" placeholder="Senha:" required class="form-control">
						</div>
						<div class="form-group">
							<input class="btn btn-default" type="submit" value="Logar">
						<?php
						if(isset($erro)){
							echo "<p>$erro</p>";
						}
						?>
						</div>
				</form>
		</div>
	</div>
</div>	
</body>
</html>