<?php
include 'conexao.php';
include 'navbar.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'] ?? '';
    $cnpj = $_POST['cnpj'] ?? '';
    $ie = $_POST['ie'] ?? '';
    $endereco = $_POST['endereco'] ?? '';
    $telefone = $_POST['telefone'] ?? '';

    // Validação simples
    if (empty($nome) || empty($cnpj) || empty($ie) || empty($endereco) || empty($telefone)) {
        echo "<div class='alert alert-danger'>Todos os campos são obrigatórios.</div>";
    } else {
        // Inserir dados no banco
        $sql = "INSERT INTO clientes (nome, cnpj, ie, endereco, telefone) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $nome, $cnpj, $ie, $endereco, $telefone);
        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Cliente cadastrado com sucesso!</div>";
        } else {
            echo "<div class='alert alert-danger'>Erro ao cadastrar cliente.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2>Cadastrar Novo Cliente</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome da Empresa</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>

        <div class="mb-3">
            <label for="cnpj" class="form-label">CNPJ</label>
            <input type="text" class="form-control" id="cnpj" name="cnpj" required>
        </div>

        <div class="mb-3">
            <label for="ie" class="form-label">Inscrição Estadual (IE)</label>
            <input type="text" class="form-control" id="ie" name="ie" required>
        </div>

        <div class="mb-3">
            <label for="endereco" class="form-label">Endereço</label>
            <input type="text" class="form-control" id="endereco" name="endereco" required>
        </div>

        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="telefone" name="telefone" required>
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar Cliente</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
