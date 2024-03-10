<?php 
include('./php/conecta.php');

if(isset($_GET['id'])){
    $nm_produto = $_GET['id'];
    $script_produtos = $conn->prepare("SELECT * FROM tb_products WHERE  nm_produto = '$nm_produto'");
    $script_produtos->execute();
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
    while ($produto = $script_produtos->fetch(PDO::FETCH_ASSOC)) { 
        //Consulta Autor
        $nm_produto = $produto['nm_produto'];
        $img_produto = $produto['ds_img'];
?>
        <div>
            <img onclick="window.location.href = 'produto.php?id=<?php echo $nm_produto;?>'" src="./img/<?php echo $img_produto;?>" alt="" width="100" height="100"> 
        </div> 
<?php        
    }
        }else{
             echo "Sem produtos";
        }
    ?>
</body>
</html>