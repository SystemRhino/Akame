<?php 
include('./php/conecta.php');

if(isset($_GET['id'])){
    $nm_produto = $_GET['id'];
    $script_produtos = $conn->prepare("SELECT * FROM tb_products WHERE  nm_produto = '$nm_produto'");
    $script_produtos->execute();
    $produto = $script_produtos->fetch(PDO::FETCH_ASSOC);
    }else{
        header('location:catalogo.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
</head>
<body>
        <div>
            <img src="./img/<?php echo $produto['ds_img'];?>" alt="" width="100" height="100">
            <p><?php echo $produto['nm_produto'];?></p>
            <p style="color: green;">R$<?php echo $produto['vl_produto'];?></p>
        </div>

        <form action="">
            <input type="text" placeholder="Nome do destinatário"><br>
            <input type="text" placeholder="Rua">
            <input type="text" placeholder="N°"><br>
            <input type="text" placeholder="Complemento"><br>
            <input type="text" placeholder="Bairro"><br>
            <input type="text" placeholder="Cidade"><br>
            <input type="text" placeholder="Estado">
            <input type="text" placeholder="CEP"><br>
            <input type="button" value="Finalizar Compra">
        </form>
</body>
</html>
<?php include('footer.php');?>