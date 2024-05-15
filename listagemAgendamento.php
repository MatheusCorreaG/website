<?php

require_once "conexaoMysql.php";
$pdo = mysqlConnect();

try {

  $sql = <<<SQL
  SELECT a.dataHora horario, b.especialidade, b.nome nomeMedico, c.nome nomePaciente, c.sexo, c.email, c.telefone
  FROM agendamento a INNER JOIN medico b ON a.codigoMedico = b.codigo INNER JOIN paciente c on a.codigoPaciente = c.codigo
  SQL;


  $stmt = $pdo->query($sql);
} catch (Exception $e) {
  exit('Ocorreu uma falha: ' . $e->getMessage());
}
?>
<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <!-- 1: Tag de responsividade -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lista de agendamentos</title>

  <!-- 2: Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

  <style>
    body {
      padding-top: 2rem;
    }
  </style>
</head>

<body>

  <div class="container">
    <h3>Pacientes e seus agendamentos</h3>
    <table class="table table-striped table-hover">
      <tr>
        <th>Especialidade</th>
        <th>Médico</th>
        <th>Paciente</th>
        <th>Sexo</th>
        <th>Telefone</th>
        <th>Email</th>
        <th>Data</th>
      </tr>
      <?php
      while ($row = $stmt->fetch()) {
        $especialidade = htmlspecialchars($row['especialidade']);
        $medico = htmlspecialchars($row['nomeMedico']);
        $paciente = htmlspecialchars($row['nomePaciente']);
        $sexo = htmlspecialchars($row['sexo']);
        $telefone = htmlspecialchars($row['telefone']);
        $email = htmlspecialchars($row['email']);
        $datahora = htmlspecialchars($row['horario']);

        echo <<<HTML
        <tr>
          <td>$especialidade</td> 
          <td>$medico</td> 
          <td>$paciente</td>
          <td>$sexo</td>
          <td>$telefone</td>
          <td>$email</td>
          <td>$datahora</td>
        </tr>      
        HTML;
      }
      ?>
    </table>



    <a href="restrito.html">Menu de opções</a>
  </div>

</body>

</html>