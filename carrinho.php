<?php
include('php/navbar.php');
if (!isset($_SESSION['id'])){
    header('location:index.php');
}else{
    include'./php/conecta.php';
    $id = $_SESSION['id'];
    $script_carrinho = $conn->prepare("SELECT * FROM tb_carrinho WHERE id_user = '$id'");
    $script_carrinho->execute();
    
    $script_produtos = $conn->prepare("SELECT * FROM tb_products");
    $script_produtos->execute();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/carrinho.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="js/jquery-3.6.0.min.js"></script>
    <title>Meu carrinho</title>
</head>
<body>
    <div class="card">
        <div class="logo-space">
            <a class="logo" href="index.php"><img src="img/logo.png " alt="logo"></a>
            <h3 class="title">Meu carrinho</h3>
        </div>
        <div class="itens-carrinho">
            <?php
                // Verificação se tem produtos
                if ($script_carrinho->rowCount() > 0){  
                    foreach($script_carrinho as $item){
                        //puxar produto
                        $id_produto = $item['id_produto'];
                        $id_carrinho = $item['id'];
                        $script_produtos = $conn->prepare("SELECT * FROM tb_products WHERE id='$id_produto'");
                        $script_produtos->execute();
                        $produto = $script_produtos->fetch(PDO::FETCH_ASSOC);
            ?>
                <div class="item">
                    <div class="image-item">
                        <img src="img/<?php echo $produto['img_1'];?>" alt = "product image" class="imgr">
                    </div>
                    <div class="info-item">
                        <div class="base-product">
                            <h3 style="color: white;"><?php echo $produto['nm_produto'];?></h3>
                            <h3 class="preco"style="color: #007F00;">R$ <?php echo $produto['vl_produto'];?></h3>
                        </div>
                        <div class="action-product">
                            <div class="quant-space">
                                <button class="btn decrementButton" data-id-produto="<?php echo $produto['id'];?>"><i class="fas fa-minus"></i></button>
                                <input type="number" id="quant" value="<?php echo $item['nr_quant'];?>">
                                <button class="btn incrementButton" data-id-produto="<?php echo $produto['id'];?>"><i class="fas fa-plus"></i></i></button>
                            </div>
                            <div class="button-delete">
                                <a href="php/delete_carrinho.php?id=<?php echo $id_carrinho;?>"><i class="fas fa-trash"></i></a> 
                            </div>
                        </div>
                    </div>
                </div>
            <?php         
                    }
                }else{
                    echo "<h2 class='title' id='resp_carrinho'>Não há produtos no seu carrinho!</h2>";
                }
            ?>
        </div>
        <div class="info-carrinho">
            <h2 class="total title"></h2>
            <button class="final-button">Finalizar compra</button>
        </div>
    </div>

    <script>
        $(document).ready(function() {
    $('.incrementButton').click(function() {
        var id_produto = $(this).data('id-produto');
        updateNumber('increment', id_produto, $(this));
    });

    $('.decrementButton').click(function() {
        var id_produto = $(this).data('id-produto');
        updateNumber('decrement', id_produto, $(this));
    });


    function updateNumber(action, id_produto, button) {
        var quant = parseInt(button.closest('.action-product').find('#quant').val()); // Parse para inteiro
        $.ajax({
            url: 'php/update_quant.php?id='+ id_produto,
            method: 'POST',
            data: { action: action, number: quant },
            success: function(response) {
                button.closest('.action-product').find('#quant').val(response);
                calcularTotal();
            }
        });
    }

    function calcularTotal() {
        var total = 0;
        $('.info-item').each(function() {
            var preco = parseFloat($(this).find('.preco').text().replace('R$', '').trim());
            var quantidade = parseInt($(this).find('#quant').val());
            total += preco * quantidade;
        });
        $('.total').text('Total: R$' + total.toFixed(2)); // Atualiza o elemento HTML com o novo total
    }

    calcularTotal();
});
    </script>
</body>
</html>
<?php }?>
