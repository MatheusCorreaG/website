<?php

require_once "conexaoMysql.php";
$pdo = mysqlConnect();

// Resgata os dados da mensagem de contato
$Medico = $_POST['Medico'] ?? "";
$Paciente = $_POST['paciente'] ?? "";
$data = $_POST['data'] ?? "";

$codMed = <<<SQL
SELECT codigo  FROM medico WHERE nome = ?
SQL;
$stmtMed = $pdo->prepare($codMed);
$stmtMed->execute([$Medico]);
$codigoMed = $stmtMed->fetch(PDO::FETCH_ASSOC);
$codigoMedico = $codigoMed['codigo'];

$codPac = <<<SQL
SELECT codigo  FROM paciente WHERE nome = ?
SQL;
$stmtPac = $pdo->prepare($codPac);
$stmtPac->execute([$Paciente]);
$codigoPct = $stmtPac->fetch(PDO::FETCH_ASSOC);
$codigoPaciente = $codigoPct['codigo'];

$sql = <<<SQL
  INSERT INTO agendamento 
    (codigoMedico, codigoPaciente, dataHora)
                  
  VALUES (?, ?, ?)
  SQL;

try {
  $pdo->beginTransaction();

  $stmt = $pdo->prepare($sql);
  if (!$stmt->execute([$codigoMedico, $codigoPaciente, $data]))
    throw new Exception('Falha na primeira inserção');

  // Efetiva as operações
  $pdo->commit();

  header("location: contato.html");
  exit();
} catch (Exception $e) {
  $pdo->rollBack();
  exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}