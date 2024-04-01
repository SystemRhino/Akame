<?php
    try{
        session_start();
        if (!isset($_SESSION['id'])){
            $id_prod = $_GET['id'];
            //header('location: ../login.php?link=carrinho&id='.$id_prod);
            echo "<script>window.location.href='login.php?link=carrinho&id=$id_prod';</script>";
        }elseif(!isset($_GET['size'])){
            echo 'Selecione um tamanho!';
        }else{
            include('conecta.php');
            
            //vars
            $id_user = $_SESSION['id'];
            $quant = $_GET['quant'];
            $id = $_GET['id'];
            $tamanho = $_GET['size'];

            // Puxar id do produto 
            $sql = "SELECT * FROM tb_products WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(':id' => $id));
            $id_produto = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verifique se o produto já está no carrinho
            $sql = "SELECT * FROM tb_carrinho WHERE id_user = :id_user AND id_produto = :id_produto AND tamanho = :tamanho";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(':id_user' => $id_user, ':id_produto' => $id, ':tamanho' => $tamanho));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);


            if ($row) {
                // // Se o produto já estiver no carrinho, atualize a quantidade
                $nova_quantidade = $row['nr_quant'] + $quant;
                $sql = "UPDATE tb_carrinho SET nr_quant = :quantidade WHERE id_user = :id_user AND id_produto = :id_produto AND tamanho = :tamanho";
                $stmt = $conn->prepare($sql);
                $stmt->execute(array(':quantidade' => $nova_quantidade, ':id_user' => $id_user, ':id_produto' => $id, ':tamanho' => $tamanho));
            } else {
                // Se o produto não estiver no carrinho, insira um novo registro
                $sql = "INSERT INTO tb_carrinho (id_user, id_produto, nr_quant, tamanho) VALUES (:id_user, :id_produto, :quantidade, :tamanho)";
                $stmt = $conn->prepare($sql);
                $stmt->execute(array(':id_user' => $id_user, ':id_produto' => $id, ':quantidade' => $quant, ':tamanho' => $tamanho));
            }
            echo "<script>window.location.href='carrinho.php';</script>";
        }
    } catch (Exception $e) {
        echo "Erro: " . $e->getMessage();
    }
?>
