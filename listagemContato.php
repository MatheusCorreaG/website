<?php

require_once "conexaoMysql.php";
$pdo = mysqlConnect();

try {
  $sql = <<<SQL
    SELECT * FROM contato
  SQL;

  $stmt = $pdo->query($sql);
} 
catch (Exception $e) {
  exit('Falha ao executar SQL: ' . $e->getMessage());
}

?>
<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <!-- 1: Tag de responsividade -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Listagem mensagens</title>

  <!-- 2: Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <h3>Dados da tabela <b>mensagem de contato</b></h3>
    <table class="table table-striped table-hover">
      <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Telefone</th>
        <th>Mensagem</th>
        <th>Data</th>
      </tr>
      <?php
      while ($row = $stmt->fetch()) 
      {
        $nome = htmlspecialchars($row['nome']);
        $email = htmlspecialchars($row['email']);
        $telefone = htmlspecialchars($row['telefone']);
        $duvida = htmlspecialchars($row['mensagem']);
        $datahora = htmlspecialchars($row['dataHora']);

        echo <<<HTML
        <tr>
          <td>$nome</td> 
          <td>$email</td>
          <td>$telefone</td>
          <td>$duvida</td>
          <td>$datahora</td>
        </tr>      
        HTML;
      }
      ?>
    </table>
    <p><a href="restrito.html">Menu de opções</a></p>
  </div>

</body>

</html>