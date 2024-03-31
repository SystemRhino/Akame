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

		// Exibe todos os produtos
        $sql = "SELECT * FROM tb_products ORDER BY id DESC";
        $consulta_produto = $conn->prepare($sql);
        $consulta_produto->execute();
        $produtos = $consulta_produto->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
	<head>
		<!-- LINK CSS -->
		<link rel="stylesheet" type="text/css" href="css/navbar.css">
		<link rel="stylesheet" type="text/css" href="css/gestao_loja.css">
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
				<div class="title">
                    Adicionar produto
                </div>
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
                        <select id="categoria" name="id_categoria">
                        <option disabled selected>Selecione uma categoria</option>
                        <?php 
                            while ($categoria = $script_categoria->fetch(PDO::FETCH_ASSOC)) {?>	
                                <option value="<?php echo $categoria['id']?>"><?php echo $categoria['nm_categoria']?></option>
                        <?php }?>
                        <option value="nova_categoria"><i class="fas fa-plus"></i> Criar nova categoria</option>
                        </select>
                    </div>
                    <div class="row button">
                        <button type="submit" id="enviar" class="btn-join">Enviar</button>
                    </div>
                </form>
                <span style="color: white;"></span>
			</div>
			<div class="list-product">
				<?php
                    if(!isset($produtos)){
                        echo "<h3>Não há produtos a serem exibidos</h3>";
                    }else{
                        foreach ($produtos as $produto) {?>
                            <div class="product">
                                <div class="product-image">
                                    <img src="img/<?php echo $produto['img_1'];?>" data-other="img/<?php echo $produto['img_2'];?>" onclick="window.location.href='adm_produto.php?id=<?php echo $produto['img_1'];?>'">
                                </div>
                                <div class="product-content">
                                    <h3>R$ <?php echo $produto['vl_produto'];?></h3>
                                </div>
                                <div class="product-action">
                                	<a class="btn-join" href="edit_produto.php?id=<?php echo $produto['img_1'];?>">Editar</a>
                                    <a href="php/delete_produto.php?id=<?php echo $produto['id'];?>"><i class="fas fa-trash"></i></a>
                                </div>
                            </div>
                    <?php
                        }
                    }
                ?>
			</div>
		</main>
		
		<?php include("php/footer.php"); ?>
    	<script>
            $(document).ready(function() {
                // Função para trocar as imagens ao passar o mouse
                $('.product-image img').hover(function() {
                    var temp = $(this).attr('src');
                    $(this).attr('src', $(this).attr('data-other'));
                    $(this).attr('data-other', temp);
                });

                $('#categoria').change(function() {
                    var selecionado = $(this).val();
                    if (selecionado === "nova_categoria") {
                        window.location.href = "gestao_categ.php";
                    }
                });

                // Função para enviar o formulário via AJAX
                $('#form_produto').submit(function(event) {
                    event.preventDefault();
                    var form_data = new FormData(this);

                    $.ajax({
                        url: 'php/script_produto.php', 
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
<?php } ?>
