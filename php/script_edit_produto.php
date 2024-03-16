<?php
session_start();
if($_SESSION['nivel'] != 1){
    header('location:../index.php');
}else{
	include('conecta.php');
			// Salvando dados do POST
			$id = $_POST['id'];
			$nm_produto = $_POST['nm_produto'];
            $vl_produto = $_POST['nr_valor'];
            $nr_estoque = $_POST['nr_estoque'];
        	$ds_produto = $_POST['ds_produto'];
        	$categoria = $_POST['id_categoria'];

            //Consulta Produto
            $script_produto = $conn->prepare("SELECT * FROM tb_products WHERE id = '$id'");
            $script_produto->execute();
            $dado = $script_produto->fetch(PDO::FETCH_ASSOC);

			// Salvando dados do FILES
			$ds_img = $_FILES["ds_img"];
			$ext = substr($ds_img['name'], -4);
			$nomeFinal = $dado['img_1'];
            
            $ds_img2 = $_FILES["ds_img_2"];
			$ext2 = substr($ds_img2['name'], -4);
			$nomeFinal2 = $dado['img_2'];

	if($_FILES['ds_img']['size'] == 0){
		// Upadate
			try {
			  $att_produto = $conn->prepare("UPDATE tb_products SET nm_produto = '$nm_produto', vl_produto = '$vl_produto', nr_estoque = '$nr_estoque', ds_produto = '$ds_produto', id_categoria = '$categoria'WHERE id = '$id'"); // Pegar id da produto
			  $att_produto->execute();
			  echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
			} catch(PDOException $e) {
			    echo $e;
			}
		}else{
			// Verificando extensão
			if($ext == '.jpg' || $ext == 'jpeg' || $ext == '.png'){	
				try {
					if (move_uploaded_file($ds_img['tmp_name'], '../img/'.$nomeFinal)) {
						// Upadate
						$att_user = $conn->prepare("UPDATE tb_products SET nm_produto = '$nm_produto', vl_produto = '$vl_produto', nr_estoque = '$nr_estoque', ds_produto = '$ds_produto', id_categoria = '$categoria', img_1 = '$nomeFinal', img_2 = '$nomeFinal2' WHERE id = '$id'");
						$att_user->execute();
						echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
					}else{
						echo 'erro';
					}
				} catch(PDOException $e) {
					echo $e;
				}
			}else{
				echo 'Envie somente arquivos JPG, JPEG ou PNG!';
			}
	}
}

?>