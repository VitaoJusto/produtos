<?php
include("conexao.php");

$nome = $preco = $descricao = "";
$editar = false;
$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST['nome']);
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];
    $id = $_POST['id'] ?? '';

    // Verifica se já existe o nome
    if (!empty($id)) {
        $verifica = $conn->prepare("SELECT id FROM produtos WHERE nome = ? AND id != ?");
        $verifica->bind_param("si", $nome, $id);
    } else {
        $verifica = $conn->prepare("SELECT id FROM produtos WHERE nome = ?");
        $verifica->bind_param("s", $nome);
    }

    $verifica->execute();
    $verifica->store_result();

    if ($verifica->num_rows > 0) {
        $erro = "Produto com esse nome já está cadastrado.";
    } else {
        // Não existe duplicado — salva no banco
        if (!empty($id)) {
            $sql = "UPDATE produtos SET nome=?, preco=?, descricao=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sdsi", $nome, $preco, $descricao, $id);
        } else {
            $sql = "INSERT INTO produtos (nome, preco, descricao) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sds", $nome, $preco, $descricao);
        }

        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            $erro = "Erro ao salvar produto: " . $stmt->error;
        }
    }
} elseif (isset($_GET['id'])) {
    $editar = true;
    $id = $_GET['id'];
    $sql = "SELECT * FROM produtos WHERE id = $id";
    $res = $conn->query($sql);
    $dados = $res->fetch_assoc();
    $nome = $dados['nome'];
    $preco = $dados['preco'];
    $descricao = $dados['descricao'];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= isset($id) ? "Editar Produto" : "Cadastrar Produto" ?></title>
    <link rel="stylesheet" href="estilo.css">
    <style>
        .erro {
            color: red;
            margin-bottom: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2><?= isset($id) ? "Editar Produto" : "Cadastrar Produto" ?></h2>

    <?php if (!empty($erro)): ?>
        <div class="erro"><?= $erro ?></div>
    <?php endif; ?>

    <form action="formulario.php" method="POST">
        <input type="hidden" name="id" value="<?= $id ?? '' ?>">

        <label>Nome:</label><br>
        <input type="text" name="nome" value="<?= htmlspecialchars($nome) ?>" required><br><br>

        <label>Preço:</label><br>
        <input type="number" name="preco" step="0.01" value="<?= htmlspecialchars($preco) ?>" required><br><br>

        <label>Descrição:</label><br>
        <textarea name="descricao"><?= htmlspecialchars($descricao) ?></textarea><br><br>

        <input type="submit" value="<?= isset($id) ? "Atualizar" : "Cadastrar" ?>">
        <a href="index.php" class="botao">Cancelar</a>
    </form>
</body>
</html>
