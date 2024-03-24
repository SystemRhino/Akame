<?php 
session_start();
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
    <title>Gerenciar Categorias</title>
</head>
<body>

	<!-- JS -->
	<script src="js/jquery-3.6.0.min.js"></script>
<body>

	<!-- Tag "span" usada para retorno do ajax -->
	<span></span><br>

	<!-- Fomr cadastro produto -->
<form id="form_produto" method="post" enctype="multipart/form-data">
<input type="text" name="nm_categoria" placeholder="Nome da categoria"><br>
<br>

<button type="submit" id="enviar">Enviar</button>
</form>

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
                    <button  onclick="window.location.href = 'php/delete_categoria.php?id=<?php echo $categoria['id'];?>'">Excluir</button>
                    <button onclick="window.location.href = 'edit_categoria.php?id=<?php echo $categoria['id'];?>'">Editar</button>
                </td>
            </tr>
    <?php }?>
</table>
</body>
</html>
<?php }?>