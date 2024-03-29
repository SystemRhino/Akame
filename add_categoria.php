<?php 
include('php/navbar.php');
if ($_SESSION['nivel'] != 1) {
	header('location:../');
}else{
include './php/conecta.php';

//Consulta Categoria
$script_categoria = $conn->prepare("SELECT * FROM tb_categoria");
$script_categoria->execute();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/navbar.css">
	<link rel="stylesheet" href="css/login-cadastro.css">
    <title>Gerenciar Categorias</title>
</head>
<body>

<div class="main">
    <aside class="left"> 
    
    </aside>

    <main>
		<!-- Tag "span" usada para retorno do ajax -->
	<span></span>


<div class="containerF">
      <div class="wrapperF">
        <div class="title">Adicionar categoria</div>

        <form id="form_produto" method="post" enctype="multipart/form-data" class="formF">
          <div class="row">
            
          <input type="text" name="nm_categoria" placeholder="Nome da categoria">
          </div>
          
         
         
          <div class="row button">
  
            <button type="submit" id="enviar" class="btn-join">Enviar</button>
          </div>
          
          </form>

      </div>
    </div>


    <table>
    <tr>
        <th>#ID</th>
        <th>Nome</th>
        <th>Ações</th>
    </tr>
    <?php while ($categoria = $script_categoria->fetch(PDO::FETCH_ASSOC)) { ?>
			<tr>
				<td><?php echo $categoria['id']; ?></td>
                <td><?php echo $categoria['nm_categoria'];?></td>
                <td>
                    <button class="btn-join" onclick="window.location.href = 'php/delete_categoria.php?id=<?php echo $categoria['id'];?>' ">Excluir</button>
                    
                    <button class="btn-join" onclick="window.location.href = 'edit_categoria.php?id=<?php echo $categoria['id'];?>'">Editar</button>
                </td>
            </tr>
    <?php }?>
</table>



    </main>
<aside class="right"></aside>
    </div>

	<!-- JS -->
	<script src="js/jquery-3.6.0.min.js"></script>




<script>
  $(document).ready(function() {
  $('#form_produto').submit(function(event) {
    event.preventDefault(); // Impede o envio padrão do formulário
    var form_data = new FormData(this);

  $.ajax({
    url: 'php/script_categoria.php', // Arquivo PHP para processar os dados
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



<?php include('php/footer.php')?>
</body>
</html>
<?php }?>
