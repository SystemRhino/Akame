<?php
	session_start();
	if(!isset($_SESSION['id'])){
		header("Location: login.php");
	}else if ($_SESSION['nivel'] != 1){
		header("Location: catalogo.php");
	}else{
		include("php/conecta.php");

		//Consulta Categoria
		$script_categoria = $conn->prepare("SELECT * FROM tb_categoria");
		$script_categoria->execute();
        $categoria = $script_categoria->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
	<head>
		<!-- LINK CSS -->
		<link rel="stylesheet" type="text/css" href="css/navbar.css">
		<link rel="stylesheet" type="text/css" href="css/gestao_categ.css">
		<link rel="stylesheet" type="text/css" href="css/footer.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

        <!-- JS -->
        <script src="js/jquery-3.6.0.min.js"></script>

		<title>Gestão da Loja</title>
	</head>
	<body>
		<?php include("php/navbar.php"); ?>

		<main>
			<div class="form">
                <div class="title">Adicionar categoria</div>
                <form id="form_produto" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <input type="text" name="nm_categoria" placeholder="Nome da categoria">
                    </div>
                    <div class="row button">
                        <button type="submit" id="enviar" class="btn-join">Enviar</button>
                    </div>
                </form>
                <span style="color: white;"></span>
			</div>
			<div class="list-categ">
				<?php
                    if (isset($categoria)){
                        foreach($categoria as $item){?>
                            <div class="categ">
                                <div class="delete">
                                    <a href="php/delete_categoria.php?id=<?php echo $item['id'];?>"><i class="fas fa-trash"></i></a>
                                </div>
                                <div class="info">
                                    <h4 style="color: #fff;"><?php echo $item['nm_categoria'];?></h4>
                                </div>
                                <div class="edit">
                                    <a class="btn-join" href="edit_categoria.php?id=<?php echo $item['id'];?>">Editar</a>
                                </div>
                            </div>
                    <?php
                        }
                    }else{
                        echo "<h3 style='color: #fff'>Não há categorias registradas</h3>";
                    }
                ?>
			</div>
		</main>
		
		<?php include("php/footer.php"); ?>
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
                            $("span").html(response);
                        },
                        error: function(xhr, status, error) {
                            $("span").html(xhr.responseText);
                        }
                    });
                });
            });
        </script>
	</body>
</html>
<?php } ?>
