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
    <title>Gerenciar Produtos</title>
</head>
<body>

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
                    <button  onclick="window.location.href = 'php/delete_user.php?id=<?php echo $user['id'];?>'">Excluir</button>
                    <button onclick="window.location.href = 'edit_user.php?id=<?php echo $user['id'];?>'">Editar</button>
                </td>
            </tr>
    <?php }?>
</table>
</body>
</html>
<?php }?>