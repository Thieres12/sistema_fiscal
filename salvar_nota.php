<?php
include 'conexao.php';

$cliente_id = $_POST['cliente_id'];
$data = $_POST['data'];
$descricao = $_POST['descricao'];
$emb = $_POST['emb'];
$quantidade = $_POST['quantidade'];
$valor = $_POST['valor'];

// 1. Inserir nota
$sql = "INSERT INTO notas (cliente_id, data) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $cliente_id, $data);
$stmt->execute();
$nota_id = $conn->insert_id;

// 2. Inserir produtos
for ($i = 0; $i < count($descricao); $i++) {
    if (!empty($descricao[$i])) {
        $sql = "INSERT INTO produtos_nota (nota_id, descricao, emb, quantidade, valor_unitario)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issid", $nota_id, $descricao[$i], $emb[$i], $quantidade[$i], $valor[$i]);
        $stmt->execute();
    }
}

echo "<script>alert('Nota salva com sucesso!'); window.location.href='formulario_nota.php';</script>";
?>
