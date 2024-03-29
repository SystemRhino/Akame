<?php
include('php/navbar.php');
// Verificação da sessão
if (isset($_SESSION['id']) and $_SESSION['id'] == 1) {
  	header('location:adm.php');
  } else if (isset($_POST['']) and $_SESSION['id'] != 1){
    header('location:catalogo.php');
  }
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


    <title>Login</title>

</head>
<body>
    	
	


<div class="main">
    <aside class="left"> 
    Left
    </aside>

    <main>
		<!-- Tag "span" usada para retorno do ajax -->
	<span></span>


<div class="containerF">
      <div class="wrapperF">
        <div class="title">Login</div>
        <div class="formF" action="#">
          <div class="row">
            
			<input type="email" id="login" placeholder="E-mail:">
          </div>
          
          <div class="row">
            <input type="password" placeholder="Senha:" id="password">
          </div>
          <div class="pass"><a href="#">Forgot password?</a></div>
          <div class="row button">
            <button id="entrar" class="btn-join">Entrar</button>
          </div>
          <div class="signup-link">Not a member? <a href="cadastro.php">Akame | login</a></div>
        </div>
      </div>
    </div>






    </main>
<aside class="right">right</aside>
    </div>


    <?php include('php/footer.php')?>


	<!-- JS -->
	<script src="js/jquery-3.6.0.min.js"></script>
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