<?php 
    if (!isset($_GET['id'])){
        header('location: catalogo.php');
    }else{
        session_start();
        if ($_SESSION['nivel'] != 1) {
            header('location: catalogo.php');
    }else{
        include('php/conecta.php');

        //Consulta Categoria
        $script_categoria = $conn->prepare("SELECT * FROM tb_categoria");
        $script_categoria->execute();
        $categoria = $script_categoria->fetchAll(PDO::FETCH_ASSOC);

        //Consulta Produto
        $id = $_GET['id'];
        $script_produto = $conn->prepare("SELECT * FROM tb_products WHERE img_1 = '$id'");
        $script_produto->execute();
        $produto = $script_produto->fetch(PDO::FETCH_ASSOC);
    ?>
<!DOCTYPE html>
  <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/edit_produto.css">
        <link rel="stylesheet" href="css/footer.css">

        <!-- JS -->
        <script src="js/jquery-3.6.0.min.js"></script>
        
        <title>Editar Produto</title>
    </head>
    <body>
    <main>
        <div class="form">
            <div class="title">
              Editar produto
            </div>
            <form id="form_produto" method="post" enctype="multipart/form-data" class="formF">
                <div class="images">
                    <figure>
                      <img src="img/<?php echo $produto['img_1'];?>">
                      <figcaption>imagem 1</figcaption>
                    </figure>
                    <figure>
                      <img src="img/<?php echo $produto['img_2'];?>">
                      <figcaption>imagem 2</figcaption>
                    </figure>
                </div>
                <input name="id" value="<?php echo $produto['id'];?>" style="display: none;">
                <div class="row">
                    <input type="file" name="ds_img">
                </div>
                <div class="row">
                    <input type="file" name="ds_img_2">
                </div>
                <div class="row">
                    <input type="text" name="nm_produto" placeholder="Titulo do produto" value="<?php echo $produto['nm_produto']?>">
                </div>
                <div class="row">
                    <input type="number" name="nr_valor" placeholder="Valor do produto" value="<?php echo $produto['vl_produto']?>">
                </div>
                <div class="row">
                    <input type="number" name="nr_estoque" placeholder="Numero do estoque" value="<?php echo $produto['nr_estoque']?>">
                </div>
                <div class="row">
                    <textarea name="ds_produto" placeholder="Descrição"><?php echo $produto['ds_produto']?></textarea>
                </div>
                <div class="row">
                    <select name="id_categoria">
                        <?php foreach ($categoria as $item) {
                            if ($item['id'] == $produto['id_categoria']) { ?>
                                <option value="<?php echo $item['id']; ?>" selected><?php echo $item['nm_categoria']; ?></option>
                            <?php } else { ?>
                                <option value="<?php echo $item['id']; ?>"><?php echo $item['nm_categoria']; ?></option>
                            <?php } 
                        } ?>
                    </select>
                </div>
                <div class="row button">
                    <button type="submit" id="enviar" class="btn-join">Enviar</button>
                </div>
                <span style="color: #fff;"></span>
            </form>
        </div>
        </main>
        <?php include('php/footer.php')?>
        
        <script>
            $(document).ready(function() {
                $('#form_produto').submit(function(event) {
                    event.preventDefault(); 
                    var form_data = new FormData(this);
        
                    $.ajax({
                        url: 'php/script_edit_produto.php',
                        type: 'POST',
                        data: form_data, 
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            $("span").html(response);
                        },
                        error: function(xhr, status, error) {
                             $("span").html(xhr.responseText);
                        }
                    });
                });
            });
        </script>
    </body>
</html>
    <?php 
        }
    }
    ?>
