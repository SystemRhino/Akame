<?php
if($_POST['nome'] == "" or $_POST['telefone'] == "" or $_POST['telefone'] == "" or $_POST['numero'] == "" or $_POST['bairro'] == "" or $_POST['cidade'] == "" or $_POST['estado'] == "" or $_POST['cep'] == "" or $_POST['complemento'] == ""){
    echo "erro";
}else{
    session_start();
    include'conecta.php';
    date_default_timezone_set('America/Sao_Paulo');
    $date = date('Y-m-d H:i');
    $id = $_SESSION['id'];
    $script_carrinho = $conn->prepare("SELECT * FROM tb_carrinho WHERE id_user = '$id'");
    $script_carrinho->execute();
    $text_produtos = "";
    $soma = 0;

    while ($carrinho = $script_carrinho->fetch(PDO::FETCH_ASSOC)){
        $id_produto = $carrinho['id_produto'];
        $script_produtos = $conn->prepare("SELECT * FROM tb_products WHERE id='$id_produto'");
        $script_produtos->execute();
        $produto = $script_produtos->fetch(PDO::FETCH_ASSOC);
        $soma = $soma+$produto['vl_produto'];

        $text_produtos = $text_produtos.$produto['nm_produto']." - R$".$produto['vl_produto']."%0A";
    }

    $text_link = "
    Confira o pedido:
    Pedido N xxx - Akame
    ---------------------------------------
    ".$text_produtos."
    Frete: A Combinar - R$0,00 até 10 dia(s) úteis
    Total: R$ ".$soma." 
    --------------------------------------- 

    Informações do cliente
    Nome: ".$_POST['nome']."
    Contato: ".$_POST['telefone']." 
    Pagamento: PIX

    Endereço de entrega:
    ".$_POST['telefone'].", ".$_POST['numero']."
    ".$_POST['bairro']."
    ".$_POST['cidade']." /".$_POST['estado']."
    ".$_POST['estado']."
    ".$_POST['complemento']."

    Pedido gerado ".$date;
    $stringCorrigida = str_replace('
    ', '%0A', $text_link);
    $stringCorrigida = str_replace(' ', '%20', $stringCorrigida);

    echo "https://wa.me/5513996217238?text=".$stringCorrigida;
}
?>