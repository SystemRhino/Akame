<?php
session_start();
    include('conecta.php');
    if($_POST['nm_categoria'] !== ""){
        $stmt = $conn->prepare('INSERT INTO tb_categoria(nm_categoria) VALUES(:nm_categoria)');
        $result = $stmt->fetch(PDO::FETCH_ASSOC);   
        $stmt->execute(array(
            ':nm_categoria' => $_POST['nm_categoria']
        ));
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
    }else{
        echo "Digite algo";
    }
?>
