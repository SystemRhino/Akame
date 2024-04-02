<?php
    session_start();
    if (!isset($_SESSION['id'])){
        header('location:index.php');
    }else{
        include('php/conecta.php');
        $id = $_SESSION['id'];
        $script_carrinho = $conn->prepare("SELECT * FROM tb_carrinho WHERE id_user = '$id'");
        $script_carrinho->execute();

        $script_produtos = $conn->prepare("SELECT * FROM tb_products");
        $script_produtos->execute();
        $soma = 0;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" type="text/css" href="css/checkout.css">
</head>

<!-- JS -->
<script src="js/jquery-3.6.0.min.js"></script>
<body>
    <?php include('php/navbar.php');?>
    <main>
        <h1 class="title-compra">Compra</h1>
        <div class="carrinho">
            <?php
                // Verificação se tem produtos
                if ($script_carrinho->rowCount()>0){
                    while ($carrinho = $script_carrinho->fetch(PDO::FETCH_ASSOC)) { 
                        $id_produto = $carrinho['id_produto'];
                        $id_carrinho = $carrinho['id'];
                        $script_produtos = $conn->prepare("SELECT * FROM tb_products WHERE id='$id_produto'");
                        $script_produtos->execute();
                        $produto = $script_produtos->fetch(PDO::FETCH_ASSOC);
                        $soma = $soma+ ($carrinho['nr_quant'] * $produto['vl_produto']);
            ?>
                <div class="item">
                    <div class="image-item">
                        <img src="img/<?php echo $produto['img_1'];?>" alt = "product image" class="imgr">
                    </div>
                    <div class="info-item">
                        <div class="base-product">
                            <h3 style="color: white;"><?php echo $produto['nm_produto'].' - '.$carrinho['tamanho'];?></h3>
                            <h3 class="preco"style="color: #007F00;">R$ <?php echo $produto['vl_produto'];?></h3>
                        </div>
                        <div class="action-product">
                            <div class="quant-space">
                              <h4>Quantidade: <?php echo $carrinho['nr_quant'];?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            <?php        
                    }
                }else{
                     echo "<h3 style='color: #fff;'>Sem produtos no seu carrinho</h3>";
                }
            ?>
        </div>
        <div class="containerF">
            <div class="wrapperF">
                <div class="title"> <h2>Total: R$<?php echo $soma;?></h2></div>
                <form id="form_check" class="formF">
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
                    <div class="row">
                        <select name="formPag">
                            <option value="pix">Pix</option>
                            <option value="card">Cartão de Crédito/Débito</option>
                        </select>
                    </div>
                    <span></span>
                    <div class="row button">
                        <input type="submit" value="Finalizar Compra" class="btn-join">
                    </div>
                </form>
            </div>
        </div>
    </main>
    <?php include('php/footer.php')?>
    
    <script>
        $(document).ready(function() {
            $('#form_check').submit(function(event) {
                event.preventDefault(); // Impede o envio padrão do formulário
                var form_data = new FormData(this);

                $.ajax({
                    url: 'php/zap.php', // Arquivo PHP para processar os dados
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
</body>
</html>
<?php }?>
