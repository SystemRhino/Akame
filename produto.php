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
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $nm_produto;?></title>
</head>
<body>
<?php
// Verificação se tem produtos
if ($script_produtos->rowCount()>0){
?>
    <!-- Exibição de Produto -->
        <div>
            <h1><?php echo $produto['nm_produto'];?></h1>
            <img src="./img/<?php echo $produto['ds_img'];?>" alt="" width="100" height="100"> 
            <p><?php echo $produto['ds_produto'];?></p>
            <button onclick="window.location.href = 'checkout.php?id=<?php echo $nm_produto;?>'">Comprar</button>
            <button>Adicionar ao carrinho</button>
        </div> 
<?php        
        }else{
            // Caso não tenha produto
            header('location:catalogo.php');
        }
    ?>
</body>
</html>
<?php include('footer.php');?>