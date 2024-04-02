<?php
    session_start();
    // Verificação da sessão
    if (isset($_SESSION['id'])) {
    	header('location:catalogo.php');
    } 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="stylesheet" href="css/login-cadastro.css">
    <link rel="stylesheet" href="css/footer.css">
	<script src="js/jquery-3.6.0.min.js"></script>
	
    <title>Cadastro | Akame</title>
</head>
<body>
    <?php include('php/navbar.php')?>
    <main>
        <div class="containerF">
            <div class="title">
                <h1>Cadastro</h1>
            </div>
            <form id="form_cadastro" method="post" enctype="multipart/form-data" class="form">
                <div class="row">
                    <input type="text" name="user" placeholder="Nome completo">
                </div>
                <div class="row">
                    <input type="number" name="tel" placeholder="Telefone">
                </div>
                <div class="row">
                    <input type="text" name="login" placeholder="E-mail">
                </div>
                <div class="row">
                    <input type="text" name="password" placeholder="Senha">
                </div>
                <div class="pass">
                    <a href="#">Forgot password?</a>
                </div>
                <span></span> <!-- retorno ajax-->
                <div class="row button">
                    <button type="submit" id="entrar" class="btn-join">Cadastrar</button>
                </div>
                <div class="signup-link">Not a member? <a href="login.php">Akame | login</a></div>
            </form>
        </div>
    </main>
    <?php include('php/footer.php')?>

	<script type="text/javascript">
        $(document).ready(function() {
            $('#form_cadastro').submit(function(event) {
                event.preventDefault(); // Impede o envio padrão do formulário
                var form_data = new FormData(this);

                $.ajax({
                    url: 'php/script_cadastro.php', // Arquivo PHP para processar os dados
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
</body>
</html>
