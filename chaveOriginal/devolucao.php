<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="css/bootstrap.min.js"></script>
    <script src="css/jquery.min.js"></script>
    <link rel="stylesheet" href="css/pucha_php.css">
    <title>Devolução</title>

        <style type="text/css">
      
      section {
          background: #ffcc99;/*cor de fundo */
          border-radius: 15px;/*bordas arredondadas*/
          padding: 15px;/*espaço entre o texto e a borda*/
          margin: 0 auto;
          box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.301);/* sobreamento e cor*/
          
      }
    </style>
</head>
<body onload="teste()">

<?php
include "cabeca.php";
?>

  <section>
    <div class="form-group">
      <form action="" method="POST" name="rege">
        <h3 align="center">REGISTRAR DEVOLUÇÃO</h3>

        <label>QR-Code Chave Fornecida - (devolver)</label>
        <input class="form-control" name="key1" id="ex1" type="password" autofocus="true" placeholder="Registro QR-Code" required="required"><br>

        <label>Funcionário / Promotor - (quem está entregando)</label>
        <input class="form-control" name="func1" id="ex3" type="password" placeholder="bipe seu código de barra no verso do cartão" required="required"><br>

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

  // recuperando id_user na tabela usuario
  $sql1 = "SELECT id_user FROM usuario WHERE matricula = '$fun_pro';";
  $result1 = mysqli_query($conn, $sql1);
  $fetch1 = mysqli_fetch_assoc($result1);
  $fetch1 = array_shift($fetch1);
  $id_user = $fetch1;

 // recuperando id_prev na tabela prevenção
  $sql0 = "SELECT id_prev FROM prevencao WHERE matricula = '$prev';";
  $result0 = mysqli_query($conn, $sql0);
  $fetch0 = mysqli_fetch_assoc($result0);
  $fetch0 = array_shift($fetch0);
  $id_prev = $fetch0;


  if ($id_user == 0 || $id_prev == 0){

    echo"<script language='javascript' type='text/javascript'>
    alert('USUÁRIO NÃO RECONHECIDO PELO SISTEMA, indique outro código de barra');window.location.href='devolucao.php';</script>";

  }else{

    // recuperando id_key na tabela usuario
    $sql2 = "SELECT id_key FROM chave WHERE codigo = '$chave' and situacao = 1;";
    $result2 = mysqli_query($conn, $sql2);
    $fetch2 = mysqli_fetch_assoc($result2);
    $fetch2 = array_shift($fetch2);
    $id_key = $fetch2;

    if (!isset($id_key))
    {
      echo"<script language='javascript' type='text/javascript'>
      alert('Esta chave não pode ser devolvida por ela não está NA LISTA DE RETIRADA - DEVOLVA UMA CHAVE VÁLIDA PARA O SISTEMA');window.location.href='devolucao.php';</script>";
    }
    else{

      // atualizando situação da chave
      $sql2 = "UPDATE chave 
      SET situacao = 0
      WHERE id_key = '$id_key'; ";
      mysqli_query($conn,$sql2) or die(mysqli_error());

      // inserir registro de saída de chave
      $sql1 = "INSERT INTO registro (data, hora, id_user, id_key, info, id_prev) VALUE ('$day', '$time', '$id_user', '$id_key', 'devolvida', '$id_prev'); ";
      mysqli_query($conn,$sql1) or die(mysqli_error());

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

?>