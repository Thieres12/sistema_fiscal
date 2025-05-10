<?php
include 'conexao.php';
include 'navbar.php';

// Buscar todas as notas
$sql = "SELECT * FROM notas ORDER BY data DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Notas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
  #notaContent {
    font-family: Arial, sans-serif;
    width: 100%;
    background: white;
  }
  #notaContent table {
    font-size: 14px;
  }
  @media print {
    body * {
      visibility: hidden;
    }
    #notaContent, #notaContent * {
      visibility: visible;
    }
    #notaContent {
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
    }
  }
</style>

</head>
<body>

<div class="container mt-4">
    <h2>Lista de Notas</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Data</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($nota = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $nota['id']; ?></td>
                    <td><?php echo $nota['cliente_id']; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($nota['data'])); ?></td>
                    <td>
                        <!-- Botão para abrir o modal -->
                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#notaModal" data-id="<?= $nota['id'] ?>">Ver Detalhes</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="notaModal" tabindex="-1" aria-labelledby="notaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content p-4" id="notaContent">
      <h5 class="text-center mb-3">PEDIDO <span id="notaData">25/03/2025</span></h5>

      <div class="mb-3">
        <strong>VJD COM. DE PROD. ALIMENTICIOS LTDA</strong><br>
        <span>CNPJ: <span id="empresaCNPJ">27.489.212/0001-30</span></span> |
        <span>IE: <span id="empresaIE">374.085.518.113</span></span>
      </div>

      <div class="mb-3">
        <strong>DESTINATÁRIO:</strong> <span id="clienteNome">PIZZARIA SUPREME (ANDRE)</span><br>
        <span>CNPJ: <span id="clienteCNPJ">17.219.372/0001-06</span></span> |
        <span>IE: <span id="clienteIE">513.065.110.113</span></span>
      </div>

      <table class="table table-bordered">
        <thead>
          <tr>
            <th>DESCRIÇÃO</th>
            <th>EMB.</th>
            <th>QTDE</th>
            <th>VALOR</th>
            <th>TOTAL</th>
          </tr>
        </thead>
        <tbody id="produtosNota">
          <!-- Linhas dos produtos inseridas via JavaScript/PHP -->
        </tbody>
      </table>

      <div class="text-end mb-3">
        <strong>TOTAL:</strong> <span id="valorTotal">13.502,25 R$</span>
      </div>

      <div class="mt-5">
        <p><strong>ASSINATURA CONFERENTE</strong></p>
        <hr style="width: 200px;">
      </div>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Carregar os detalhes da nota no modal
document.addEventListener('DOMContentLoaded', function () {
    var notaModal = document.getElementById('notaModal');
    notaModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var notaId = button.getAttribute('data-id');

        // Buscar os detalhes da nota
        fetch('detalhes_nota.php?id=' + notaId)
            .then(response => response.text())
            .then(data => {
                document.getElementById('notaDetalhes').innerHTML = data;
            });
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const notaModal = document.getElementById('notaModal');
  notaModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const notaId = button.getAttribute('data-id');

    fetch('detalhes_nota.php?id=' + notaId)
      .then(res => res.json())
      .then(data => {
        // Dados da empresa e cliente
        document.getElementById('notaData').innerText = data.nota.data_formatada;
        document.getElementById('empresaCNPJ').innerText = data.empresa.cnpj;
        document.getElementById('empresaIE').innerText = data.empresa.ie;
        document.getElementById('clienteNome').innerText = data.cliente.nome;
        document.getElementById('clienteCNPJ').innerText = data.cliente.cnpj;
        document.getElementById('clienteIE').innerText = data.cliente.ie;
        document.getElementById('valorTotal').innerText = data.nota.total_formatado;

        // Produtos
        const corpo = document.getElementById('produtosNota');
        corpo.innerHTML = '';
        data.produtos.forEach(p => {
          corpo.innerHTML += `
            <tr>
              <td>${p.descricao}</td>
              <td>${p.embalagem}</td>
              <td>${p.quantidade}</td>
              <td>R$ ${p.valor_unitario_formatado}</td>
              <td>R$ ${p.total_formatado}</td>
            </tr>`;
        });
      });
  });
});
</script>


</body>
</html>
