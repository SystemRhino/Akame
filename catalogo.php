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
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/catalogo.css">

    <title>Produtos - Akame</title>
    <style>
        #teste{
            filter: drop-shadow(2px 2px 4px #ffff);
        }
    </style>
      
</head>
<body>

<?php include('php/navbar.php');?>

<div class="main">
    <aside class="left"> 
    
    </aside>

    <main>
    <div class = "products">
            <div class = "containerCR">

                <div class = "product-items">
<!-- While Produtos -->

<?php
// Verificação se tem produtos
if ($script_produtos->rowCount()>0){
    while ($produto = $script_produtos->fetch(PDO::FETCH_ASSOC)) { 
        //Consulta Autor
        $nm_produto = $produto['nm_produto'];
        $img_produto = $produto['img_1'];
        
?>
                      <div class = "product">
                        <div class = "product-content">
                            <div class = "product-img">
                                <img onclick="window.location.href = 'produto.php?id=<?php echo $nm_produto;?>'" src = "img/<?php echo $img_produto?>" alt = "product image" class="imgr">
                            </div>
                        </div>
                    </div>    
<?php        
    }
        }else{
             echo "Sem produtos";
        }
    ?>

       

                </div>
            </div>
        </div>

    </main>
<aside class="right"></aside>
    </div>

<?php include('php/footer.php');?>
</body>
</html>
