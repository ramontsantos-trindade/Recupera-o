<?php
require "../infra/conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    
    $id         = (int) $_POST["id"];
    $nome       = $_POST["nome"];
    $faixa      = $_POST["faixa"];
    $categoria  = $_POST["categoria"];
    $preco      = $_POST["preco"];
    $quantidade = $_POST["quantidade"];

        $sql = "UPDATE Brinquedos
                SET nome = ?, faixa_etaria = ?, categoria = ?, preço = ?, quantidade = ?
                WHERE id = ?";

                $stmt = mysqli_prepare($conexao, $sql);
                mysqli_stmt_bind_param($stmt, "sssdii", $nome, $faixa, $categoria, $preco, $quantidade, $id);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        header("Location: listar_brinquedo.php");
        exit();
    } else {
        echo "Erro ao atualizar: " . mysqli_stmt_error($stmt);
        exit();
    }
}

$id = (int) ($_GET["id"] ?? 0);

$sql = "SELECT * FROM Brinquedos WHERE id = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$brinquedo = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
mysqli_stmt_close($stmt);

if (!$brinquedo) {
    echo "Brinquedo não encontrado. <a href='listar_brinquedo.php'>Voltar</a>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Brinquedo</title>
    <link rel="stylesheet" href="../style/styles.css">
</head>
<body>

<h1>Editar Brinquedo</h1>

<form method="POST" action="editar.php">

    <input type="hidden" name="id" value="<?php echo $brinquedo["id"]; ?>">

    Nome do brinquedo: <br>
    <input type="text" name="nome"
           value="<?php echo htmlspecialchars($brinquedo["nome"]); ?>" required><br><br>

    Faixa etária: <br>
    <input type="text" name="faixa"
           value="<?php echo htmlspecialchars($brinquedo["faixa_etaria"]); ?>" required><br><br>

    Categoria: <br>
    <input type="text" name="categoria"
           value="<?php echo htmlspecialchars($brinquedo["categoria"]); ?>" required><br><br>

    Preço: <br>
    <input type="number" step="0.01" min="0" name="preco"
           value="<?php echo $brinquedo["preco"]; ?>" required><br><br>

    Quantidade: <br>
    <input type="number" step="1" min="0" name="quantidade"
           value="<?php echo $brinquedo["quantidade"]; ?>" required><br><br>

    <button type="submit">Salvar alterações</button>
</form>

<a href="listar_brinquedo.php">Voltar</a>

</body>
</html>
}