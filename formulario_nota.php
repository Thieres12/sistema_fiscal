<?php include 'conexao.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Criar Nota</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script>
    function adicionarProduto() {
      const container = document.getElementById('produtos');
      const produtoHTML = `
        <div class="row mb-2">
          <div class="col"><input name="descricao[]" class="form-control" placeholder="Descrição"></div>
          <div class="col"><input name="emb[]" class="form-control" placeholder="EMB."></div>
          <div class="col"><input name="quantidade[]" type="number" class="form-control" placeholder="Qtd."></div>
          <div class="col"><input name="valor[]" type="number" step="0.01" class="form-control" placeholder="Valor"></div>
        </div>
      `;
      container.insertAdjacentHTML('beforeend', produtoHTML);
    }
  </script>
</head>
<body class="container py-4">

    <?php include 'navbar.php'; ?>

  <h2>Criar Nota</h2>

  <form action="salvar_nota.php" method="POST">
    <!-- Cliente -->
    <div class="mb-3">
      <label for="cliente_id" class="form-label">Cliente</label>
      <select name="cliente_id" class="form-select" required>
        <option value="">-- Selecione --</option>
        <?php
        $res = $conn->query("SELECT id, nome FROM clientes");
        while ($row = $res->fetch_assoc()) {
          echo "<option value='{$row['id']}'>{$row['nome']}</option>";
        }
        ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="data" class="form-label">Data</label>
      <input type="date" name="data" class="form-control" required>
    </div>

    <h5>Produtos</h5>
    <div id="produtos" class="mb-3">
      <!-- Produtos inseridos dinamicamente -->
    </div>
    <button type="button" class="btn btn-secondary mb-3" onclick="adicionarProduto()">Adicionar Produto</button>

    <button type="submit" class="btn btn-primary">Salvar Nota</button>
  </form>
</body>
</html>
