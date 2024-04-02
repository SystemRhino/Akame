<?php
  session_start();
  // Verificação da sessão
  if (isset($_SESSION['id']) and $_SESSION['nivel'] == 1) {
  	header('location: gestao_loja.php');
  } else if (isset($_SESSION['id']) and $_SESSION['nivel'] != 1){
    header('location: catalogo.php');
  }else{
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/login-cadastro.css">
    <link rel="stylesheet" href="css/footer.css">
  	<script src="js/jquery-3.6.0.min.js"></script>

    <title>Login</title>
</head>
<body>
    <?php include('php/navbar.php')?>
    <main>
        <div class="containerF">
            <div class="wrapperF">
                <div class="title">
                    <h1>Login</h1>
                </div>
                <div class="form">
                    <div class="row">
                        <input type="email" id="login" placeholder="E-mail:">
                    </div>
                    <div class="row">
                        <input type="password" placeholder="Senha:" id="password">
                    </div>
                    <div class="pass">
                        <a href="#">Forgot password?</a>
                    </div>
                    <span></span> <!-- retorno ajax-->
                    <div class="row button">
                        <button id="entrar" class="btn-join">Entrar</button>
                    </div>
                    <div class="signup-link">
                        <p>Not a member? <a href="cadastro.php">Akame | register</a></p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include('php/footer.php')?>

  	<!-- JS -->
  	<script type="text/javascript">
  		$(document).ready(function(){
  			$("#entrar").click(function(){
    			$.ajax({
    				url: "php/script_login.php",
    				type: "POST",
    				data: "login="+$("#login").val()+"&password="+$("#password").val(),
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
</body>
</html>
<?php } ?>
