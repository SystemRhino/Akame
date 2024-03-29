<?php 
include('php/navbar.php');
if ($_SESSION['nivel'] != 1) {
	header('location:./');
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
    <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/navbar.css">
	<link rel="stylesheet" href="css/login-cadastro.css">
    <title>Gerenciar Produtos</title>
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
        <div class="title">Adicionar produto</div>
        <form id="form_produto" method="post" enctype="multipart/form-data" class="formF">


        <div class="row">
            
        <input type="file" name="img_1">
            </div>
            
        <div class="row">
            
        <input type="file" name="img_2">
                </div>
            
          <div class="row">
            
          <input type="text" name="nm_produto" placeholder="Titulo do produto">
          </div>
          
          <div class="row">
          <input type="number" name="nr_valor" placeholder="Valor do produto">
          </div>
          <div class="row">
          <input type="number" name="nr_estoque" placeholder="Numero do estoque">
          </div>
          <div class="row">
          <textarea name="ds_produto" placeholder="Descrição" ></textarea>
          </div>
          <div class="row">
          <select name="id_categoria">
<?php while ($categoria = $script_categoria->fetch(PDO::FETCH_ASSOC)) {?>	
	<option value="<?php echo $categoria['id']?>"><?php echo $categoria['nm_categoria']?></option>
<?php }?>
</select>
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
                    <button  onclick="window.location.href = 'php/delete_produto.php?id=<?php echo $produto['id'];?>'">Excluir</button>
                    <button onclick="window.location.href = 'edit_produto.php?id=<?php echo $produto['id'];?>'">Editar</button>
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



<?php include('php/footer.php')?>
</body>
</html>
<?php }?>