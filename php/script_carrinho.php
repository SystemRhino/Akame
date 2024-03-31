<?php
    try{
        session_start();
        if (!isset($_SESSION['id'])){
            $id_prod = $_GET['id'];
            header('location: ../login.php?link=carrinho&id='.$id_prod);
        }else{
            include('conecta.php');
            
            //vars
            $id_user = $_SESSION['id'];
            $quant = $_GET['quant'];
            $id = $_GET['id'];

            // Puxar id do produto 
            $sql = "SELECT id FROM tb_products WHERE img_1 = :img";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(':img' => $id));
            $id_produto = $stmt->fetch(PDO::FETCH_ASSOC)['id'];

            // Verifique se o produto já está no carrinho
            $sql = "SELECT * FROM tb_carrinho WHERE id_user = :id_user AND id_produto = :id_produto";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(':id_user' => $id_user, ':id_produto' => $id_produto));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);


            if ($row) {
                // // Se o produto já estiver no carrinho, atualize a quantidade
                $nova_quantidade = $row['nr_quant'] + $quant;
                $sql = "UPDATE tb_carrinho SET nr_quant = :quantidade WHERE id_user = :id_user AND id_produto = :id_produto";
                $stmt = $conn->prepare($sql);
                $stmt->execute(array(':quantidade' => $nova_quantidade, ':id_user' => $id_user, ':id_produto' => $id_produto));
            } else {
                // Se o produto não estiver no carrinho, insira um novo registro
                $sql = "INSERT INTO tb_carrinho (id_user, id_produto, nr_quant) VALUES (:id_user, :id_produto, :quantidade)";
                $stmt = $conn->prepare($sql);
                $stmt->execute(array(':id_user' => $id_user, ':id_produto' => $id_produto, ':quantidade' => $quant));
            }
            echo "<script>history.go(-1);</script>";
        }
    } catch (Exception $e) {
        echo "Erro: " . $e->getMessage();
    }
?>
