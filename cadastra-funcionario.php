<?php

require_once "conexaoMysql.php";
$pdo = mysqlConnect();

// Resgata os dados do funcionario
$nome = $_POST["Nome"] ?? "";
$email = $_POST["email"] ?? "";
$senha = $_POST["senha"] ?? "";
$estadoCivil = $_POST["EstadoCivil"] ?? "";
$datan = $_POST["dataNascimento"] ?? "";
$funcao = $_POST["Funcao"] ?? "";
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);



$sql = <<<SQL
  INSERT INTO funcionario 
    (nome, email, senhahash, estadoCivil, dataNascimento, funcao)
                  
  VALUES (?, ?, ?, ?, ?, ?)
  SQL;

try {
  $pdo->beginTransaction();

  $stmt = $pdo->prepare($sql);
  if (!$stmt->execute([$nome, $email, $senhaHash, $estadoCivil, $datan, $funcao]))
    throw new Exception('Falha na primeira inserção');

  // Efetiva as operações
  $pdo->commit();

  header("location: contato.html");
  exit();
} catch (Exception $e) {
  $pdo->rollBack();
  exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}