<?php

require_once "conexaoMysql.php";

// conecta ao servidor do MySQL
$pdo = mysqlConnect();
$nome = $_GET["nome"] ?? "";

$sql = <<<SQL
    SELECT sexo, telefone, email FROM paciente where nome = ?
   SQL;

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome]);
    $pacientes = $stmt->fetchAll(PDO::FETCH_OBJ);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($pacientes);

} catch (Exception $e) {
    exit('Falha inesperada: ' . $e->getMessage());
}
