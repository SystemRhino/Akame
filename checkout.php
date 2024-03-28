<?php
session_start();
if (!isset($_SESSION['id'])){
    header('location:index.php');
}else{
    include'./php/conecta.php';
    $id = $_SESSION['id'];
    $script_carrinho = $conn->prepare("SELECT * FROM tb_carrinho WHERE id_user = '$id'");
    $script_carrinho->execute();

    $script_produtos = $conn->prepare("SELECT * FROM tb_products");
    $script_produtos->execute();
    $soma =0;
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/navbar.css">
	<link rel="stylesheet" href="css/login-cadastro.css">
</head>

	<!-- JS -->
	<script src="js/jquery-3.6.0.min.js"></script>
<body>
<?php include('php/navbar.php')?>
<div class="main">
    <aside class="left"> 
  
    </aside>

    <main>
		<!-- Tag "span" usada para retorno do ajax -->
	<span></span>

  <?php
// Verificação se tem produtos
if ($script_carrinho->rowCount()>0){
    while ($carrinho = $script_carrinho->fetch(PDO::FETCH_ASSOC)) { 
        $id_produto = $carrinho['id_produto'];
        $id_carrinho = $carrinho['id'];
        $script_produtos = $conn->prepare("SELECT * FROM tb_products WHERE id='$id_produto'");
        $script_produtos->execute();
        $produto = $script_produtos->fetch(PDO::FETCH_ASSOC);
        $soma = $soma+$produto['vl_produto'];
        //Consulta Produto
        $nm_produto = $produto['nm_produto'];
        $img_produto = $produto['img_1'];
        
?>
                      <div class = "product">
                        <div class = "product-content">
                            <div class = "product-img">
                                <img src = "img/<?php echo $img_produto?>" alt = "product image" class="imgr" height="200" width="200">
                                <h3><?php echo $produto['nm_produto']?></h3>
                                <h3>R$<?php echo $produto['vl_produto']?></h3>
                                <button  onclick="window.location.href = 'php/delete_carrinho.php?id=<?php echo $id_carrinho;?>'">Excluir</button>
                            </div>
                        </div>
                    </div>    
<?php        
    }
        }else{
             echo "Sem produtos no seu carrinho";
        }
    ?>
   

<div class="containerF">
<span></span>
      <div class="wrapperF">
        <div class="title"> <h2>Total: R$<?php echo $soma;?></h2></div>
        <form id="form_check" class="formF">

        <div class="row">
        <button class="btn-join">Finalizar</button>
          </div>

          <div class="row">
          <input name="nome" type="text" placeholder="Nome do destinatário">
          </div>
          
          <div class="row">
          <input name="telefone" type="number" placeholder="Telefone">
          </div>
          <div class="row">
          <input name="rua" type="text" placeholder="Rua">
          </div>
          <div class="row">
          <input name="numero" type="number" placeholder="N°">
          </div>
          
          <div class="row">
          <input name="complemento" type="text" placeholder="Complemento">
          </div>

          <div class="row">
          <input name="bairro" type="text" placeholder="Bairro">
          </div>
         
          <div class="row">
          <input name="cidade" type="text" placeholder="Cidade">
          </div>

          <div class="row">
          <input name="estado" type="text" placeholder="Estado">
          </div>

          <div class="row">
          <input name="cep" type="number" placeholder="CEP">
          </div>

          <div class="row button">
            
            <input type="submit" value="Finalizar Compra" class="btn-join">
          </div>
          
          </form>

      </div>
    </div>






    </main>
<aside class="right"></aside>
    </div>
<!-- While Produtos -->


        <script>
  $(document).ready(function() {
  $('#form_check').submit(function(event) {
    event.preventDefault(); // Impede o envio padrão do formulário
    var form_data = new FormData(this);

  $.ajax({
    url: './php/zap.php', // Arquivo PHP para processar os dados
    type: 'POST',
    data: form_data, 
    contentType: false,
    processData: false,
    success: function(response) {
        console.log(response);
        if(response == 'erro'){
          $("span").html('Preencha todos os dados!');
        }else{
        window.location.href = response;
        }
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