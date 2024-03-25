<?php 
if (!isset($_GET['id'])){
    header('location:index.php');
}else{
    session_start();
    if ($_SESSION['nivel'] != 1) {
        header('location:../');
    }else{
    include './php/conecta.php';
    
    //Consulta Categoria
    $script_categoria = $conn->prepare("SELECT * FROM tb_categoria");
    $script_categoria->execute();
    $categoria = $script_categoria->fetch(PDO::FETCH_ASSOC);
    $id = $_GET['id'];
    ?>
    <!DOCTYPE html>
    <html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Produto</title>
    </head>
    <body>
    
        <!-- JS -->
        <script src="js/jquery-3.6.0.min.js"></script>
    <body>
    
        <!-- Tag "span" usada para retorno do ajax -->
        <span></span><br>
    
        <!-- Fomr cadastro produto -->
    <form id="form_categoria" method="post" enctype="multipart/form-data">
    <input type="text" name="id" value="<?php echo $categoria['id']?>"><br>
    <input type="text" name="nm_categoria" placeholder="Nome da categoria" value="<?php echo $categoria['nm_categoria']?>"><br>
    
    <br>
    
    <button type="submit" id="enviar">Enviar</button>
    </form>
    <span></span>
    <script>
      $(document).ready(function() {
      $('#form_categoria').submit(function(event) {
        event.preventDefault(); // Impede o envio padrão do formulário
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