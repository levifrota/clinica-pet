<?php
session_start();
include_once("../classes/Conexao.php");
include_once("../classes/Utilidades.php");

if(empty($_POST['campoEmail']) || empty($_POST['campoSenha'])) {
    header("Location: ../index.html");
    exit();
}

$email = mysqli_real_escape_string($conexao, $_POST['campoEmail']);
$senha = mysqli_real_escape_string($conexao, $_POST['campoSenha']);

$query = "select * from admin where email_adm='$email' and senha_adm=md5('$senha')";

$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);

if($row == 1) {
    $_SESSION['admin'] = $email;
    header("location: ../produto/admin.php");
    exit();
}else {
    header("location: ../index.html");
}
?>