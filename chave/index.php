<!DOCTYPE html>
<html>
<head>
  <title>RETIRADA</title>
</head>
<link rel="stylesheet" href="css/style.css">
<body>

<?php
include "cabeca.php";
?>

  <section class="euaqui">
    <div class="form-group">
      <form action="" method="POST" name="rege">
        <h3 align="center">REGISTRAR RETIRADA</h3>

        <label>QR-Code Chave Fornecida</label>
        <input class="form-control" name="key1" id="ex1" autofocus="true" type="password" placeholder="Registro QR-Code" required="required"><br>

        <label>Funcionário / Promotor</label>
        <input class="form-control" name="func1" id="ex3" type="password" placeholder="bipe sua matricula no cartão" required="required"><br>

        <label>PREVENÇÃO / PORTARIA</label>
        <input class="form-control" name="funcP" id="ex3" type="password" placeholder="bipe sua matricula no cartão" required="required"><br>
                
        <br><br>
        <input class="form-control" type="submit" value="Gravar Informação" >
      </form>
    </div>
</section>
<script src="script1.js"></script>

</body>
</html>

<?php

date_default_timezone_set('America/Recife');
$day = date('y.m.d');
$time = date('H:i:s');

//echo "$day";
//echo "$time";

if (!isset($_POST['func1']))
{
  echo " ";
}
else
{
  
  include "connection.php";

  $chave = $_POST['key1'];
  $fun_pro = $_POST['func1'];
  $prev = $_POST['funcP'];

  // recuperando id_prev na tabela PREVENÇÃO
  $sql0 = "SELECT id_prev FROM prevencao WHERE matricula = '$prev'";
  $result0 = mysqli_query($conn, $sql0);
  $fetch0 = mysqli_fetch_assoc($result0);
  $fetch0 = array_shift($fetch0);
  $id_prev = $fetch0;

  if ($id_prev == 0){

    echo"<script language='javascript' type='text/javascript'>
    alert('USUÁRIO de prevenção NÃO RECONHECIDO PELO SISTEMA, indique outro código de barra');window.location.href='index.php';</script>";

  }else{

    // recuperando id_user na tabela usuario
  $sql1 = "SELECT id_user FROM usuario WHERE matricula = '$fun_pro';";
  $result1 = mysqli_query($conn, $sql1);
  $fetch1 = mysqli_fetch_assoc($result1);
  $fetch1 = array_shift($fetch1);
  $id_user = $fetch1;

  if ($id_user == 0){

    echo"<script language='javascript' type='text/javascript'>
    alert('USUÁRIO NÃO RECONHECIDO PELO SISTEMA, indique outro código de barra');window.location.href='index.php';</script>";

  }else{

      // recuperando id_key na tabela chave
      $sql2 = "SELECT id_key FROM chave WHERE codigo = '$chave' and situacao = 0;";
      $result2 = mysqli_query($conn, $sql2);
      $fetch2 = mysqli_fetch_assoc($result2);
      $fetch2 = array_shift($fetch2);
      $id_key = $fetch2;

      if (!isset($id_key) || $id_key == 0)
      {
        echo"<script language='javascript' type='text/javascript'>
        alert('Esta chave FOI RETIRADA - Consulte a lista dos registros');window.location.href='lista.php';</script>";
      }
      else{

        // atualizando situação da chave
        $sql2 = "UPDATE chave 
        SET situacao = 1
        WHERE id_key = '$id_key'; ";
        mysqli_query($conn,$sql2) or die(mysqli_error());

        // inserir registro de saída de chave
        $sql1 = "INSERT INTO registros (data_r, hora_r, id_user_r, id_key, id_prev_r, info, user_d, prev_d) 
        VALUE ('$day', '$time', '$id_user', '$id_key', '$id_prev', 'retirada', '_', '_'); ";
        mysqli_query($conn,$sql1) or die(mysqli_error());

        $id_key = 0;
        $id_user = 0;
        $chave = 0;
        $fun_pro = 0;
        $id_prev = 0;

        echo"<script language='javascript' type='text/javascript'>
        alert('Registrado com Sucesso - Entregue a chave ao Colaborador.');window.location.href='index.php';</script>";
      }


  }

  }


  







}

?>