<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="css/bootstrap.min.js"></script>
    <script src="css/jquery.min.js"></script>
    <link rel="stylesheet" href="css/pucha_php.css">
    <title>Cadastro funcionário / Promotor</title>
</head>
<body onload="teste()">

<?php
include "cabeca.php";
?>

  <section>
    <div class="form-group">
      <form action="" method="POST" name="rege">
        <h3 align="center">CADASTRO DE FUNCIONÁRIO / PROMOTOR</h3>

        <label>Nome Completo do Funcionário ou Promotor</label>
        <input class="form-control" name="nome" id="ex1" autofocus="true" type="text" placeholder="Digite nome Completo" required="required"><br>

        <label>Empresa de Origem</label>
        <input class="form-control" name="empresa" id="ex1" autofocus="true" type="text" placeholder="Atacadão ou nome da empresa" required="required"><br>

        <label>Leitor do Cartão/Crachá de Identificação</label>
        <input class="form-control" name="matricula" id="ex3" type="password" placeholder="bipe sua matricula no cartão" required="required"><br>
                
        <br><br>
        <input class="form-control" type="submit" value="Gravar Informação" >
      </form>
    </div>
</section>
<script src="script1.js"></script>

</body>
</html>

<section>
  
<?php

date_default_timezone_set('America/Recife');
$day = date('y.m.d');
$time = date('H:i:s');

if (!isset($_POST['chave']))
{
  echo " ";
}
else
{
  
  include "connection.php";

  $matricula = $_POST['matricula'];
  $nome = $_POST['nome'];
  $empresa = $_POST['empresa'];

// recuperando id_user na tabela usuario
  $sql2 = "SELECT id_user FROM usuario WHERE matricula = '$matricula'";
  $result2 = mysqli_query($conn, $sql2);
  $fetch2 = mysqli_fetch_assoc($result2);
  $fetch2 = array_shift($fetch2);
  $id_user = $fetch2;

  if($id_user >= 1){
    
    echo"<script language='javascript' type='text/javascript'>
    alert('Funcionário já consta no banco de dados');window.location.href='cad_func.php';</script>";

  }else if($id_user == 0){
    
    echo"<script language='javascript' type='text/javascript'>
    alert('Houve erros no sistema, tente novamente');window.location.href='cad_func.php';</script>";

  }else{

    if (!isset($id_user)){

    // inserir registro de saída de chave
    $sql1 = "INSERT INTO usuario (nomef, matricula, empresa) VALUE ('$nome', '$matricula', '$empresa'); ";
    mysqli_query($conn,$sql1) or die(mysqli_error());

    echo"<script language='javascript' type='text/javascript'>
    alert('Funcionário / Promotor Registrado com Sucesso.');window.location.href='cad_func.php';</script>";
    
    }


  }


  }

?>

</section>