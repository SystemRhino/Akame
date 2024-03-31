<?php
    session_start();
    include('php/conecta.php');

    if(isset($_GET['categoria'])) {
        $categoria = $_GET['categoria'];

        // Consulta categoria
        $sql = "SELECT * FROM tb_categoria WHERE nm_categoria = '$categoria'";
        $consulta_categoria = $conn->prepare($sql);
        $consulta_categoria->execute();
        $categoria = $consulta_categoria->fetch(PDO::FETCH_ASSOC);
        $id_categoria = $categoria['id'];

        // Consulta dos produtos dessa categoria
        $sql = "SELECT * FROM tb_products WHERE id_categoria = '$id_categoria'";
        $consulta_produto = $conn->prepare($sql);
        $consulta_produto->execute();
        $produtos = $consulta_produto->fetchAll(PDO::FETCH_ASSOC);
    }else{
        // Exibe todos os produtos
        $sql = "SELECT * FROM tb_products ORDER BY id DESC";
        $consulta_produto = $conn->prepare($sql);
        $consulta_produto->execute();
        $produtos = $consulta_produto->fetchAll(PDO::FETCH_ASSOC);
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <link rel="stylesheet" href="css/footer.css">
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/catalogo.css">

        <script src="js/jquery-3.6.0.min.js"></script>
        <title>Produtos - Akame</title>
    </head>
    <body>
        <?php include('php/navbar.php');?>
        <main>
            <div class="list-filter">
                <div id="cel">
                   <select id="categoria">
                        <option disabled selected>Categorias</option>
                        <option value="catalogo.php">Remover filtros</option>
                        <?php
                        // Consulta categorias
                        $sql = "SELECT * FROM tb_categoria ORDER BY id DESC";
                        $consulta_categorias = $conn->prepare($sql);
                        $consulta_categorias->execute();
                        $categorias = $consulta_categorias->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($categorias as $filtro) {
                            $id_categoria = $filtro['id'];
                            $nm_categoria = $filtro['nm_categoria'];
                            $categoria_selecionada = isset($_GET['categoria']) && $_GET['categoria'] == $nm_categoria;

                            // Consulta para verificar se há produtos para esta categoria
                            $sql = "SELECT * FROM tb_products WHERE id_categoria = :id_categoria";
                            $consulta_produto = $conn->prepare($sql);
                            $consulta_produto->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
                            $consulta_produto->execute();
                            $resultado = $consulta_produto->fetch(PDO::FETCH_ASSOC);

                            // Se houver produtos, exibe a categoria como uma opção
                            if ($resultado > 0) {
                                ?>
                                <option value="catalogo.php?categoria=<?php echo urlencode($nm_categoria); ?>" <?php echo $categoria_selecionada ? 'selected' : ''; ?>><?php echo $nm_categoria; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div id="desktop">
                    <!-- PARA PC/TABLETS MAIORES -->
                    <div class="remove-button">
                        <button class="remove" onclick="window.location.href='catalogo.php'"><i class="fas fa-trash"></i>Remover filtros</button>
                    </div>
                    <div class="filter-buttons">
                        <?php
                            // Consulta categorias
                            $sql = "SELECT * FROM tb_categoria ORDER BY id DESC";
                            $consulta_categorias = $conn->prepare($sql);
                            $consulta_categorias->execute();
                            $categorias = $consulta_categorias->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($categorias as $filtro){
                                $filtroAtivo = isset($_GET['categoria']) && $_GET['categoria'] == $nm_categoria;
                                $id_categoria = $filtro['id'];
                                $nm_categoria = $filtro['nm_categoria'];

                                // Consulta para verificar se há produtos para esta categoria
                                $sql = "SELECT * FROM tb_products WHERE id_categoria = :id_categoria";
                                $consulta_produto = $conn->prepare($sql);
                                $consulta_produto->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
                                $consulta_produto->execute();
                                $resultado = $consulta_produto->fetch(PDO::FETCH_ASSOC);

                                // Se houver produtos, exibe a categoria como uma opção
                                if ($resultado > 0) {
                                    ?>
                                    <button class="filter <?php echo $filtroAtivo ? 'filtro-ativo' : ''; ?>" onclick="window.location.href='catalogo.php?categoria=<?php echo $nm_categoria; ?>'"><?php echo $nm_categoria;?></button>
                                    <?php
                                }?>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="list-product">
                <?php
                    if(!isset($produtos)){
                        echo "<h3>Não há produtos a serem exibidos</h3>";
                    }else{
                        foreach ($produtos as $produto) {?>
                            <div class="product">
                                <div class="product-image">
                                    <img src="img/<?php echo $produto['img_1'];?>" onmouseover="changeImage(this, '<?php echo 'img/'.$produto['img_2'];?>')" onmouseout="changeImage(this, '<?php echo 'img/'.$produto['img_1'];?>')" onclick="window.location.href='produto.php?id=<?php echo $produto['img_1'];?>'">
                                </div>
                                <div class="product-content">
                                    <h3>R$ <?php echo $produto['vl_produto'];?></h3>
                                </div>
                            </div>
                    <?php
                        }
                    }
                ?>
            </div>
        </main>
        <?php include('php/footer.php');?>
        <script>
            function changeImage(element, newImage) {
                element.src = newImage;
            }

            document.getElementById('categoria').addEventListener('change', function() {
                // Obtém o valor selecionado
                var selecionado = this.value;
                window.location.href = selecionado;
            });
        </script>
    </body>
</html>
