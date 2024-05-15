<?php

require_once "conexaoMysql.php";
$pdo = mysqlConnect();

// Resgata os dados da mensagem de contato
$email = $_POST['email'] ?? "";
$senha = $_POST['senha'] ?? "";


$codFunc = <<<SQL
SELECT senhahash  FROM funcionario WHERE email = ?
SQL;
$stmtFunc = $pdo->prepare($codFunc);
$stmtFunc->execute([$email]);
$codigoFunc = $stmtFunc->fetch(PDO::FETCH_ASSOC);
$senhaFuncionario = $codigoFunc['senhahash'];



$resultado = password_verify($senha, $senhaFuncionario);
header('Content-type: application/json');
echo json_encode(array("success" => $resultado));
