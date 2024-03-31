<?php
session_start();
    if(!isset($_GET['id'])){
      header('location: catalogo.php');
    }else{
      include('php/conecta.php');
      $nm_produto = $_GET['id'];
      $script_produtos = $conn->prepare("SELECT * FROM tb_products WHERE  nm_produto = '$nm_produto'");
      $script_produtos->execute(); 
    if($script_produtos->rowCount() == 0){
      header("Location: catalogo.php");
    }else{
      $produto = $script_produtos->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="css/navbar.css">
      <link rel="stylesheet" href="css/produto.css">
      <link rel="stylesheet" href="css/footer.css">

      <title><?php echo $produto['nm_produto'];?></title>
  </head>
  <body>
    <?php include('php/navbar.php');?>
    <main>
        <div class = "card">
             <!-- card left -->
            <div class = "product-imgs">
                <div class = "img-display">
                    <div class = "img-showcase">
                        <img src="img/<?php echo $produto['img_1'];?>">
                    </div>
                </div>
            </div>
            <!-- card right -->
            <div class="product-content">
                <h2 class="product-title"><?php echo $produto['nm_produto'];?></h2>
                <div class="product-price">
                    <p class="new-price">R$ <?php echo $produto['vl_produto'];?>.00</p>
                </div>
                <div class="product-detail">
                    <h2>sobre o item:</h2>
                    <p><?php echo $produto['ds_produto'];?></p>           
                </div>
                
                <div class="purchase-info">
                    <input type="number" min="1" value="1" id="quant">
                    <button id="cart" type="button" class="btn" onclick="addCarrinho();">Add to Cart <i class="fas fa-shopping-cart"></i></button>
                    <button onclick="window.location.href='carrinho.php?id=<?php echo $produto['id'];?>'" type = "button" class="btn">Comprar</button>
                </div>
            </div>
        </div>
    </main>
    <?php include('php/footer.php');?>

    <script>
      function addCarrinho() {
        // Obtém o valor do input
        var quantidade = document.getElementById('quant').value;

        // Obtém o ID do produto da URL atual
        var url = window.location.href;
        var parametros = new URLSearchParams(window.location.search);
        var idProduto = parametros.get('id');

        // Monta a URL com os parâmetros adicionados
        var novaURL = 'php/script_carrinho.php?id=' + idProduto + '&quant=' + quantidade;

        // Redireciona para a nova URL
        window.location.href = novaURL;
      }
    </script>
  </body>
</html>
<?php } } ?>
