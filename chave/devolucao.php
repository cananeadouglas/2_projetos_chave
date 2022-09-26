<!DOCTYPE html>
<html>
<head>
  <title>DEVOLUÇÃO</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php
include "cabeca.php";
?>

  <section class="euaqui">
    <div class="form-group">
      <form action="" method="POST" name="rege">
        <h3 align="center">REGISTRAR DEVOLUÇÃO</h3>

        <label>QR-Code Chave Fornecida - (devolver)</label>
        <input class="form-control" name="codigo" id="ex1" type="password" autofocus="true" placeholder="Registro QR-Code" required="required"><br>

        <label>Funcionário / Promotor - (quem está entregando)</label>
        <input class="form-control" name="funcionario" id="ex3" type="password" placeholder="bipe seu código de barra no verso do cartão" required="required"><br>

        <label>PREVENÇÃO / PORTARIA</label>
        <input class="form-control" name="prevencao" id="ex3" type="password" placeholder="bipe sua matricula no cartão" required="required"><br>
                
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

if (!isset($_POST['funcionario']) || !isset($_POST['codigo']) || !isset($_POST['prevencao'])) {
  echo " ";
}else{

  include "connection.php";

  $chave = $_POST['codigo'];
  $fun_pro = $_POST['funcionario'];
  $prev = $_POST['prevencao'];

  // id_user
  $sql1 = "SELECT id_user FROM usuario WHERE matricula = '$fun_pro';";
  $result1 = mysqli_query($conn, $sql1);
  $fetch1 = mysqli_fetch_assoc($result1);
  $fetch1 = array_shift($fetch1);
  $id_user = $fetch1; // id do usuário

  // nome
  $sql1 = "SELECT nomef FROM usuario WHERE matricula = '$fun_pro';";
  $result1 = mysqli_query($conn,$sql1);
  $fetch1 = mysqli_fetch_assoc($result1);
  $fetch1 = array_shift($fetch1);
  $nomefA = $fetch1; // nome do usuário

  $sql1 = "SELECT nomef FROM prevencao WHERE matricula = '$prev';";
  $result1 = mysqli_query($conn, $sql1);
  $fetch1 = mysqli_fetch_assoc($result1);
  $fetch1 = array_shift($fetch1);
  $nomefP = $fetch1; // nome do usuário

  if($id_user == 0 || !isset($nomefP)){ //recuperando id_user na tabela usuario

    echo"<script language='javascript' type='text/javascript'>
    alert('USUÁRIO NÃO RECONHECIDO PELO SISTEMA, indique outro código de barra');window.location.href='devolucao.php';</script>";

  }else{

    if ($chave == 0){

      echo "$id_key";
      echo"<script language='javascript' type='text/javascript'>
    alert('CHAVE NÃO RECONHECIDO PELO SISTEMA, indique outro código de barra');window.location.href='devolucao.php';</script>";

    }else{

      // recuperando i id_reg através do id_key e info retirada, window.location.href='devolucao.php
      $sql5 = "SELECT id_reg FROM registros WHERE id_key = '$chave' and info = 'retirada';";
      $result3 = mysqli_query($conn,$sql5);
      $fetch3 = mysqli_fetch_assoc($result3);
      $fetch3 = array_shift($fetch3);
      $id_reg = $fetch3; //id_reg

      if($id_reg == 0 || !isset($id_reg)){

        echo"<script language='javascript' type='text/javascript'>
        alert('Registro NÃO RECONHECIDO PELO SISTEMA, tente novamente');  ';</script>";

      }else{

        // inserir registro de saída de chave
        $sql1 = "UPDATE registros SET info = 'devolvida', data_d = '$day', hora_d = '$time', user_d = '$nomefA', prev_d = '$nomefP' where id_reg = '$id_reg'; ";
        mysqli_query($conn, $sql1) or die(mysqli_error());

        // atualizando situação da chave
        $sql2 = "UPDATE chave 
        SET situacao = 0
        WHERE id_key = '$chave'; ";
        mysqli_query($conn, $sql2) or die(mysqli_error());

        $id_key = 0;
        $id_user = 0;
        $chave = 0;
        $fun_pro = 0;
        $id_prev = 0;

        echo"<script language='javascript' type='text/javascript'>
        alert('Chave devolvida com sucesso, guarde-a junto as outras.');window.location.href='devolucao.php';</script>";


      }


    }



  }

}

?>