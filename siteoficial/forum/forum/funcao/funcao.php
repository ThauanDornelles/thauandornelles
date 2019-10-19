<?php
function bd(){
     try
{
	$pdo_opcoes[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$bd = new PDO('mysql:host=localhost;dbname=forumdb', 'root', '', $pdo_opcoes);
}
catch (Exception $e)
{
        die('Erro : ' . $e->getMessage());
}
return $bd;
}
?> 