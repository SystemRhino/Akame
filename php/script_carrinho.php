<?php
session_start();
if (!isset($_SESSION['id'])){
    header('location:../login.php');
}else{
$id_user = $_SESSION['id'];
$id_produto = $_GET['id'];
    include('conecta.php');
        $stmt = $conn->prepare('INSERT INTO tb_carrinho(id_user, id_produto) VALUES(:id_user, :id_produto)');
        $result = $stmt->fetch(PDO::FETCH_ASSOC);   
        $stmt->execute(array(
            ':id_user' => $id_user,
            ':id_produto' => $id_produto
        ));
        echo "<script>history.go(-1);</script>";
    }
?>