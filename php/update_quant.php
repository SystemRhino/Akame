<?php
    session_start();
    require('conecta.php');

    // vars
    $action = $_POST['action'];
    $currentNumber = $_POST['number'];
    $id_product = $_GET['id'];
    $id_user = $_SESSION['id'];

    try {
        // É para incrementar ou tirar?
        if ($action == 'increment') {
            $newNumber = $currentNumber + 1;
        } elseif ($action == 'decrement') {
            $newNumber = $currentNumber - 1;
        }
        
        $sql = "UPDATE tb_carrinho SET nr_quant = :newNumber WHERE id = ".$id_product;
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':newNumber', $newNumber);
        $stmt->execute();

        echo $newNumber; // Retorna o novo número para o JavaScript
    } catch(PDOException $e) {
        echo "Erro ao atualizar o número: " . $e->getMessage();
    }
?>
