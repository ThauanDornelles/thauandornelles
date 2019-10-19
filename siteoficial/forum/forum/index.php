<?php session_start();
include_once 'funcao/funcao.php';
include_once 'funcao/addPost.class.php';
$bd = bd();

if(!isset($_SESSION['id'])){
	header('Location: inscricao.php');
} else
{
	if(isset($_POST['nome']) and isset($_POST['topico'])){

		$addPost = new addPost($_POST['nome'], $_POST['topico']);
		$verif = $addPost -> verif();
		if($verif == "ok"){

		if($addPost->insert()){

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
	<meta charset='utf-8'>

	<title>forum pika</title>
	<meta name="autor" content="Pajé">
	<link rel="stylesheet" type="text/css" href="css/geral.css">
</head>
<body>

	<!--Aqui começa NAVBAR-->

	    <script src="https://kit.fontawesome.com/4bed44fa76.js"></script>

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
	        <a class="nav-link" href="forum.php"><i class="fas fa-envelope"></i>Fórum</a>
	      </li>
	    </ul>
	  </div>
	</nav>

<!--Aqui termina NAVBAR-->
	<div class="container-fluid">
	<h1 class="titulo">Bem vindo ao meu fórum</h1>
	<div id="Cforum">
		<?php

		echo 'Olá '.$_SESSION['pseudo'];#'.  <a href="desconexao.php">Desconectar</a> ';
		
		if(isset($_GET['categoria'])){
			$_GET['categoria'] = htmlspecialchars($_GET['categoria']); 

		?>

		<div class="categorias">
			<h1>
				<?php echo $_GET['categoria']; ?>
					</h1>
		</div>
		
		<a href="addTopico.php?categoria=<?php echo $_GET['categoria'];?>">
		Adicione um novo topico </a>

		<?php
		$consulta = $bd->prepare('SELECT * FROM topico WHERE categoria= :categoria ');
		$consulta-> execute(array('categoria'=>$_GET['categoria'])); 
		while ($resposta = $consulta->fetch()) {
				?> 
			<div class="categorias">
				<a href="forum.php?topico=<?php echo $resposta['nome']?>">
					<h1><?php echo $resposta['nome'] ?>
						
					</h1>
				</a>
			</div>
			<?php
		}
		?>

		<?php
	}
		else if (isset($_GET['topico'])){
			$_GET['topico'] = htmlspecialchars($_GET['topico']);
		?>

		<div class ="categorias">
			<h1><?php echo $_GET['topico']; ?></h1>
		</div>

		<?php
		$consulta = $bd -> prepare('SELECT * FROM postTopico WHERE topico = :topico'. 
			'order by date desc');
		$consulta -> execute(array('topico'=> $_GET['topico']));
		while ($resposta = $consulta -> fetch()){
			?>
			<div class="post">
				<?php
				$consulta2 = $bd ->prepare('SELECT * FROM membros WHERE id = :id');
				$consulta2 -> execute(array('id'=>$resposta['propriedades']));
				$membros = $consulta2 -> fetch();
				echo $membros['pseudo']; echo ': <br>'; 
				echo $resposta['conteudo'];
				?>
			</div>
		<?php } ?>

		<form method ="post" action="forum.php?topico=<?php echo $_GET['topico']; ?>">
			<textarea name="topico" placeholder="Escreva aqui..."></textarea>
            <input type="hidden" name="nome" value="<?php echo $_GET['topico']; ?>" />
            <input type="submit" value="Adicionar a conversa" />

            <?php
            if(isset($erro)){
            	echo $erro;
            }
            ?>
        </form>
        <?php
    } else {
    	$consulta = $bd -> query('SELECT * FROM categorias');

    	while ($resposta = $consulta -> fetch()){
    
        ?>
		      <div class="categorias">
		    <a href="forum.php?categoria=<?php echo $resposta['nome']; ?>">
		    <?php echo $resposta['nome']; ?></a>
		</div>
	    <?php
	   	 } 
		} 
	?>
			</div>
		</div>
		</body>
	</html>
	<?php
	} 
?> 