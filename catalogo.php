<?php
    session_start();
    include('php/conecta.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/footer.css">
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/index.css">
        <link rel="stylesheet" href="css/catalogo.css">

        <title>Produtos - Akame</title>
    </head>
    <body>
        <?php include('php/navbar.php');?>
        <main>
            <div class="filters">
                <?php
                    $sql = "SELECT * FROM tb_categoria";

                ?>
            </div>
            <div class="list-product">
                <?php
                    $sql = "SELECT * FROM tb_products";
                    $script_produtos = $conn->prepare($sql);
                    $script_produtos->execute();
                    $consulta = $script_produtos->fetch(PDO::FETCH_ASSOC);

                    foreach($consulta as $item){?>
                        <div class="product">
                            <div class="image">
                                <a href="produto.php?id=<?php echo $produto['id'];?>"><img src="<?php echo $produto['img_1'];?>"></a>
                            </div>
                        </div>
                <?php
                    }
                ?>
            </div>
        </main>
        <?php include('php/footer.php');?>
    </body>
</html>
