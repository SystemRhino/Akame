<?php 
    if (!isset($_GET['id'])){
        header('location: catalogo.php');
    }else{
        session_start();
        if ($_SESSION['nivel'] != 1) {
            header('location: catalogo.php');
    }else{
        include('php/conecta.php');

        //Consulta Produto
        $id = $_GET['id'];
        $script_categoria = $conn->prepare("SELECT * FROM tb_categoria WHERE id = '$id'");
        $script_categoria->execute();
        $categoria = $script_categoria->fetch(PDO::FETCH_ASSOC);
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
        
        <title>Editar Categoria</title>
    </head>
    <body>
        <main>
            <div class="form">
                <div class="title">
                  Editar categoria
                </div>
                <form id="form_categoria" method="post" enctype="multipart/form-data" class="formF">
                        <input type="text" name="id" value="<?php echo $categoria['id']?>" style="display: none;">
                    <div class="row">
                        <input type="text" name="nm_categoria" placeholder="Nome da categoria" value="<?php echo $categoria['nm_categoria'];?>">
                    </div>
                    <div class="row button">
                        <button type="submit" id="enviar" class="btn-join">Enviar</button>
                    </div>
              </form>
            </div>
        </main>
        <?php include('php/footer.php')?>
            
        <script>
            $(document).ready(function() {
                $('#form_categoria').submit(function(event) {
                    event.preventDefault();
                    var form_data = new FormData(this);

                    $.ajax({
                        url: 'php/script_edit_categoria.php', // Arquivo PHP para processar os dados
                        type: 'POST',
                        data: form_data, 
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            $("span").html(response); // Exibe a resposta do servidor

                          },
                        error: function(xhr, status, error) {
                        console.log(xhr.responseText);

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
