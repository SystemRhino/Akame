<?php
session_start();
if ($_SESSION['nivel'] != 1) {
	header('location:../catalogo.php');
}else{
		$id = $_GET['id'];
		include('php/conecta.php');
		try {
		$script_produtos = $conn->prepare("SELECT * FROM tb_products WHERE  id = '$id'");
    	$script_produtos->execute();
    	$produto = $script_produtos->fetch(PDO::FETCH_ASSOC);
		$img_1 = "img/".$produto['img_1'];
	 	$img_2 = "img/".$produto['img_2'];
		unlink("image_path");
		unlink($img_1);
		unlink($img_2);
		
		  $delete_produto = $conn->prepare("DELETE FROM tb_products WHERE (`id` = '$id')");
		  $delete_produto->execute();
		  $delete_carrinho = $conn->prepare("DELETE FROM tb_carrinho WHERE (`id_produto` = '$id')");
		  $delete_carrinho->execute();
		  

		  header('location:add_produto.php');

		} catch(PDOException $e) {
		    echo $e;
		}
}

?>
