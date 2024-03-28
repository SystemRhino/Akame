<?php 
session_start();
if ($_SESSION['nivel'] != 1) {
	header('location:../');
}else{
include './php/conecta.php';

//Consulta Categoria
$script_categoria = $conn->prepare("SELECT * FROM tb_categoria");
$script_categoria->execute();

//Consulta Produto
$script_produto = $conn->prepare("SELECT * FROM tb_products");
$script_produto->execute();

//Consulta User
$script_user = $conn->prepare("SELECT * FROM tb_users");
$script_user->execute();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Produtos</title>
</head>
<body>

	<!-- JS -->
	<script src="js/jquery-3.6.0.min.js"></script>
<body>

	<!-- Tag "span" usada para retorno do ajax -->
	<span></span><br>

	<!-- Fomr cadastro produto -->
<form id="form_produto" method="post" enctype="multipart/form-data">
<input type="file" name="img_1"><br>
<input type="file" name="img_2"><br>
<input type="text" name="nm_produto" placeholder="Titulo do produto"><br>
<input type="number" name="nr_valor" placeholder="Valor do produto"><br>
<input type="number" name="nr_estoque" placeholder="Numero do estoque"><br>
<textarea name="ds_produto" placeholder="Descrição"></textarea><br>

<select name="id_categoria">
<?php while ($categoria = $script_categoria->fetch(PDO::FETCH_ASSOC)) {?>	
	<option value="<?php echo $categoria['id']?>"><?php echo $categoria['nm_categoria']?></option>
<?php }?>
</select><br>

<br>

<button type="submit" id="enviar">Enviar</button>
</form>

<script>
  $(document).ready(function() {
  $('#form_produto').submit(function(event) {
    event.preventDefault(); // Impede o envio padrão do formulário
    var form_data = new FormData(this);

  $.ajax({
    url: 'php/script_produto.php', // Arquivo PHP para processar os dados
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
        <th>Titulo</th>
        <th>R$</th>
        <th>Estoque</th>
        <th>Ações</th>
    </tr>
    <?php while ($produto = $script_produto->fetch(PDO::FETCH_ASSOC)) { ?>
			<tr>
				<td><?php echo $produto['id']; ?></td>
                <td><?php echo $produto['nm_produto'];?></td>
                <td><?php echo $produto['vl_produto'];?></td>
                <td><?php echo $produto['nr_estoque'];?></td>
                <td>
                    <button  onclick="window.location.href = 'delete_produto.php?id=<?php echo $produto['id'];?>'">Excluir</button>
                    <button onclick="window.location.href = 'edit_produto.php?id=<?php echo $produto['id'];?>'">Editar</button>
                </td>
            </tr>
    <?php }?>
</table>
</body>
</html>
<?php }?>