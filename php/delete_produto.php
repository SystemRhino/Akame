<?php
session_start();
if ($_SESSION['nivel'] != 1) {
	header('location:../');
}else{
		$id = $_GET['id'];
		include('conecta.php');
		try {
		  $delete_produto = $conn->prepare("DELETE FROM tb_products WHERE (`id` = '$id')");
		  $delete_produto->execute();

		  header('location:../add_produto.php');

		} catch(PDOException $e) {
		    echo $e;
		}
}

?>