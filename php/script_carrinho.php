<?php
session_start();
$id_user = $_SESSION['id'];
    include('conecta.php');
        $stmt = $conn->prepare('INSERT INTO tb_carrinho(id_user, id_produto) VALUES(:id_user, :id_produto)');
        $result = $stmt->fetch(PDO::FETCH_ASSOC);   
        $stmt->execute(array(
            ':id_user' => $id_user,
            ':id_produto' => $_POST['id_produto']
        ));
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
?>