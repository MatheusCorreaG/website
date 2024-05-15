<?php

require_once "conexaoMysql.php";
$pdo = mysqlConnect();

// Resgata os dados da mensagem de contato
$nome = $_POST["Nome"] ?? "";
$email = $_POST["email"] ?? "";
$Telefone = $_POST['Telefone'] ?? "";
$duvida = $_POST['duvida'];
$datahora = date('Y-m-d H:i:s');



$sql = <<<SQL
  INSERT INTO contato 
    (nome, email, telefone, mensagem, dataHora)
                  
  VALUES (?, ?, ?, ?, ?)
  SQL;

try {
  $pdo->beginTransaction();

  $stmt = $pdo->prepare($sql);
  if (!$stmt->execute([$nome, $email, $Telefone, $duvida, $datahora]))
    throw new Exception('Falha na primeira inserção');

  // Efetiva as operações
  $pdo->commit();

  header("location: contato.html");
  exit();
} catch (Exception $e) {
  $pdo->rollBack();
  exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}