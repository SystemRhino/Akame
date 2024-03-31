<?php
session_start();
if ($_SESSION['nivel'] != 1) {
	header('location:../');
}else{
		$id = $_GET['id'];
		include('conecta.php');
		try {
		  $delete_categoria = $conn->prepare("DELETE FROM tb_categoria WHERE (`id` = '$id')");
		  $delete_categoria->execute();
		  $delete_produto = $conn->prepare("DELETE FROM tb_products WHERE (`id_categoria` = '$id')");
		  $delete_produto->execute();

		  header('location:../add_categoria.php');

		} catch(PDOException $e) {
		    echo $e;
		}
}

?>
