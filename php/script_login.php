<?php 
	require('conecta.php');
	session_start();

	$login = $_POST['login'];
	$senha = $_POST['password'];

		if(strlen($login) > 80){
			echo "E-mail atingiu o limite máximo de caracteres (80)";
		}elseif(strlen($senha) > 20){
			echo "Senha atingiu o limite máximo de caracteres (20)";
		}else{
	// Consultando login e senha
	$stmt = $conn->prepare('SELECT * FROM tb_users WHERE ds_login = :login and ds_senha = :senha');
	$stmt->bindValue("login", $login);
	$stmt->bindValue("senha", $senha);
	$stmt->execute();
		// Verificando retorno da consulta
		if ($stmt->rowCount()>0){
			$dado = $stmt->fetch(PDO::FETCH_ASSOC);
			$_SESSION['id'] = $dado['id'];
			$_SESSION['nivel'] = $dado['nivel'];
			echo "<script type='text/javascript'>window.location.reload(true);</script>";
		}else{
			echo "Usuario ou senha incorretos!";
		}
}
?>