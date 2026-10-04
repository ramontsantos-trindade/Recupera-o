<?php
include "../infra/conexao.php";

$nome = $_POST["nome_brinquedo"];
$faixa = $_POST["faixa"];
$categoria = $_POST["categoria"];
$preco = $_POST["preco"];
$quantidade = $_POST["quantidade"];

$sql = "INSERT INTO Brinquedos (nome, faixa_etaria, preco, categoria, quantidade)VALUES (?, ?, ?, ? ,?)";

$stmt = mysqli_prepare ($conexao, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, 
    "ssdsi", 
    $nome, 
    $faixa, 
    $preco, 
    $categoria, 
    $quantidade
);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

}

header("Location: listar_brinquedo.php");
exit();

?>

