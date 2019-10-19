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
	<!-- <script type="text/javascript">
		var divMensagens = document.getElementById('mensagens');
		var height = divMensagens.scrollHeight;
		divMensagens.scrollTop(height);
	</script -->
	<!DOCTYPE html>
	<head>
		<link href="main.css?version=12" />
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
		<title>Bem Vindo ao Fórum</title>
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
	        <a class="nav-link" href=""><i class="fas fa-envelope"></i>Fórum</a>
	      </li>
	    </ul>
	  </div>
	</nav>

<!--Aqui termina NAVBAR-->

	<div class="container-fluid text-center Cforum" id="mensagens">
	<h1>Bem vindo ao Fórum</h1>
		<?php

		echo "<p class='text-center'>".'Olá, '.$_SESSION['pseudo']."!"."</p>";#'.  <a href="desconexao.php">Desconectar</a> ';
		
		if(isset($_GET['categoria'])){
			$_GET['categoria'] = htmlspecialchars($_GET['categoria']); 

		?>

		<div class="container-fluid categoriass text-center">
				<?php echo "<p>".$_GET['categoria']."</p>";?>
		</div>
		
		<?php
		$consulta = $bd->prepare('SELECT * FROM topico WHERE categoria= :categoria ');
		$consulta-> execute(array('categoria'=>$_GET['categoria'])); 
		while ($resposta = $consulta->fetch()) {
				?> 
			<div class="container-fluid categorias saboneteliquido">
				<a href="forum.php?topico=<?php echo $resposta['nome']?>"> <?php echo $resposta['nome'] ?>
				</a>
			</div>

			<?php
		}
		?>
		<div class="fundo">
			<a href="addTopico.php?categoria=<?php echo $_GET['categoria'];?>"> Adicione um novo topico</a>
		</div>
		<?php
	}
		else if (isset($_GET['topico'])){
			$_GET['topico'] = htmlspecialchars($_GET['topico']);
		?>

		<div class ="categorias">
			<a href="#"><?php echo $_GET['topico']; ?></a>
		</div>

		<?php
		$consulta = $bd -> prepare('SELECT * FROM postTopico WHERE topico = :topico ');
		$consulta -> execute(array('topico'=> $_GET['topico']));
		while ($resposta = $consulta -> fetch()){
			?>
			<div class="post" id="mensagens">
				<?php
				$consulta2 = $bd ->prepare('SELECT * FROM membros WHERE id = :id');
				$consulta2 -> execute(array('id'=>$resposta['propriedades']));
				$membros = $consulta2 -> fetch();
				echo "<div class='boxtitulo'>";
				echo "<h4 class='nickmensagens'>".$membros['pseudo']."</h4>"; echo '</div>'; 
				echo "<p class='conteudomensagens'>".$resposta['conteudo']."</p>";
				?>
			</div>
		<?php } ?>
		<div class="chat container-fluid">
			<form method ="post" action="forum.php?topico=<?php echo $_GET['topico']; ?>">
				<!-- <input type="text" name="topico" class="caixadetexto" placeholder="Digite a sua mensagem."> -->
	            <input type="hidden" name="nome" value="<?php echo $_GET['topico']; ?>"/>
<!-- 	            <input type="submit" value="Adicionar a conversa" class="botaoenviar" />
 -->
 				<div class="input-group mb-3">
  					<input type="text" class="form-control caixadetexto" placeholder="Digite sua mensagem" aria-label="Recipient's username" aria-describedby="button-addon2" name="topico">
 					<div class="input-group-append">
   					<button class="btn btn-outline-secondary botaoenviar" type="submit" id="button-addon2"><i class="far fa-paper-plane"></i></button>
  					</div>
				</div>
	            <?php
	            if(isset($erro)){
	            	echo $erro;
	            }
	            ?>
	        </form>
	    </div>    
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
		</body>
	</html>
	<?php
	} 
?> 