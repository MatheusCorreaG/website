<?php

require_once "conexaoMysql.php";

// conecta ao servidor do MySQL
$pdo = mysqlConnect();
$especialidade = $_GET["especialidade"] ?? "";

$sql = <<<SQL
    SELECT nome from medico where especialidade = ?
   SQL;

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$especialidade]);
    $medicos = $stmt->fetchAll(PDO::FETCH_OBJ);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($medicos);

} catch (Exception $e) {
    exit('Falha inesperada: ' . $e->getMessage());
}
