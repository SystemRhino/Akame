<?php
session_start();
if (!isset($_SESSION['id'])) {
	header('location:../');
}else{
        $id = $_GET['id'];
		include('conecta.php');
		try {
		  $delete_carrinho = $conn->prepare("DELETE FROM tb_carrinho WHERE (`id` = '$id')");
		  $delete_carrinho->execute();

		  header('location:../carrinho.php');

		} catch(PDOException $e) {
		    echo $e;
		}
}

?>