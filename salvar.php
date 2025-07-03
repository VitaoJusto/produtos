<?php
include("conexao.php");

$nome = trim($_POST['nome']);
$preco = $_POST['preco'];
$descricao = $_POST['descricao'];

if (!empty($_POST['id'])) {
    // Atualização
    $id = $_POST['id'];

    // Verifica se o novo nome já existe para outro ID
    $verifica = $conn->prepare("SELECT id FROM produtos WHERE nome = ? AND id != ?");
    $verifica->bind_param("si", $nome, $id);
    $verifica->execute();
    $verifica->store_result();

    if ($verifica->num_rows > 0) {
        echo "Já existe outro produto com esse nome.";
        echo "<br><a href='formulario.php?id=$id'>Voltar</a>";
        exit();
    }

    $sql = "UPDATE produtos SET nome=?, preco=?, descricao=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdsi", $nome, $preco, $descricao, $id);
} else {
    // Inserção

    // Verifica se já existe o nome
    $verifica = $conn->prepare("SELECT id FROM produtos WHERE nome = ?");
    $verifica->bind_param("s", $nome);
    $verifica->execute();
    $verifica->store_result();

    if ($verifica->num_rows > 0) {
        echo "Produto com esse nome já existe.";
        echo "<br><a href='formulario.php'>Voltar</a>";
        exit();
    }

    $sql = "INSERT INTO produtos (nome, preco, descricao) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sds", $nome, $preco, $descricao);
}

if ($stmt->execute()) {
    header("Location: index.php");
    exit();
} else {
    echo "Erro: " . $stmt->error;
}
?>

