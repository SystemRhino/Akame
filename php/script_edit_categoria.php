<?php
session_start();
if($_SESSION['nivel'] != 1){
    header('location:../catalogo.php');
}else{
	include('conecta.php');
			// Salvando dados do POST
			$id = $_POST['id'];
			$nm_categoria = $_POST['nm_categoria'];
		// Upadate
			try {
			  $att_categoria = $conn->prepare("UPDATE tb_categoria SET nm_categoria = '$nm_categoria' WHERE id = '$id'");
			  $att_categoria->execute();
			  echo "<script>history.go(-1);</script>";
			} catch(PDOException $e) {
			    echo $e;
			}
		}

?>
