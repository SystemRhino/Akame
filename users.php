<?php 
session_start();
if ($_SESSION['nivel'] != 1) {
	header('location:../');
}else{
include './php/conecta.php';

//Consulta User
$script_user = $conn->prepare("SELECT * FROM tb_users");
$script_user->execute();
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
    <title>Gerenciar Produtos</title>
</head>
<body>
<?php include('php/navbar.php')?>
<div class="main">
    <aside class="left"> 
    
    </aside>

    <main>
		<!-- Tag "span" usada para retorno do ajax -->
	<span></span>



      <table>
    <tr>
        <th>#ID</th>
        <th>Nome</th>
        <th>E-mail</th>
        <th>Telefone</th>
        <th>Endereço</th>
        <th>Ações</th>
    </tr>
    <?php while ($user = $script_user->fetch(PDO::FETCH_ASSOC)) { ?>
			<tr>
				<td><?php echo $user['id']; ?></td>
                <td><?php echo $user['nm_user'];?></td>
                <td><?php echo $user['ds_login'];?></td>
                <td><?php echo $user['ds_tel'];?></td>
                <td><?php echo $user['ds_adress'];?></td>
                <td>
                    <button  onclick="window.location.href = 'php/delete_user.php?id=<?php echo $user['id'];?>'" class="btn-join">Excluir</button>
                    <button onclick="window.location.href = 'edit_user.php?id=<?php echo $user['id'];?>'" class="btn-join">Editar</button>
                </td>
            </tr>
    <?php }?>
</table>
    





    </main>
<aside class="right"></aside>
    </div>


    <?php include('php/footer.php')?>

</body>
</html>
<?php }?>