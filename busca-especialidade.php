<?php
require_once "conexaoMysql.php";


$pdo = mysqlConnect();
$especialidade = $_GET["especialidade"] ?? "";

$sql = <<<SQL
    SELECT distinct(especialidade) from medico
   SQL;

try {
    $stmt = $pdo->query($sql);
    $especialidades = $stmt->fetchAll(PDO::FETCH_OBJ);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($especialidades);
} catch (Exception $e) {
    exit('Falha inesperada: ' . $e->getMessage());
}