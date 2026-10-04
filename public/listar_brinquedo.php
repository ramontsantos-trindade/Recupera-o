<?php
require "../infra/conexao.php";

$sql = "SELECT id, nome, faixa_etaria, categoria, preco, quantidade
        FROM Brinquedos
        ORDER BY id DESC";
$resultado = mysqli_query($conexao, $sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brinquedos Cadastrados</title>
    <link rel="stylesheet" href="../style/styles.css">
</head>
<body>
<header>
    <h1>Recuperação_brinquedos</h1>
</header>

<main>
    <h2>Brinquedos Cadastrados</h2>
    <a href="../index.php">+ Novo brinquedo</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Faixa etária</th>
            <th>Categoria</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th>Ações</th>
        </tr>

        <?php if ($resultado && mysqli_num_rows($resultado) > 0) { ?>
            <?php while ($b = mysqli_fetch_assoc($resultado)) { ?>
                <tr>
                    <td><?php echo $b["id"]; ?></td>
                    <td><?php echo htmlspecialchars($b["nome"]); ?></td>
                    <td><?php echo htmlspecialchars($b["faixa_etaria"]); ?></td>
                    <td><?php echo htmlspecialchars($b["categoria"]); ?></td>
                    <td>R$ <?php echo number_format($b["preco"], 2, ",", "."); ?></td>
                    <td><?php echo $b["quantidade"]; ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $b["id"]; ?>">Editar</a>
                        <a href="excluir_brinquedo.php?id=<?php echo $b["id"]; ?>"
                           onclick="return confirm('Excluir este brinquedo?');">Excluir</a>
                    </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="7">Nenhum brinquedo cadastrado.</td>
            </tr>
        <?php } ?>
    </table>
</main>
</body>
</html>