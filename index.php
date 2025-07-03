<?php include("conexao.php"); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Produtos</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <h2>Produtos</h2>
    <a href="formulario.php">Novo Produto</a><br><br>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th><th>Nome</th><th>Preço</th><th>Ações</th>
        </tr>
        <?php
        $sql = "SELECT * FROM produtos";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()):
        ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['nome'] ?></td>
                <td>R$ <?= number_format($row['preco'], 2, ',', '.') ?></td>
                <td>
                    <a href="formulario.php?id=<?= $row['id'] ?>">Editar</a> |
                    <a href="excluir.php?id=<?= $row['id'] ?>" onclick="return confirm('Excluir este produto?')">Excluir</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
