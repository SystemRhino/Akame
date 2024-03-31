<?php
session_start();
    include('conecta.php');

    // Salvando dados das imagens
    $img_1 = $_FILES["img_1"];
	$ext_1 = substr($img_1['name'], -4);
    $nomeFinal_1 = time().uniqid().$ext_1;

    $img_2 = $_FILES["img_2"];
	$ext_2 = substr($img_2['name'], -4);
    $nomeFinal_2 = time().uniqid().$ext_2;

// Verificando os campos preenchidos
if($_POST['nm_produto'] == "" or $_POST['nr_valor'] == "" or $_POST['ds_produto'] == "" or $_POST['id_categoria'] == "" or $_POST['nr_estoque'] == ""){
    echo "Preencha todos os campos!";
}else{
    // Consultando se ja existe um produto com mesmo nome
    $nm_produto = $_POST['nm_produto'];
    $script_produtos = $conn->prepare("SELECT * FROM tb_products WHERE  nm_produto = '$nm_produto'");
    $script_produtos->execute();
    if ($script_produtos->rowCount() > 0) {
        echo "Nome de produto já cadastrado!";
    }else{
        // Verificando a extensão das imagens
        if($ext_1 == '.jpg' || $ext_1 == 'jpeg' || $ext_1 == '.png' || $ext_2 == '.jpg' || $ext_2 == 'jpeg' || $ext_2 == '.png'){
            try{
                if (move_uploaded_file($img_1['tmp_name'], '../img/'.$nomeFinal_1) && move_uploaded_file($img_2['tmp_name'], '../img/'.$nomeFinal_2)) {
                $stmt = $conn->prepare('INSERT INTO tb_products(nm_produto, vl_produto, ds_produto, img_1, img_2, id_categoria, nr_estoque) VALUES(:nm_produto, :nr_valor, :ds_produto, :img_1, :img_2, :id_categoria, :nr_estoque)');
                $result = $stmt->fetch(PDO::FETCH_ASSOC);   
                $stmt->execute(array(
                    ':nm_produto' => $_POST['nm_produto'],
                    ':nr_valor' => $_POST['nr_valor'],
                    ':ds_produto' => $_POST['ds_produto'],
                    ':img_1' => $nomeFinal_1,
                    ':img_2' => $nomeFinal_2,
                    ':id_categoria' => $_POST['id_categoria'],
                    ':nr_estoque' => $_POST['nr_estoque']
                ));
                // Atualizando a pagina
                echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
            } }catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }else{
            echo 'Envie somente arquivos JPG, JPEG ou PNG!';
        }
    }
}
?>
