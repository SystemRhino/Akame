<?php
session_start();
    if(!isset($_GET['id'])){
      header('location: catalogo.php');
    }else{
      include('php/conecta.php');
      $nm_produto = $_GET['id'];
      $script_produtos = $conn->prepare("SELECT * FROM tb_products WHERE  nm_produto = '$nm_produto'");
      $script_produtos->execute(); 
      $produto = $script_produtos->fetch(PDO::FETCH_ASSOC);
      $id_produto = $produto['id'];
      $_SESSION['id_produto'] = $id_produto;
    if($script_produtos->rowCount() == 0){
      header("Location: catalogo.php");
    }else{
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
                    <button class="size" onClick="selectTamanho(this.value);" value="P">P</button>
                    <button class="size" onClick="selectTamanho(this.value);" value="M">M</button>
                    <button class="size" onClick="selectTamanho(this.value);" value="G">G</button>
                    <button class="size" onClick="selectTamanho(this.value);" value="GG">GG</button>
<script>
  function selectTamanho(tamanho) {
    document.getElementById('tamanho').value = tamanho;
}
</script>
                    <input style="visibility: hidden;" type="text" value="P" id="tamanho">
                <div class="purchase-info">
                    <input type="number" min="1" value="1" id="quant"><br>
                    <button id="cart" type="button" class="btn" id="cart">Add to Cart <i class="fas fa-shopping-cart"></i></button>
                    <button type = "button" class="btn" id="comprar">Comprar</button>
                    <br><span style="color:white;"></span>
                </div>
            </div>
        </div>
    </main>
    <?php include('php/footer.php');?>

	<!-- JS -->
	<script src="js/jquery-3.6.0.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#comprar").click(function(){
  			$.ajax({
  				url: "php/script_carrinho.php",
  				type: "GET",
  				data: "id="+<?php echo $produto['id']?>+"&quant="+$("#quant").val()+"&size="+$("#tamanho").val(),
  				dataType: "html"
  			}).done(function(resposta) {
	    $("span").html(resposta);

		}).fail(function(jqXHR, textStatus ) {
	    console.log("Request failed: " + textStatus);

		}).always(function() {
	    console.log("completou");
		});
  	});
});

$(document).ready(function(){
			$("#cart").click(function(){
  			$.ajax({
  				url: "php/script_carrinho.php",
  				type: "GET",
  				data: "id="+<?php echo $produto['id']?>+"&quant="+$("#quant").val()+"&size="+$("#tamanho").val(),
  				dataType: "html"
  			}).done(function(resposta) {
          $("span").html("Adicionado ao carrinho!");
		}).fail(function(jqXHR, textStatus ) {
	    console.log("Request failed: " + textStatus);

		}).always(function() {
	    console.log("completou");
		});
  	});
});
	</script>

<!--    <script>
      function addCarrinho() {
        // Obtém o valor do input
        var quantidade = document.getElementById('quant').value;

        // Obtém o ID do produto da URL atual
        var url = window.location.href;
        var parametros = new URLSearchParams(window.location.search);
        var idProduto = <?php echo $$id_produto;?>

        // Monta a URL com os parâmetros adicionados
        var novaURL = 'php/script_carrinho.php?id=' + idProduto + '&quant=' + quantidade;

        // Redireciona para a nova URL
        window.location.href = novaURL;
      }
    </script>-->
  </body>
</html>
<?php } } ?>
