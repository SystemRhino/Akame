<?php 
require('conecta.php');
	// Verificando se os inputs estão vazios
	if ($_POST['login'] === "" or $_POST['password'] === "" or $_POST['user'] === "" or $_POST['tel'] === "") {
		echo "Preencha todos os campos!";
	}else{
		// Armazenando dados em variáveis
		$login = $_POST['login'];
		$senha = $_POST['password'];
		$tel = $_POST['tel'];
		$user = $_POST['user'];

		// Validando E-mail
		$valid_email = strpos( $_POST['login'], '@' );
		$valid_email_ponto = strpos( $_POST['login'], '.' );
		$valid_user_space = strpos( $_POST['user'], ' ' );
		if ($valid_email === false or $valid_email_ponto === false) {
			echo 'Insira um E-mail válido!';
		}elseif(strlen($login) > 80){
			echo "E-mail atingiu o limite máximo de caracteres (80)";
		}elseif(strlen($user) > 80){
			echo "Nome de usuario atingiu o limite máximo de caracteres (80)";
		}elseif(strlen($senha) > 20){
			echo "Senha atingiu o limite máximo de caracteres (20)";
		}elseif($valid_user_space == true){
			// Consultando E-mail
		    $script_email = $conn->prepare('SELECT * FROM tb_users WHERE ds_login = :login');
		    $script_email->bindValue("login", $login);
		    $script_email->execute();

		    // Consultando User
		    $script_user = $conn->prepare('SELECT * FROM tb_users WHERE nm_user = :user');
		    $script_user->bindValue("user", $user);
		    $script_user->execute();

			  // Verificando se o email ou user ja esta em uso
			 if ($script_email->rowCount() > 0){
			  	 echo "E-mail já cadastrado!";
			  }else{
				try{
				 $stmt = $conn->prepare('INSERT INTO tb_users(ds_login, ds_senha, ds_tel, nm_user, nivel) VALUES (:login, :senha, :tel, :user, :nivel)');
					$stmt->execute(array(
				 ':login' => $login,
				 ':senha' => $senha,
				 ':tel' => $tel,
				 ':user' => $user,
				 ':nivel' => 2
				 ));
				 
				 // Consultando as informações do user
				 $listagem = $conn->prepare("SELECT * FROM tb_users where ds_login = :login");
				 $listagem->bindValue("login", $login);
				 $listagem->execute();
				 $lista = $listagem->fetch(PDO::FETCH_ASSOC);
				 // Armazenando na sessão
				 session_start();
				 $_SESSION['id'] = $lista['id'];
				 $_SESSION['nivel'] = $lista['nivel'];
				 echo "<script type='text/javascript'>window.location.reload(true);</script>";
			}catch (PDOException $e) {
					echo 'Error: ' . $e->getMessage();
				}
			}
		}else{
			echo 'Digite um sobrenome!';
		}
	}
?>