<?php

require_once "conexaoMysql.php";
$pdo = mysqlConnect();

try {
  $sql = <<<SQL
    SELECT * FROM funcionario
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
  <title> Listagem Funcionarios</title>

  <!-- 2: Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <h3>Dados da tabela <b>funcionarios</b></h3>
    <table class="table table-striped table-hover">
      <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Senha hash</th>
        <th>Estado civil</th>
        <th>Data de nascimento</th>
        <th>Função</th>
      </tr>
      <?php
      while ($row = $stmt->fetch()) 
      {
        $nome = htmlspecialchars($row['nome']);
        $email = htmlspecialchars($row['email']);
        $hash_senha = htmlspecialchars($row['senhahash']);
        $estado_civil = htmlspecialchars($row['estadoCivil']);
        $data_nascimento = htmlspecialchars($row['dataNascimento']);
        $funcao = htmlspecialchars($row['funcao']);
        

        echo <<<HTML
        <tr>
          <td>$nome</td> 
          <td>$email</td>
          <td>$hash_senha</td>
          <td>$estado_civil</td>
          <td>$data_nascimento</td>
          <td>$funcao</td>
        </tr>      
        HTML;
      }
      ?>
    </table>
    <p><a href="restrito.html">Menu de opções</a></p>
  </div>

</body>

</html>