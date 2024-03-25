<?php 
include('./php/conecta.php');

if(isset($_GET['id'])){
    $nm_produto = $_GET['id'];
    $script_produtos = $conn->prepare("SELECT * FROM tb_products WHERE  nm_produto = '$nm_produto'");
    $script_produtos->execute();
    $produto = $script_produtos->fetch(PDO::FETCH_ASSOC);
    }else{
        header('location:catalogo.php');
    }
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/produto.css">



    <title><?php echo $nm_produto;?></title>

    <span></span>
    	<!-- JS -->
	<script src="js/jquery-3.6.0.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#cart").click(function(){
  			$.ajax({
  				url: "php/script_carrinho.php",
  				type: "POST",
  				data: "id_produto=<?php echo $produto['id']?>",
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
	</script>
</head>
<body>
<?php include('php/navbar.php');?>
<div class="main">
    <aside class="left"> 
    
    </aside>

    <main>

    <?php
// Verificação se tem produtos
if ($script_produtos->rowCount()>0){
?>


    <div class = "card-wrapper">
      <div class = "card">
        <!-- card left -->
        <div class = "product-imgs">
          <div class = "img-display">
            <div class = "img-showcase">
            <img src="./img/<?php echo $produto['img_1'];?>" alt="shoe image">
              <!--<img src = "https://images.yampi.me/assets/stores/atlas-company2/uploads/images/camiseta-a-bhating-ape-are-shall-never-kill-ape-preto-65a009359dfea-large.png" alt = "shoe image">-->
       
            </div>
          </div>
        
        </div>
        <!-- card right -->
        <div class = "product-content">
          <h2 class = "product-title"><?php echo $produto['nm_produto'];?></h2>
         
          <div class = "product-price">
            <p class = "new-price">New Price: <span>$249.00 (5%)</span></p>
          </div>

          <div class = "product-detail">
            <h2>sobre o item:</h2>
<p><?php echo $produto['ds_produto'];?></p>           
          </div>

          <div class = "purchase-info">
            <input type = "number" min = "0" value = "1">
            <button id="cart" type = "button" class = "btn">
              Add to Cart <i class = "fas fa-shopping-cart"></i>
            </button>
            
            <button onclick="window.location.href = 'checkout.php?id=<?php echo $nm_produto;?>'" type = "button" class = "btn">Comprar</button>

          </div>

          
        </div>
      </div>
    </div>
    
    <?php        
        }else{
            // Caso não tenha produto
            header('location:catalogo.php');
        }
    ?>

    </main>
<aside class="right"></aside> 
    </div>


    <?php include('php/footer.php');?>

</body>
</html>
