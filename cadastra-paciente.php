<?php

require_once "conexaoMysql.php";
$pdo = mysqlConnect();

// Resgata os dados do funcionario
$nome = $_POST["nome"] ?? "";
$sexo = $_POST["sexo"] ?? "";
$email = $_POST["email"] ?? "";
$telefone = $_POST["telefone"] ?? "";

$sql = <<<SQL
  INSERT INTO paciente 
    (nome, sexo, email, telefone)
                  
  VALUES (?, ?, ?, ?)
  SQL;

try {
  $pdo->beginTransaction();
  $stmt = $pdo->prepare($sql);
  if (!$stmt->execute([$nome, $sexo, $email, $telefone]))
    throw new Exception('Falha na primeira inserção');

  $pdo->commit();
  header("location: CadastroPaciente.html");
  exit();
} catch (Exception $e) {
  $pdo->rollBack();
  exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}
