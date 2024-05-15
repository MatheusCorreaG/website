<?php
require_once "conexaoMysql.php";

// conecta ao servidor do MySQL
$pdo = mysqlConnect();
$paciente = $_GET["paciente"] ?? "";

$sql = <<<SQL
    SELECT nome FROM paciente
   SQL;

try {
    $stmt = $pdo->query($sql);
    $pacientes = $stmt->fetchAll(PDO::FETCH_OBJ);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($pacientes);
} catch (Exception $e) {
    exit('Falha inesperada: ' . $e->getMessage());
}
