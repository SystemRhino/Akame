<?php
include('./php/conecta.php');

if(isset($_GET['categoria'])){
    $nm_categoria = $_GET['categoria'];
    //Consulta Categoria
    $script_categoria = $conn->prepare("SELECT * FROM tb_categoria WHERE nm_categoria = '$nm_categoria'");
    $script_categoria->execute();
    $categoria = $script_categoria->fetch(PDO::FETCH_ASSOC);
    $id_categoria = $categoria['id'];

    //Consulta Produtos
    $script_produtos = $conn->prepare("SELECT * FROM tb_products WHERE id_categoria = '$id_categoria'");
    $script_produtos->execute();
    }else{
        $script_produtos = $conn->prepare("SELECT * FROM tb_products ORDER BY id DESC");
        $script_produtos->execute();
    }

//Consulta Categoria
$script_categoria = $conn->prepare("SELECT * FROM tb_categoria ORDER BY id DESC");
$script_categoria->execute();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
</head>
<body>
<br>
<!-- While Produtos -->
<?php 
while ($categoria = $script_categoria->fetch(PDO::FETCH_ASSOC)) { 
    //Consulta Autor
    $nm_categoria = $categoria['nm_categoria'];
?>
    <button onclick="window.location.href = 'catalogo.php?categoria=<?php echo $nm_categoria;?>'"><?php echo $nm_categoria;?></button>
<?php        
}
?>
<!-- While Produtos -->
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
<?php include('footer.php');?>