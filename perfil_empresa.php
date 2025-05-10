<?php
include 'conexao.php';

// Verifica se há dados salvos
$sql = "SELECT * FROM empresa_perfil LIMIT 1";
$result = $conn->query($sql);
$empresa = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $cnpj = $_POST['cnpj'];
    $ie = $_POST['ie'];

    if ($empresa) {
        // Atualizar
        $sql = "UPDATE empresa_perfil SET nome=?, cnpj=?, ie=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $nome, $cnpj, $ie, $empresa['id']);
    } else {
        // Inserir
        $sql = "INSERT INTO empresa_perfil (nome, cnpj, ie) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nome, $cnpj, $ie);
    }

    if ($stmt->execute()) {
        header("Location: perfil_empresa.php?sucesso=1");
        exit();
    } else {
        echo "Erro ao salvar os dados.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Perfil da Empresa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<?php include 'navbar.php'; ?>

<h3>Perfil da Empresa (usuária do sistema)</h3>

<?php if (isset($_GET['sucesso'])): ?>
  <div class="alert alert-success">Dados salvos com sucesso!</div>
<?php endif; ?>

<form method="post" class="mt-3">
  <div class="mb-3">
    <label for="nome" class="form-label">Nome da Empresa</label>
    <input type="text" class="form-control" name="nome" id="nome" required value="<?= $empresa['nome'] ?? '' ?>">
  </div>

  <div class="mb-3">
    <label for="cnpj" class="form-label">CNPJ</label>
    <input type="text" class="form-control" name="cnpj" id="cnpj" required value="<?= $empresa['cnpj'] ?? '' ?>">
  </div>

  <div class="mb-3">
    <label for="ie" class="form-label">Inscrição Estadual (IE)</label>
    <input type="text" class="form-control" name="ie" id="ie" required value="<?= $empresa['ie'] ?? '' ?>">
  </div>

  <button type="submit" class="btn btn-primary">Salvar</button>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
