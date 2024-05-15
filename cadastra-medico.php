<?php

require_once "conexaoMysql.php";
$pdo = mysqlConnect();

// Resgata os dados do funcionario
$Nome = $_POST["Nome"] ?? "";
$Especialidade = $_POST["Especialidade"] ?? "";
$CRM = $_POST["CRM"] ?? "";

$sql = <<<SQL
  INSERT INTO medico 
    (nome, especialidade, crm)
                  
  VALUES (?, ?, ?)
  SQL;

try {
  $pdo->beginTransaction();
  $stmt = $pdo->prepare($sql);
  if (!$stmt->execute([$Nome, $Especialidade, $CRM]))
    throw new Exception('Falha na primeira inserção');

  $pdo->commit();
  header("location: CadastroMedico.html");
  exit();
} catch (Exception $e) {
  $pdo->rollBack();
  exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}
