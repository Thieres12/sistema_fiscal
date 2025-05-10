<?php
include 'conexao.php';

$id = $_GET['id'] ?? 0;

// Nota
$sql = "SELECT * FROM notas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$nota = $stmt->get_result()->fetch_assoc();
$nota['data_formatada'] = date('d/m/Y', strtotime($nota['data']));

// Cliente
$cliente = $conn->query("SELECT * FROM clientes WHERE id = {$nota['cliente_id']}")->fetch_assoc();

// Empresa usuária
$empresa = $conn->query("SELECT * FROM empresa_perfil LIMIT 1")->fetch_assoc();

// Produtos
$stmt = $conn->prepare("SELECT * FROM produtos_nota WHERE nota_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();

$produtos = [];
$total = 0;

while ($p = $res->fetch_assoc()) {
  $totalProduto = $p['quantidade'] * $p['valor_unitario'];
  $produtos[] = [
    'descricao' => $p['descricao'],
    'embalagem' => $p['emb'],
    'quantidade' => $p['quantidade'],
    'valor_unitario_formatado' => number_format($p['valor_unitario'], 2, ',', '.'),
    'total_formatado' => number_format($totalProduto, 2, ',', '.')
  ];
  $total += $totalProduto;
}

$nota['total_formatado'] = number_format($total, 2, ',', '.');

header('Content-Type: application/json');
echo json_encode([
  'nota' => $nota,
  'cliente' => $cliente,
  'empresa' => $empresa,
  'produtos' => $produtos
]);

